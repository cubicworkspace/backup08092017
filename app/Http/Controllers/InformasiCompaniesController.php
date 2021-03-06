<?php

namespace App\Http\Controllers;

use DB;
use App\informasicompanies;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;


class InformasiCompaniesController extends Controller
{
   
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $no = 1;
        $view = informasicompanies::all();
        return view('internal.informasicompanies.view', compact('view'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('internal.informasicompanies.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $informasicompanies = new informasicompanies;

        $extention = Input::file('icon')->getClientOriginalExtension();
        $filename = rand(11111,99999).'.'. $extention;
        $request->file('icon')->move(
            base_path() . '/public/upload/informasicompanies/', $filename
        );

        $this->validate($request, [
             'name' => 'required',
             'title' => 'required']);
        $informasicompanies->name = $request->name;
        $informasicompanies->title = $request->title;
        $informasicompanies->description = $request->description;
        $informasicompanies->icon = $filename;
        $informasicompanies->status = $request->status;
        $informasicompanies->save();
        \Session::flash('success', 'Informasi Companies data has been successfully added!,');
        return redirect('/informasicompanies');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $edit = informasicompanies::find($id);
        return view('internal.informasicompanies.edit', compact('edit'));
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
        $informasicompanies = informasicompanies::find($id);
        $icon = Input::file('icon');
        if($icon) {     
            $extention = Input::file('icon')->getClientOriginalExtension();
            $filename = rand(11111,99999).'.'. $extention;
            $request->file('icon')->move(
                base_path() . '/public/upload/informasicompanies/', $filename
            );

            $this->validate($request, [
                 'name' => 'required',
                 'title' => 'required']);
            $informasicompanies->name = $request->name;
            $informasicompanies->title = $request->title;
            $informasicompanies->description = $request->description;
            $informasicompanies->icon = $filename;
            $informasicompanies->status = $request->status;
            $informasicompanies->save();
            \Session::flash('success', 'Informasi Companies data has been edited successfully!,');
            return redirect('/informasicompanies');
        } else {
            $this->validate($request, [
                 'name' => 'required',
                 'title' => 'required']);
            $informasicompanies->name = $request->name;
            $informasicompanies->title = $request->title;
            $informasicompanies->description = $request->description;
            $informasicompanies->status = $request->status;
            $informasicompanies->save();
            \Session::flash('success', 'Informasi Companies data has been edited successfully!,');
            return redirect('/informasicompanies');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $informasicompanies = informasicompanies::find($id);
        \Session::flash('warning', 'Informasi Companies data has been successfully deleted!,');
        return redirect('/informasicompanies');
    }
}
