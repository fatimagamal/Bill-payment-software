<?php

namespace App\Http\Controllers;

use App\Models\invoices;
use Illuminate\Http\Request;

class InvoiceReportController extends Controller
{
    public function index()
    {
        return view('reports.invoices_report');
    }



    public function search(Request $request)
    {
        $radio_type = $request->radio;

        // في حالة البحث بنوع الفاتورة

        if ($radio_type == 1)
         {

            // في حالة  عدم تحديد تاريخ استحقاق
            if ($request->type && $request->start_at =='' && $request->end_at =='')
               { $invoices = invoices::where('status', '=', $request->type)->get();
                $type = $request->type;
                 return view('reports.invoices_report',compact('type','invoices'));
                }

                
        // في حالة تحديد تاريخ استحقاق

            else{
                $start_date=$request->start_at;
                $end_date=$request->end_at;
                $invoices = invoices::where('status', '=', $request->type)->whereBetween('invoice_date',[$start_date,$end_date])->get();
                $type = $request->type;
                return view('reports.invoices_report',compact('type','start_date','end_date','invoices'));
                }
        }







           elseif($radio_type==2)
            {
                
                $invoices = invoices::where('invoice_number', '=', $request->invoice_number)->get();
                return view('reports.invoices_report',compact('invoices'));
            }

    }
}
