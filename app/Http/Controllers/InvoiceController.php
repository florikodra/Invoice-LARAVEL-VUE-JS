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
        return $pdf->stream('invoice.pdf');
        //return view('pdf',compact('invoice','items'));

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
                'fixed' => $item['fixed'],
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
        $invoice = Invoice::find($id);
        $invoice->date = $request->data;
        $invoice->reference_number = $request->reference_number;
        $invoice->reference_person = $request->customer;
        $invoice->company = $request->company;
        $invoice->currency = $request->currency;
        $invoice->tax = $request->tax;
        $invoice->subtotal = $request->subtotal;
        $invoice->total = $request->total;
        $invoice->update();


        $invoiceItemsToUpdate = [];
        $invoiceItemsToInsert = [];

        $items= $request->get('invoiceItems');
        foreach ($items as $item) {

            if(is_null($item['id'])){

                $total = $item['price']*$item['quantity'];

                $invoiceItemsToInsert [] = [
                'invoice_id' => $id,
                'title' => $item['title'],
                'description' => $item['description'],
                'quantity' => $item['quantity'],
                'fixed' => $item['fixed'],
                'price' => $item['price'],
                'total' => (double) $total,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                ];

            }else{
                $total = $item['price']*$item['quantity'];
                $invtoupdate = InvoiceItem::find($item['id']);
                $invtoupdate->title = $item['title'];
                $invtoupdate->description = $item['description'];
                $invtoupdate->quantity = $item['quantity'];
                $invtoupdate->fixed = $item['fixed'];
                $invtoupdate->price = $item['price'];
                $invtoupdate->total = (double) $total;
                $invtoupdate->update();

            }
            
        }

        InvoiceItem::insert($invoiceItemsToInsert);
        InvoiceItem::destroy($request->itemsToDelete);

        $invoice = Invoice::find($id);
        return response()->json(array(
            'invoice' => $invoice,
            'items' => $invoice->items,
        ));

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
        $invoice->items()->delete();
        $invoice->delete();

        return response()->json('Invoice deleted!');

    }
}