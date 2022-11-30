<?php

namespace App\Http\Controllers;

use App\Models\invoices_attachement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;


class InvoicesAttachementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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

    /**M
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeAtachements(Request $request)
    {

        $this->validate($request,[
            'file_name'=>'mimes:jpg,png,pdf',
        ],
        [
            'file_name.mimes '=>' jpg,png,pdf صيغه المرفق يجب ان تكون ',
        ]
    );
        invoices_attachement::create(
            [
   
               'file_name'=>$request[ "file_name"]->getClientOriginalName(),
                'invoice_number'=> $request[ "invoice_number"],
                'Created_by'=> Auth::user()->name,
                'invoice_id'=>  $request[ "invoice_id"]
            ]
        );
       

        // mov pic to server not to database
        $imag_name=$request[ "file_name"]->getClientOriginalName();
        $invoice_number=$request[ "invoice_number"];
        $request->file_name->move(public_path('attachements/'. $invoice_number), $imag_name);
    

    session()->flash('add','تم اضافه الفاتوره بنجاح');

     return BACK();
        // $invoices=invoices::all();
        // return redirect('invoices');  
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\invoices_attachement  $invoices_attachement
     * @return \Illuminate\Http\Response
     */


    public function showFile($invoiceNumber, $fileName)
    {
        return response()->file(public_path('attachements/' . $invoiceNumber . '/' . $fileName));
    }

    public function download_file($invoiceNumber, $fileName)
    {
        return response()->download(public_path('attachements/' . $invoiceNumber . '/' . $fileName));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\invoices_attachement  $invoices_attachement
     * @return \Illuminate\Http\Response
     */
    public function edit(invoices_attachement $invoices_attachement)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\invoices_attachement  $invoices_attachement
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, invoices_attachement $invoices_attachement)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\invoices_attachement  $invoices_attachement
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        invoices_attachement::findOrFail($request->id)->delete();

        storage::disk('public_uploads')->delete($request->invoice_number . '/' . $request->file_name);


        session()->flash('delete', 'تم حذف المرفق بنجاح');
        return back();
    }
}
