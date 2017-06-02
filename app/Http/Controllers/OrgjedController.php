<?php
namespace Fakultet\Http\Controllers;
use Fakultet\Orgjed;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Session;
use Input;
use Validator;
use Redirect;
use View;

class OrgjedController extends Controller
{
  
    public function index()
    {
        $orgjedi = Orgjed::all()->reverse();

        return View::make('fakultet.orgjed.index')
                        ->with('orgjedi', $orgjedi);
    }


    public function create()
    {
        return View::make('fakultet.orgjed.create');
    }

    public function store(Request $request)
    {

        $n=new Orgjed;


        //TODO napravi validaciju
        $n = new Orgjed;
        $n->sifOrgjed=Input::get('sifOrgjed');
        $n->nazOrgjed=Input::get('nazOrgjed');
        $n->sifNadorgjed=Input::get('sifNadorgjed');
   
        //$n->sifNastavnik=999;
        $n->save();
        
        return Redirect::to('orgjed');
 

    }

    public function show($id)
    {
         $orgjedi = Orgjed::find($id);

        return View::make('fakultet.orgjed.show')
                        ->with('orgjedi', $orgjedi);
    }


    public function edit($id)
    {
          $orgjedi = Orgjed::find($id);


        return View::make('fakultet.orgjed.edit')
                        ->with('orgjedi', $orgjedi);
    }


    public function update(Request $request, $id)
    {
        $rules = array(
            'sifOrgjed'=>'required|max:20',
            'nazOrgjed'=> 'required|max:500',
            'sifNadorgjed' => 'required|max:25',

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
            
            $orgjed->sifOrgjed=Input::get('sifOrgjed');
            $orgjed->nazOrgjed = Input::get('nazOrgjed');
            $orgjed->sifNadorgjed = Input::get('sifNadorgjed');
            
            
            $orgjed->save();
            return Redirect::to('orgjed');
    
    }

        // process the login
        if ($validator->fails()) {
            return Redirect::to('orgjed/' . $id . '/edit')
                            ->withErrors($validator)
                            ->withInput(Input::except('password'));
        } else {
            // store
            $orgjed = Orgjed::find($id);
            $orgjed->sifOrgjed=Input::get('sifOrgjed');
            $orgjed->nazOrgjed= Input::get('nazOrgjed');
            $orgjed->sifNadorgjed = Input::get('sifNadorgjed');
         
            $orgjed->save();

            // redirect
            Session::flash('message', 'Uspjesno uređena Orgjedinica!');
            return Redirect::to('orgjed');
    }
    }

    public function destroy($id)
    {
        $n = Orgjed::find($id);
        $n->delete();
        
        Session::flash('message', 'orgjedinica uspješno obrisana!');
        return Redirect::to('orgjed');
    }

    
}

