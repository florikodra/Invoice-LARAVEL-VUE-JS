<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Invoice;
use Storage;
use PDF;


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



    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        echo "test";

        $pdf = PDF::loadView('pdf');
         Storage::put('public/pdf/invoice.pdf', $pdf->output());

        return $pdf->download('invoice.pdf');


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