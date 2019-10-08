<?php

namespace App\Http\Controllers\Apps;

use App\Models\Segment;
use Illuminate\Http\Request;
use App\Http\Resources\SegmentCollection;
use App\Http\Controllers\Controller;

class SegmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('viewAny', Segment::class);
        
        return new SegmentCollection(
            Segment::filterOn($request)->paginate($request->itemsPerPage)
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
        $this->authorize('create', Segment::class);

        $this->validate($request, [
            //
        ]);

        return Segment::storeRecord($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Segment  $segment
     * @return \Illuminate\Http\Response
     */
    public function show(Segment $segment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Segment  $segment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Segment $segment)
    {
        $this->authorize('update', $segment);

        $this->validate($request, [
            //
        ]);

        return Segment::updateRecord($request, $segment);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Segment  $segment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Segment $segment)
    {
        $this->authorize('delete', $segment);

        return Segment::destroyRecord($segment);
    }

    /**
     * Remove the bulkdelete resource from storage.
     *
     * @param  \App\Models\Segment  $segment
     * @return \Illuminate\Http\Response
     */
    public function bulkdelete(Request $request)
    {
        $this->authorize('bulkDelete', Segment::class);

        return Segment::bulkDelete($request);
    }

    /**
     * Display a listing for combo
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function combo(Request $request)
    {
        return Segment::fetchCombo($request);
    }
}
