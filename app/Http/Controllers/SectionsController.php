<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSection;
use App\Models\sections;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;


class SectionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sections=sections::all();
        return view('sections.sections',compact('sections'));
    }

    public function getSectionById($id)
    {
        $getSectionById=sections::find($id);
        return view('sections.sections',compact('getSectionById'));
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
    public function store(StoreSection $request)
    {
           
// $request->validate(
//             [
//                 'section_name'=>'required|unique:sections|max:300',
//                 'notes'=>'required',
//             ]
//             ,
//             [
//                 'section_name.required'=>'ادخل اسم القسم',
//                 'section_name.unique'=>' اسم القسم موجود مسبقا',
//                 'notes.required'=>'ادخل الملاحظات الخاصه بالقسم',
//             ]
        
//         );


       
        $input=$request->all();
        // dd( $input);

        // $is_exist=sections::where('section_name','=',$input['section_name'])->exists();

        // if($is_exist)
        // {
        //      session()->flash('error','section is exist can`t add it again');
        //     return redirect('/sections');
        // }

        // else{
            sections::create(
                [
                    'section_name'=>$input['section_name'],
                    'description'=>$input['notes'],
                    'created_by'=>Auth::user()->name,

                ]
                );
                return  redirect('/sections');
            //     session()->flash('add','new section  added successfully');
            //   return  redirect('/sections');
            // }
//    @dd (Auth::user()->name);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\sections  $sections
     * @return \Illuminate\Http\Response
     */
    public function show(sections $sections)
    {
       $sections=sections::all();
       return view('sections.sections',compact('sections'));
       //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\sections  $sections
     * @return \Illuminate\Http\Response
     */
    public function edit(sections $sections)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\sections  $sections
     * @return \Illuminate\Http\Response
     */
    public function update(StoreSection $request)
    {
        $id=$request->id;
        sections::find($id)->update(

            [
                'section_name'=>$request['section_name'],
                'description'=>$request['notes'],

            ]
        );
       return redirect('/sections');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\sections  $sections
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {       $id=$request->id;
            sections::find($id)->delete();
           
            session()->flash('delete','تم حذف  القسم بنجاح ');
            return  redirect('/sections');

         
    }
}
