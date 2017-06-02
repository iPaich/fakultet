<?php

namespace Fakultet\Http\Controllers;
use Fakultet\Orgjed;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Validator;
use Illuminate\View\View;
use Symfony\Component\Console\Input\Input;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpKernel\Tests\Controller;








class OrgjedController extends Controller {

///////////////////////////////////////////////
/*
 * 
 *             CRUD STUDENT
 * 
 * 
 */
///////////////////////////////////////////////
    

    public function index() {
        $orgjed = orgjed::all()->reverse();

        return View::make('fakultet.orgjed.index');
        
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {
        return View::make('fakultet.orgjed.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request) {
               // validate
        // read more on validation at http://laravel.com/docs/validation
        $rules = array(
          // 'mbrStud' => 'required|numeric',
            'nazOrgjed' => 'required',
            'sifNadorgjed' => 'required',
            
        );
      
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            
            return Redirect::to('orgjed/create')
                            ->withErrors($validator)
                            ->withInput(Input::except('password'));
        } else {

               $orgjed = new Orgjed;
   // mbrstud se dodjeljuje automatski jer je u modelu Student postavljen
   // pogledaj >>>  migrations/2016_11_03_231443_create_stud_table
   // $table->increments('mbrStud');
   //     $student->mbrStud = Input::get('mbrStud');
            
            $orgjed->nazOrgjed = Input::get('nazOrgjed');
            $orgjed->sifNadorgjed= Input::get('sifNadorgjed');

            $orgjed->save();
            
           
            Session::flash('message', 'Uspjesno kreirana orgjed!');
            
            return Redirect::to('orgjed');
    }
    }
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id) {
        // Dohvati studenta sa primarnim ključem npr:
        // http://localhost:8000/studenti/1120
        $s = Orgjed::find($id);
        //return $s->mjesto_rod->nazMjesto;
        return View::make('fakultet.orgjed.show')
                        ->with('orgjed', $s);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id) {
        $orgjed = Orgjed::find($id);

        // Pokazi formu za editiranje studenata
        return View::make('fakultet.orgjed.edit')
                        ->with('orgjed', $orgjed);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id) {
        // validate
        // read more on validation at http://laravel.com/docs/validation
        $rules = array(
           // 'mbrStud' => 'required|numeric',
            'nazOrgjed' => 'required',
            'sifNadorgjed' => 'required',
        );
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to('orgjed/' . $id . '/edit')
                            ->withErrors($validator)
                            ->withInput(Input::except('password'));
        } else {
            // store
           
            
                $orgjed = Orgjed::find($id);
             //   $student->mbrStud = Input::get('mbrStud');
            
            
            $orgjed->nazOrgjed = Input::get('nazOrgjed');
            $orgjed->sifNadorgjed = Input::get('sifNadorgjed');
          
           
            $orgjed->save();

            // redirect
            Session::flash('message', 'Uspjesno uređena orgjed!');
            return Redirect::to('orgjed');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id) {
        // delete
        $s = Orgjed::find($id);
        $s->delete();

        
        // redirect
        Session::flash('message', 'Orgjed uspješno obrisana!');
        return Redirect::to('orgjed');
    }

}
