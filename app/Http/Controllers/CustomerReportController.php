<?php

namespace App\Http\Controllers;

use App\Models\invoices;
use App\Models\products;
use App\Models\sections;
use Illuminate\Http\Request;

class CustomerReportController extends Controller
{
   public function index()
   {
    $sections=sections::all();
    $products=products::all();
    return view('reports.customer_report',compact('sections','products'));
   }

   
      public function search(Request $request)
      {
          $sections_id= $request->section;
          $products= $request->product;
              // في حالة  عدم تحديد تاريخ 
              if ($products &&$sections_id&& $request->start_at =='' && $request->end_at =='')
                 { $invoices = invoices::where('product', '=',$products)->where('section_id', '=', $sections_id)->get();
                    $sections=sections::all();
                    $products=products::all();
                    return view('reports.customer_report',compact('invoices','sections','products'));
                 }
  
                  
          // في حالة تحديد تاريخ 
  
              else{
                  $start_date=$request->start_at;
                  $end_date=$request->end_at;
                  $invoices = invoices::where('product', '=',$products)->where('section_id', '=', $sections_id)->whereBetween('invoice_date',[$start_date,$end_date])->get();
                  $sections=sections::all();
                  $products=products::all();
                  return view('reports.customer_report',compact('invoices','sections','products'));
         }
          }
  
  
  
  
  
  
  
            
      }
   

