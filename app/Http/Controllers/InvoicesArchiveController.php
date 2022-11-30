<?php

namespace App\Http\Controllers;

use App\Models\invoices;
use App\Models\invoices_attachement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;


class InvoicesArchiveController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
   
       $invoices= invoices::onlyTrashed()->get();
        return view('invoices.invoicesArchive',compact('invoices'));
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


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\invoices_attachement  $invoices_attachement
     * @return \Illuminate\Http\Response
     */


 

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
    public function update(Request $request)
    {
        $invoice=invoices::withTrashed()->where('id',$request->id)->restore();
        session()->flash('update');
        return redirect('invoices');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\invoices_attachement  $invoices_attachement
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $invoice=invoices::withTrashed()->where('id',$request->id)->first();
        $invoice->forceDelete();
        session()->flash('delete', 'تم حذف المرفق بنجاح');
        return back();
    }
}
