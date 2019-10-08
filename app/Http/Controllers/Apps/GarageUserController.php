<?php

namespace App\Http\Controllers\Apps;

use App\Models\User;
use App\Models\Garage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserCollection;

class GarageUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \App\Models\Garage  $garage
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Garage $garage)
    {
        $this->authorize('viewAny', User::class);

        return new UserCollection(
            $garage->users()->filterOn($request)->paginate($request->itemsPerPage)
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Garage  $garage
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Garage $garage)
    {
        $this->authorize('create', User::class);

        $this->validate($request, [
            //
        ]);

        return User::storeRecord($request, $garage);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Garage  $garage
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(Garage $garage, User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Garage  $garage
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Garage $garage, User $user)
    {
        $this->authorize('update', $user);

        $this->validate($request, [
            //
        ]);

        return User::updateRecord($request, $user);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Garage  $garage
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(Garage $garage, User $user)
    {
        $this->authorize('delete', $user);

        return User::destroyRecord($user);
    }

    /**
     * Remove the bulkdelete resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function bulkdelete(Request $request)
    {
        $this->authorize('bulkDelete', User::class);
        
        return User::bulkDelete($request);
    }

    /**
     * Display a listing for combo
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function combo(Request $request)
    {
        return User::fetchCombo($request);
    }
}
