<?php

namespace App\Http\Controllers\Apps;

use App\Models\Type;
use App\Models\Brand;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\TypeCollection;

class TypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Brand $brand)
    {
        $this->authorize('viewAny', Type::class);

        return new TypeCollection(
            $brand->types()->filterOn($request)->paginate($request->itemsPerPage)
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Brand $brand)
    {
        $this->authorize('create', Type::class);

        $this->validate($request, [
            //
        ]);

        return Type::storeRecord($request, $brand);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Brand  $brand
     * @param  \App\Models\Type  $type
     * @return \Illuminate\Http\Response
     */
    public function show(Brand $brand, Type $type)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Brand  $brand
     * @param  \App\Models\Type  $type
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Brand $brand, Type $type)
    {
        $this->authorize('update', $type);

        $this->validate($request, [
            //
        ]);

        return Type::updateRecord($request, $type);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Brand  $brand
     * @param  \App\Models\Type  $type
     * @return \Illuminate\Http\Response
     */
    public function destroy(Brand $brand, Type $type)
    {
        $this->authorize('delete', $type);

        return Type::destroyRecord($type);
    }

    /**
     * Remove the bulkdelete resource from storage.
     *
     * @param  \App\Models\Type  $type
     * @return \Illuminate\Http\Response
     */
    public function bulkdelete(Request $request)
    {
        $this->authorize('bulkDelete', Type::class);
        
        return Type::bulkDelete($request);
    }

    /**
     * Display a listing for combo
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function combo(Request $request)
    {
        return Type::fetchCombo($request);
    }
}
