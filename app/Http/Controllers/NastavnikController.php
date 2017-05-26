<?php
// php artisan make:controller NastavnikController --resource
namespace Fakultet\Http\Controllers;

use Fakultet\Nastavnik;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
//use Illuminate\View\View;
use View;
use Input;
use Redirect;


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
        $n->sifNastavnik=999;
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
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
