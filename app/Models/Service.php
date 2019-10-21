<?php

namespace App\Models;

// use App\Traits\HasMetaField;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\ServiceResource;
use App\Notifications\ApprovalService;
use App\Notifications\ApproveKabiro;
use App\Notifications\ExamineService;
use App\Notifications\ServiceCreated;
use App\Notifications\SubmissionService;
use App\Notifications\WorkOrderService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Notification;

// use Illuminate\Database\Eloquent\SoftDeletes;

class Service extends Model
{
    // use HasMetaField, SoftDeletes;

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = true;

    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'int';

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [];

    /**
     * Undocumented function.
     */
    public function garage()
    {
        return $this->belongsTo(Garage::class);
    }

    /**
     * Undocumented function.
     */
    public function agency()
    {
        return $this->belongsTo(Agency::class);
    }

    /**
     * Undocumented function.
     */
    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }

    /**
     * Undocumented function.
     */
    public function police()
    {
        return $this->belongsTo(Police::class);
    }

    /**
     * Undocumented function.
     */
    public function invoice()
    {
        return $this->hasOne(Invoice::class);
    }

    /**
     * Scope for combo.
     */
    public function scopeFetchCombo($query)
    {
        return $query->select(
            'name AS text', 'id AS value'
        )->get();
    }

    /**
     * Scope for filter.
     */
    public function scopeFilterOn($query, $request)
    {
        $sortaz = $request->sortDesc === 'true' ? 'desc' : 'asc';
        $sortby = $request->has('sortBy') ? $request->sortBy : null;
        $search = $request->has('search') ? strtolower($request->search) : null;
        // $filton = $request->has('filterOn') ? $request->filterOn : null;
        // $filtby = $request->has('filterBy') ? $request->filterBy : null;

        $mixquery = $query;

        switch ($request->user()->authent->name) {
            case 'kabiro':
                $mixquery
                    ->where('agency_id', $request->user()->userable->id)
                    ->whereIn('status', ['disposition']);
                break;

            case 'pptk':
                $mixquery
                    ->whereIn('status', ['submission']);
                break;

            case 'kpa':
                $mixquery
                    ->whereIn('status', ['examine']);
                break;

            case 'tata-usaha':
                $mixquery
                    ->whereIn('status', ['work-order']);
                break;
            
            default:
                $mixquery
                    ->where('agency_id', $request->user()->userable->id)
                    ->whereIn('status', ['disposition', 'submission', 'examine', 'approval']);
                break;
        }

        if ($search) {
            $mixquery = $mixquery->whereRaw("LOWER(name) LIKE '%{$search}%'");
        }

        // if ($filtby) {
        //     $mixquery = $mixquery->whereRaw("{$filton} = '{$filtby}'");
        // }

        if ($sortby) {
            $mixquery = $mixquery->orderBy($sortby, $sortaz);
        }

        return $mixquery;
    }

    /**
     * Store.
     */
    public static function storeRecord($request)
    {
        DB::beginTransaction();

        try {
            $status = $request->user()->operatorUmum() ? 'submission' : 'disposition';

            $model = new static();
            $model->vehicle_id = $request->vehicle['value'];
            $model->agency_id = $request->vehicle['agency_id'];
            $model->police_id = $request->vehicle['police_id'];
            $model->garage_id = $request->garage['value'];
            $model->periode = $request->periode;
            $model->user_id = $request->user()->id;
            $model->notes = $request->notes;
            $model->status = $status;
            $model->save();

            if ($status === 'disposition') {
                $agency = $request->user()->userable;
                $user = $agency->users()->where('authent_id', 3)->first();
            } else {
                $user = User::where('authent_id', 4)->first();
            }

            if ($user) {
                $user->notify(new ServiceCreated($model));
            }

            DB::commit();

            return new ServiceResource($model);
        } catch (\Exception $e) {
            DB::rollBack();

            abort(500, $e->getMessage());
        }
    }

    /**
     * Update.
     */
    public static function updateRecord($request, $model)
    {
        DB::beginTransaction();

        try {
            // ...
            $model->save();

            DB::commit();

            return new ServiceResource($model);
        } catch (\Exception $e) {
            DB::rollBack();

            abort(500, $e->getMessage());
        }
    }

    /**
     * Destroy.
     */
    public static function destroyRecord($model)
    {
        DB::beginTransaction();

        try {
            $model->delete();

            DB::commit();

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            DB::rollBack();

            abort(500, $e->getMessage());
        }
    }

    /**
     * Bulks.
     */
    public static function bulkDelete($request, $model = null)
    {
        DB::beginTransaction();

        try {
            $bulks = array_column($request->all(), 'id');
            $rests = (new static())->whereIn('id', $bulks)->delete();

            DB::commit();

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            DB::rollBack();

            abort(500, $e->getMessage());
        }
    }

    /**
     * Undocumented function
     *
     * @param [type] $model
     * @return void
     */
    public static function submission($model)
    {
        DB::beginTransaction();

        try {
            $model->status = 'submission';
            $model->save();

            // find PPTK
            $user = User::where('authent_id', 4)->first();
            
            if ($user) {
                $user->notify(new SubmissionService($model));
            }
            
            DB::commit();

            return response()->json(['success' => true], 200);
        } catch (\Exception $e) {
            DB::rollBack();

            abort(500, $e->getMessage());
        }
    }

    /**
     * Undocumented function
     *
     * @param [type] $model
     * @return void
     */
    public static function examine($request, $model)
    {
        DB::beginTransaction();

        try {
            $model->status = 'examine';
            $model->garage_id = $request->garage;
            $model->save();

            // find PPTK
            $user = User::where('authent_id', 5)->first();
            
            if ($user) {
                $user->notify(new ExamineService($model));
            }
            
            DB::commit();

            return response()->json(['success' => true], 200);
        } catch (\Exception $e) {
            DB::rollBack();

            abort(500, $e->getMessage());
        }
    }

    /**
     * Undocumented function
     *
     * @param [type] $model
     * @return void
     */
    public static function approval($model)
    {
        DB::beginTransaction();

        try {
            $model->status = 'approval';
            $model->save();

            // find operators
            $users = $model->agency->users()->where('authent_id', 2)->get();
            
            if ($users) {
                Notification::send($users, new ApprovalService($model));
            }
            
            DB::commit();

            return response()->json(['success' => true], 200);
        } catch (\Exception $e) {
            DB::rollBack();

            abort(500, $e->getMessage());
        }
    }

    public static function workorder($model)
    {
        DB::beginTransaction();

        try {
            $model->status = 'work-order';
            $model->save();

            // find PPTK
            $user = User::where('authent_id', 7)->first();
            
            if ($user) {
                $user->notify(new WorkOrderService($model));
            }
            
            DB::commit();

            return response()->json(['success' => true], 200);
        } catch (\Exception $e) {
            DB::rollBack();

            abort(500, $e->getMessage());
        }
    }
}
