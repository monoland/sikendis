<?php

namespace App\Http\Controllers\Apps;

use App\Models\Service;
use Illuminate\Http\Request;
use App\Http\Resources\ServiceCollection;
use App\Http\Controllers\Controller;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('viewAny', Service::class);
        
        return new ServiceCollection(
            Service::filterOn($request)->paginate($request->itemsPerPage)
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
        $this->authorize('create', Service::class);

        $this->validate($request, [
            //
        ]);

        return Service::storeRecord($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function show(Service $service)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Service $service)
    {
        $this->authorize('update', $service);

        $this->validate($request, [
            //
        ]);

        return Service::updateRecord($request, $service);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function destroy(Service $service)
    {
        $this->authorize('delete', $service);

        return Service::destroyRecord($service);
    }

    /**
     * Remove the bulkdelete resource from storage.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function bulkdelete(Request $request)
    {
        $this->authorize('bulkDelete', Service::class);

        return Service::bulkDelete($request);
    }

    /**
     * Display a listing for combo
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function combo(Request $request)
    {
        return Service::fetchCombo($request);
    }

    /**
     * Undocumented function
     *
     * @param Service $service
     * @return void
     */
    public function submission(Service $service)
    {
        $this->authorize('submission', $service);
        
        return Service::submission($service);
    }

    /**
     * Undocumented function
     *
     * @param Service $service
     * @return void
     */
    public function examine(Request $request, Service $service)
    {
        $this->authorize('examine', Service::class);

        $this->validate($request, [
            'garage' => 'required'
        ]);

        return Service::examine($request, $service);
    }

    /**
     * Undocumented function
     *
     * @param Service $service
     * @return void
     */
    public function approval(Service $service)
    {
        $this->authorize('approval', Service::class);

        return Service::approval($service);
    }

    /**
     * Undocumented function
     *
     * @param Service $service
     * @return void
     */
    public function workorder(Service $service)
    {
        $this->authorize('workorder', $service);
        
        return Service::workorder($service);
    }
}
