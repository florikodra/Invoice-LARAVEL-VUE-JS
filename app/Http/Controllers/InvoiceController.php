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
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function pdf(Request $request)
    {
        //var_dump($request->invoiceItems);
       /*  $pdf = PDF::loadView('pdf');
        $content = $pdf->download('pdf_file.pdf');
        Storage::put('public/name.pdf', $content) ; */

        /* $pdf = PDF::loadView('pdf');

        Storage::put('public/pdf/invoice.pdf', $pdf->output());

        return $pdf->download('invoice.pdf'); */

        return PDF::loadView('pdf')->save('public/pdf/my_stored_file.pdf')->stream('download.pdf');



        //return "https://google.com";
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

       /*
        $item = new InvoiceItem();
           $item->invoice_id = $id;
           $item->title = $item['title'];
           $item->description = $item['description'];
           $item->quantity = $item['quantity'];
           $item->price = $item['price'];
           $item->total =$item['price']*$item['quantity'];
           $item->save();
       
       $items= $request->get('invoiceItems');
        foreach($items as $item) {
            InvoiceItem::create([
                'invoice_id' => $id,
                'title' => $item['title'],
                'description' => $item['description'],
                'quantity' => $item['quantity'],
                'price' => $item['price'],
                'total' => $item['price']*$item['quantity']
    
            ]);
        } */
      
       /*  $data = $request->get('invoiceItems');

        $data = json_decode($data, true); */
       /*  $data = [
            ['invoice_id'=>$id, 'title'=> 'testtt'],
            ['invoice_id'=>$id, 'title'=> 'test'],
            //...
        ]; */

       /*  InvoiceItem::insert( $data); */

      /*  foreach ($request->get('invoiceItems') as $i =>  $invoiceItem) {
           $item = new InvoiceItem();
           $item->invoice_id = $id;
           $item->title = $invoiceItem->title;
           $item->description = $invoiceItem->description;
           $item->quantity = $invoiceItem->quantity;
           $item->price = $invoiceItem->price;
           $item->total = $invoiceItem->quantity*$invoiceItem->price;
           $item->create();
           
       } */

       var_dump($request->get('invoiceItems'));


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
        $items = new InvoiceItem();
        $items = $items->where("invoice_id",$id)->get();
        return response()->json(array(
            'invoice' => $invoice,
            'items' => $items
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
        /* $invoice=Invoice::findorFa($id); */
        $invoice = Invoice::findOrFail($id);
        $invoice->delete();
    }
}