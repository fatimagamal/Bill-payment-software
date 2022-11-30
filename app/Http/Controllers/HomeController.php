<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\invoices;

class HomeController extends Controller
{
    public function index()
    {
      // ExampleController.php

// ExampleController.php


$totalInvoicesCount =invoices::count();
$InvoicesCount1 =(invoices::where('value_status',1)->count()/$totalInvoicesCount) *100 ;
$InvoicesCount2 =(invoices::where('value_status',2)->count()/$totalInvoicesCount) *100 ;
$InvoicesCount3 =(invoices::where('value_status',3)->count()/$totalInvoicesCount) *100 ;

$chartjs = app()->chartjs
         ->name('barChartTest')
         ->type('bar')
         ->size(['width' => 300, 'height' => 150])
         ->labels([ 'الفواتير المدفوعه جزئيه',',الفواتير الغير مدفوع', 'الفواتير المدفوعه'])
         ->datasets([
             [
                "label" => " نسبة الفواتير  المدفوعه جزئيه  ",
                 'backgroundColor' => 'rgb(235, 131, 65)',
                 'data' => [$InvoicesCount3]
             ],

             [
                "label" => " نسبة الفواتير الغير مدفوعه  ",
                'backgroundColor' => 'rgb(233, 98, 122)',
                'data' => [$InvoicesCount2]
            ],

            [
                "label" => "نسبة الفواتير المدفوعه",
                'backgroundColor' => 'rgb(103, 192, 155)',
                'data' => [$InvoicesCount1]
            ],
            
         ])
         ->options([]);


return view('home', compact('chartjs'));
}
}

