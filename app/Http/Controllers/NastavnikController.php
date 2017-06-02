<?php
// php artisan make:controller NastavnikController --resource
namespace Fakultet\Http\Controllers;
//use Illuminate\View\View;


use Fakultet\Nastavnik;
use Fakultet\Stud;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Session;
use Input;
use Validator;
use Redirect;
use View;


class NastavnikController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $nastavnici = Nastavnik::all()->reverse();

        return View::make('fakultet.nastavnik.index')
                        ->with('nastavnici', $nastavnici);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return View::make('fakultet.nastavnik.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {

        $n=new Nastavnik;


        //TODO napravi validaciju
        $n = new Nastavnik;
        $n->imeNastavnik=Input::get('imeNastavnik');
        $n->prezNastavnik=Input::get('prezNastavnik');
        $n->pbrStan=Input::get('pbrStan');
        $n->sifOrgjed=Input::get('sifOrgjed');
        $n->koef=Input::get('koef');
        //$n->sifNastavnik=999;
        $n->save();
        
        return Redirect::to('nastavnik');
 

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
         $nastavnici = Nastavnik::find($id);

        return View::make('fakultet.nastavnik.show')
                        ->with('nastavnici', $nastavnici);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
          $n = Nastavnik::find($id);

        // Pokazi formu za editiranje studenata
        return View::make('fakultet.nastavnik.edit')
                        ->with('nastavnik', $n);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $rules = array(
            'imeNastavnik'=> 'required|max:20',
            'prezNastavnik' => 'required|max:25',
            'pbrStan' => 'required|numeric|size:5',
            'sifOrgjed' => 'required|numeric|max:10',
            'koef' => 'required|numeric'
        );
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to('nastavnik/' . $id . '/edit')
                            ->withErrors($validator)
                            ->withInput(Input::except('password'));
        } else {
            // store
           
            
                $nastavnik = Nastavnik::find($id);
             //   $student->mbrStud = Input::get('mbrStud');
            
            
            $nastavnik->imeNastavnik = Input::get('imeNastavnik');
            $nastavnik->prezNastavnik = Input::get('prezNastavnik');
            $nastavnik->pbrStan = Input::get('pbrStan');
            $nastavnik->sifOrgjed = Input::get('sifOrgjed');
            $nastavnik->koef = Input::get('koef');
            
            $nastavnik->save();
            return Redirect::to('nastavnik');
    
    }}

        // process the login
        if ($validator->fails()) {
            return Redirect::to('nastavnik/' . $id . '/edit')
                            ->withErrors($validator)
                            ->withInput(Input::except('password'));
        } else {
            // store
            $nastavnik = Nastavnik::find($id);
                     
            $nastavnik->imeNastavnik= Input::get('imeNastavnik');
            $nastavnik->prezNastavnik = Input::get('prezNastavnik');
            $nastavnik->pbrStan = Input::get('pbrStan');
            $nastavnik->sifOrgjed = Input::get('sifOrgjed');
            $nastavnik->koef = Input::get('koef');    
        
            $nastavnik->save();

            // redirect
            Session::flash('message', 'Uspjesno uređen nastavnik!');
            return Redirect::to('nastavnik');
    }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $n = Nastavnik::find($id);
        $n->delete();
        
        Session::flash('message', 'Nastavnik uspješno obrisan!');
        return Redirect::to('nastavnik');
    }
        /**
     * Ova funkcija vraća listu nastavnika sa najvećim koeficijentom
     * (zasad sa koef > 7.10)
     */
    function top() {
    $d1 = Nastavnik::all()
            ->where('koef', '>', '7.10')
            ->take(5);
    return "<h1>Nastavnici sa koeficijentom većim od 7.10, limit 5</h1><br>" 
.$d1;
//TODO želim ispisati samo ime i prezime nastavnika
//BUG Ispravi i ispisi top 10 nastavnika!    
//. $d1->attributes['imeNastavnik'];

    }
}
