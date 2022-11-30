<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSection;
use App\Models\products;
use App\Models\sections;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sections=sections::all();
        $products=products::all();
        return view('products.products',compact('sections','products'));

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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         products::create(
            [
                 "product_name"=> $request[ "product_name"],
                 "section_id" =>  $request[ "section_id"],
                "description" => $request[ "notes"]
                
                

            ]
            );


           return redirect('products');

        // return $request;


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\products  $products
     * @return \Illuminate\Http\Response
     */
    public function show(products $products)
    {
       $products= products::all();
        return redirect('\products',compact('products'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\products  $products
     * @return \Illuminate\Http\Response
     */
    public function edit(products $products)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\products  $products
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {     
        
        $section_id=sections::where('section_name',$request->section_name)->first()->id;
        products::findOrFail($request[ "product_id"])->update(
            [
                 "product_name"=> $request[ "product_name"],
                 "section_id" =>  $section_id,
                "description" => $request[ "notes"]
                
                

            ]
            );

            session()->flash('update','تم تعديل المنتج بنجاح');

        //    return redirect('products');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\products  $products
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {

        $id=$request->product_id;
        products::find( $id)->delete();

       session()->flash('delete','تم حذف المنتج بنجاح');
        // return redirect('products');
        return back();


            
    }
}
