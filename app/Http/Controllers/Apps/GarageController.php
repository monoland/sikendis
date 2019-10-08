<?php

namespace App\Http\Controllers\Apps;

use App\Models\Garage;
use Illuminate\Http\Request;
use App\Http\Resources\GarageCollection;
use App\Http\Controllers\Controller;

class GarageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('viewAny', Garage::class);
        
        return new GarageCollection(
            Garage::filterOn($request)->paginate($request->itemsPerPage)
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('create', Garage::class);

        $this->validate($request, [
            //
        ]);

        return Garage::storeRecord($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Garage  $garage
     * @return \Illuminate\Http\Response
     */
    public function show(Garage $garage)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Garage  $garage
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Garage $garage)
    {
        $this->authorize('update', $garage);

        $this->validate($request, [
            //
        ]);

        return Garage::updateRecord($request, $garage);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Garage  $garage
     * @return \Illuminate\Http\Response
     */
    public function destroy(Garage $garage)
    {
        $this->authorize('delete', $garage);

        return Garage::destroyRecord($garage);
    }

    /**
     * Remove the bulkdelete resource from storage.
     *
     * @param  \App\Models\Garage  $garage
     * @return \Illuminate\Http\Response
     */
    public function bulkdelete(Request $request)
    {
        $this->authorize('bulkDelete', Garage::class);

        return Garage::bulkDelete($request);
    }

    /**
     * Display a listing for combo
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function combo(Request $request)
    {
        return Garage::fetchCombo($request);
    }
}
