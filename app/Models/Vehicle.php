<?php

namespace App\Models;

// use App\Traits\HasMetaField;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\VehicleResource;
use Illuminate\Database\Eloquent\Model;

// use Illuminate\Database\Eloquent\SoftDeletes;

class Vehicle extends Model
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
    public function police()
    {
        return $this->belongsTo(Police::class);
    }

    /**
     * Undocumented function.
     */
    public function polices()
    {
        return $this->hasMany(Police::class);
    }

    /**
     * Scope for combo.
     */
    public function scopeFetchCombo($query)
    {
        return $query
            ->join('agencies', 'agencies.id', '=', 'vehicles.agency_id')
            ->select(
                DB::raw("CONCAT(vehicles.police_id, ' - ', agencies.name, ' an: ', vehicles.name) AS text"), 'vehicles.agency_id', 'vehicles.police_id', 'vehicles.id AS value'
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
    public static function storeRecord($request, $parent)
    {
        DB::beginTransaction();

        try {
            $model = new static();
            $model->police_id = $request->police_id;
            $model->name = $request->name;
            $model->year = $request->year;
            $model->frame_numb = $request->frame_numb;
            $model->machine_numb = $request->machine_numb;
            $model->brand_id = $parent->brand->id;
            $model->refs_numb = $request->refs_numb;
            $model->agency_id = $request->agency_id;
            $model->condition = $request->condition;
            $parent->vehicles()->save($model);

            $police = new Police();
            $police->id = $request->police_id;
            $police->name = $request->name;
            $police->color = $request->color;
            $police->taxdue = $request->taxdue;
            $police->taxsum = $request->taxsum;
            $model->polices()->save($police);

            DB::commit();

            return new VehicleResource($model);
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
            $model->name = $request->name;
            $model->year = $request->year;
            $model->frame_numb = $request->frame_numb;
            $model->machine_numb = $request->machine_numb;
            $model->refs_numb = $request->refs_numb;
            $model->agency_id = $request->agency_id;
            $model->condition = $request->condition;
            $model->save();

            $police = Police::findOrNew($request->police_id);
            $police->id = $request->police_id;
            $police->name = $request->name;
            $police->color = $request->color;
            $police->taxdue = $request->taxdue;
            $police->taxsum = $request->taxsum;
            $model->polices()->save($police);

            DB::commit();

            return new VehicleResource($model);
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
}
