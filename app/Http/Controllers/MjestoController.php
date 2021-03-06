<?php

namespace Fakultet\Http\Controllers;

use Illuminate\Http\Request;


//use Request;
//use Fakultet\Http\Requests;
use Validator;
use Input;
use Session;
use Redirect;
use View;
use Fakultet\Zupanija;
use Fakultet\Mjesto;
use Fakultet\Item;



class MjestoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($broj=10)
    {
        $mjestos = Mjesto::paginate($broj);
        //$mjestos = Mjesto::all();
            return View::make('fakultet.mjesto.index')
                            ->with('mjestos', $mjestos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return View::make('fakultet.mjesto.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
                // validate
        // read more on validation at http://laravel.com/docs/validation
        $rules = array(
            'pbr'=>'required',
            'nazMjesto' => 'required',
            'sifZupanija' => 'required'
        );
        $validator = Validator::make(Input::all(), $rules);

        //$validator = Validator::make($request->all(), $rules)->validate();
        // process the login
        if ($validator->fails()) {
            return Redirect::to('mjesto/create')
                            ->withErrors($validator)
                            ->withInput(Input::except('password'));
        } else {
            // store
            $mjesto = new Mjesto;
            $mjesto->pbr = Input::get('pbr');
            $mjesto->nazMjesto = Input::get('nazMjesto');
            $mjesto->sifZupanija=Input::get('sifZupanija');
            
            $mjesto->save();

            // redirect
            Session::flash('message', 'Uspješno dodao novo mjesto!');
            return Redirect::to('mjesto');
    }
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // get the nerd
        $mjesto = Mjesto::find($id);

        // show the view and pass the nerd to it
        return View::make('fakultet.mjesto.show')
                        ->with('mjesto', $mjesto);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
           $mjesto = Mjesto::find($id);
           
           // Ovime dobijemo sve kolumne
           //$zupanije= Zupanija::all();
           
           // Odaberi samo kolumne Naziv i šifra županije za dropdown menu
           $zupanije = Zupanija::pluck('nazZupanija', 'sifZupanija');
           
        
        // Koristeći edit formu za mjesta
        // Korisniku se prikazuje padajući menu
        // Preddabrana vrijednost je trenutna važeća županija
        // Kada korisnik odabere padajući menu   
        // Kada potvrdi formu
        // Postavlja se nova županija   
        return View::make('fakultet.mjesto.edit')
                        ->with(['mjesto'=> $mjesto,'zupanije'=> $zupanije]); // za dropdown menu u view fakultet.mjesto.edit
                
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
        // validate
        // read more on validation at http://laravel.com/docs/validation
        $rules = array(
            'pbr'         => 'required|numeric',
            'nazMjesto'   => 'required',
            'sifZupanija' => 'required|numeric'
        );
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
           return Redirect::to('mjesto/' . $id . '/edit')
                            ->withErrors($validator)
                            ->withInput(Input::except('password'));
        } else {
            // store
            $mjesto = Mjesto::find($id);
            $mjesto->pbr         = Input::get('pbr');
            $mjesto->nazMjesto   = Input::get('nazMjesto');
            $mjesto->sifZupanija = Input::get('sifZupanija');
            $mjesto->save();

            // redirect
            Session::flash('message', 'Successfully updated mjesto!');
            return Redirect::to('mjesto');
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
            // delete
        $mjesto = Mjesto::find($id);
        $mjesto->delete();

        // redirect
        Session::flash('message', 'Uspješno obrisao mjesto!');
        return Redirect::to('mjesto');
    }
}
