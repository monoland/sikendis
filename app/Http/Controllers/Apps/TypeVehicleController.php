<?php

namespace App\Http\Controllers\Apps;

use App\Models\Vehicle;
use App\Models\Type;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\VehicleCollection;

class TypeVehicleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \App\Models\Type  $type
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Type $type)
    {
        $this->authorize('viewAny', Vehicle::class);

        return new VehicleCollection(
            $type->vehicles()->filterOn($request)->paginate($request->itemsPerPage)
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Type  $type
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Type $type)
    {
        $this->authorize('create', Vehicle::class);

        $this->validate($request, [
            //
        ]);

        return Vehicle::storeRecord($request, $type);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Type  $type
     * @param  \App\Models\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function show(Type $type, Vehicle $vehicle)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Type  $type
     * @param  \App\Models\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Type $type, Vehicle $vehicle)
    {
        $this->authorize('update', $vehicle);

        $this->validate($request, [
            //
        ]);

        return Vehicle::updateRecord($request, $vehicle);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Type  $type
     * @param  \App\Models\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function destroy(Type $type, Vehicle $vehicle)
    {
        $this->authorize('delete', $vehicle);

        return Vehicle::destroyRecord($vehicle);
    }

    /**
     * Remove the bulkdelete resource from storage.
     *
     * @param  \App\Models\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function bulkdelete(Request $request)
    {
        $this->authorize('bulkDelete', Vehicle::class);
        
        return Vehicle::bulkDelete($request);
    }

    /**
     * Display a listing for combo
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function combo(Request $request)
    {
        return Vehicle::fetchCombo($request);
    }
}
