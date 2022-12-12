<?php

namespace App\Http\Controllers;

use App\Mail\mailNotify;
use Exception;
use Illuminate\Support\Facades\Mail;
use App\Models\invoices;
use App\Models\invoices_attachement;
use App\Models\invoices_details;
use App\Models\products;
use App\Models\sections;
use App\Models\User;
use Illuminate\Http\Request;
use App\Notifications\AddInvoices;
use Illuminate\Support\Facades\Notification;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class InvoicesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $invoices = invoices::all();
        return view('invoices.invoices', compact('invoices'));
    }


    public function print($id)
    {
        $invoice = invoices::find($id);
        return view('invoices.invoicesPrint', compact('invoice'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sections = sections::all();
        $products = products::all();

        return view('invoices.add_invoice', compact('sections', 'products'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //   dd($request[ "pic"]->getClientOriginalName());

        invoices::create(
            [
                'invoice_number' => $request["invoice_number"],
                'invoice_date' => $request["invoice_date"],
                'due_date' => $request["due_date"],
                'product' => $request["product"],
                'section_id' => $request["section"],
                'discount' => $request["discount"],
                'amount_commission' => $request["amount_commission"],
                'amount_collection' => $request["amount_collection"],
                'total' => $request["total"],
                'rate_vat' => $request["rate_vat"],
                'value_vat' => $request["value_vat"],
                'note' => $request["note"],
                'status' => "غير مدفوعه",
                'value_status' => 2,
                'payment_date' => "2202/8/22",

            ]
        );
        // dd($invoices_id);    
        $invoices_id = invoices::latest()->first()->id;

        invoices_details::create(
            [
                'invoice_number' => $request["invoice_number"],
                'product' => $request["product"],
                'id_invoice' => $invoices_id,
                'section_id' => $request["section"],
                'user' => Auth::user()->name,
                'note' => $request["note"],
                'status' => "غير مدفوعه",
                'value_status' => 2,
                'payment_date' => "2202/8/22",

            ]
        );

        if ($request->hasFile('pic')) {
            invoices_attachement::create(
                [

                    'file_name' => $request["pic"]->getClientOriginalName(),
                    'invoice_number' => $request["invoice_number"],
                    'Created_by' => Auth::user()->name,
                    'invoice_id' => $invoices_id
                ]
            );


            // mov pic to server not to database
            $imag_name = $request["pic"]->getClientOriginalName();
            $invoice_number = $request["invoice_number"];
            $request->pic->move(public_path('attachements/' . $invoice_number), $imag_name);
        }
        ////////////////////////////////////////////////////////////////////////////////////notification
        // $user =User::get();///لو عايز ابعت لكل ال يوزر الي عندي
        // $user =User::find(Auth::user()->id);//لو عايز ابعت اشعار للي عمل الفاتوره بس
        $user = User::get();
        $invoicesId = invoices::latest()->first()->id;
        Notification::send($user, (new AddInvoices($invoicesId)));

        ///////////////////////////////send email/////////////////////////////////
        $url="http://127.0.0.1:8000/invoicesDetails/".$invoicesId;
        $data = [
            'subject' => '  مرحبا عزيزي العميل',
            'body' => " تم اضافه فاتوره جديده",
            'action' => $url,
            'line' => "شكرا لاستخدامك موقعنا لتحصيل الفواتير"
        ];

        try {
            Mail::to('gamalfatma351@gmail.com')->send(new mailNotify($data));
            // return response()->json(['good']);
            return back();
        } catch (Exception $th) {
            return response()->json(['fail']);
        }



        ////////////////////////////////////////////////////////////////

        session()->flash('add', 'تم اضافه الفاتوره بنجاح');

        return back();
        // $invoices=invoices::all();
        // return redirect('invoices');  
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\invoices  $invoices
     * @return \Illuminate\Http\Response
     */
    public function mark_as_read_all()
    {
        $userUnRead_notifications = Auth::user()->unreadNotifications;
        if ($userUnRead_notifications) {
            $userUnRead_notifications->markAsRead();
            return back();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\invoices  $invoices
     * @return \Illuminate\Http\Response
     */
    public function edit(invoices $invoices)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\invoices  $invoices
     * @return \Illuminate\Http\Response
     */
    public function invoicesPayment($id)
    {
        $invoice = invoices::find($id);
        return view('invoices.invoicespayment', compact('invoice'));
    }


    public function changeInvoicesPaymentStatus(Request $request)
    {


        if ($request->value_status == 1) {
            $status = "مدفوعه";
        } elseif ($request->value_status == 2) {
            $status = "غير مدفوعه";
        } else
            $status = "مدفوعه جزئيا ";


        invoices::find($request->id)->update(
            [

                'payment_date' => $request->due_date,
                'status' => $status,
                'value_status' => $request->value_status,

            ]

        );

        invoices_details::create(
            [
                'invoice_number' => $request["invoice_number"],
                'product' => $request["product"],
                'id_invoice' => $request->id,
                'section_id' => $request["section"],
                'user' => Auth::user()->name,
                'note' => $request["note"],
                'status' =>  $status,
                'value_status' => $request->value_status,
                'payment_date' => $request->due_date,

            ]
        );

        $invoices = invoices::all();
        $invoices_details = invoices::all();
        return view('invoices.invoices', compact('invoices', 'invoices_details'));
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\invoices  $invoices
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {


        $invoices = invoices::where('id', $request->id)->first();
        $invoices_attachement = invoices_attachement::where('invoice_id', $request->id)->first();

        if ($request->type == 1) {
            if (!empty($invoices_attachement->invoice_number)) {
                // storage::disk('public_uploads')->delete($invoices_attachement->invoice_number . '/' . $invoices_attachement->file_name);
                storage::disk('public_uploads')->deleteDirectory($invoices_attachement->invoice_number);
            }

            $invoices->forceDelete(); ////////////////////////////      soft delete from database

            session()->flash('deleteInvoices');
            return redirect('invoices');
        } elseif ($request->type == 2) {

            $invoices->Delete(); ////////////////////////////      soft delete from database

            session()->flash('archiveInvoices');
            return redirect('invoices');
        }
    }




    public function  getinvoicesPaid()
    {
        $invoices = invoices::where('value_status', 1)->get();
        return view('invoices.invoicesPaid', compact('invoices'));
    }


    public function  getinvoicesUnpaid()
    {
        $invoices = invoices::where('value_status', 2)->get();
        return view('invoices.invoicesUnpaid', compact('invoices'));
    }



    public function  getinvoicesPartialPaid()
    {
        $invoices = invoices::where('value_status', 3)->get();
        return view('invoices.invoicesPartialPaid', compact('invoices'));
    }
}
