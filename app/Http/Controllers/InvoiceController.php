<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Invoice;
use App\Models\InvoiceItem;
use Storage;
use PDF;
use Carbon\Carbon;


class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $invoices = Invoice::all()->toArray();
        return array_reverse($invoices);
        echo "test";

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function pdf($id)
    {
        $invoice = Invoice::findOrFail($id);
        $items = $invoice->items;
        $pdf = PDF::loadView('pdf',compact('invoice','items'));
        return $pdf->download('invoice.pdf');
       /*  echo "<pre>";
        print_r($items);
        echo "</pre>"; */
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $invoice = new Invoice();
       $invoice->date = $request->data;
       $invoice->reference_number = $request->reference_number;
       $invoice->reference_person = $request->customer;
       $invoice->company = $request->company;
       $invoice->currency = $request->currency;
       $invoice->tax = $request->tax;
       $invoice->subtotal = $request->subtotal;
       $invoice->total = $request->total;
       $invoice->save();

       $id = $invoice->id;
       $invoiceItems = [];

       $items= $request->get('invoiceItems');
        foreach($items as $item) {
           
            $invoiceItems [] = [
                'invoice_id' => $id,
                'title' => $item['title'],
                'description' => $item['description'],
                'quantity' => $item['quantity'],
                'price' => $item['price'],
                'total' => $item['price']*$item['quantity'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ];
        }

        InvoiceItem::insert( $invoiceItems);

        return $id;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $invoice = Invoice::find($id);
        return response()->json(array(
            'invoice' => $invoice,
            'items' => $invoice->items,
        ));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        //
        echo "test";

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $invoice = Invoice::findOrFail($id);
        $invoice->delete();
    }
}