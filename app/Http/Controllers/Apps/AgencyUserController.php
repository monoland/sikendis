<?php

namespace App\Http\Controllers\Apps;

use App\Models\User;
use App\Models\Agency;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserCollection;

class AgencyUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \App\Models\Agency  $agency
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Agency $agency)
    {
        $this->authorize('viewAny', User::class);

        return new UserCollection(
            $agency->users()->filterOn($request)->paginate($request->itemsPerPage)
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Agency  $agency
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Agency $agency)
    {
        $this->authorize('create', User::class);

        $this->validate($request, [
            //
        ]);

        return User::storeRecord($request, $agency);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Agency  $agency
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(Agency $agency, User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Agency  $agency
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Agency $agency, User $user)
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
     * @param  \App\Models\Agency  $agency
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(Agency $agency, User $user)
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
