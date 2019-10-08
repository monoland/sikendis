<?php

namespace App\Http\Controllers\Apps;

use App\Models\Item;
use App\Models\Segment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ItemCollection;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \App\Models\Segment  $segment
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Segment $segment)
    {
        $this->authorize('viewAny', Item::class);

        return new ItemCollection(
            $segment->items()->filterOn($request)->paginate($request->itemsPerPage)
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Segment  $segment
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Segment $segment)
    {
        $this->authorize('create', Item::class);

        $this->validate($request, [
            //
        ]);

        return Item::storeRecord($request, $segment);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Segment  $segment
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function show(Segment $segment, Item $item)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Segment  $segment
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Segment $segment, Item $item)
    {
        $this->authorize('update', $item);

        $this->validate($request, [
            //
        ]);

        return Item::updateRecord($request, $item);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Segment  $segment
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function destroy(Segment $segment, Item $item)
    {
        $this->authorize('delete', $item);

        return Item::destroyRecord($item);
    }

    /**
     * Remove the bulkdelete resource from storage.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function bulkdelete(Request $request)
    {
        $this->authorize('bulkDelete', Item::class);
        
        return Item::bulkDelete($request);
    }

    /**
     * Display a listing for combo
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function combo(Request $request)
    {
        return Item::fetchCombo($request);
    }
}
