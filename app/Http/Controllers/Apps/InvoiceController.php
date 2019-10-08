<?php

namespace App\Http\Controllers\Apps;

use App\Models\Invoice;
use App\Models\Service;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\InvoiceCollection;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Service $service)
    {
        $this->authorize('viewAny', Invoice::class);

        return new InvoiceCollection(
            $service->invoices()->filterOn($request)->paginate($request->itemsPerPage)
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Service $service)
    {
        $this->authorize('create', Invoice::class);

        $this->validate($request, [
            //
        ]);

        return Invoice::storeRecord($request, $service);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Service  $service
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function show(Service $service, Invoice $invoice)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Service  $service
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Service $service, Invoice $invoice)
    {
        $this->authorize('update', $invoice);

        $this->validate($request, [
            //
        ]);

        return Invoice::updateRecord($request, $invoice);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Service  $service
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function destroy(Service $service, Invoice $invoice)
    {
        $this->authorize('delete', $invoice);

        return Invoice::destroyRecord($invoice);
    }

    /**
     * Remove the bulkdelete resource from storage.
     *
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function bulkdelete(Request $request)
    {
        $this->authorize('bulkDelete', Invoice::class);
        
        return Invoice::bulkDelete($request);
    }

    /**
     * Display a listing for combo
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function combo(Request $request)
    {
        return Invoice::fetchCombo($request);
    }
}
