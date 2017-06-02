<?php

namespace Fakultet\Http\Controllers;


use Fakultet\Mjesto;
use Fakultet\Stud;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Khill\Lavacharts\Lavacharts;
use View;
use function public_path;

class StudController extends Controller {
   
    /**
     * Vraća statistiku u obliku google charts grafova
     *
     * @return Response
     */
    public function stats() {

$lava = new Lavacharts; // See note below for Laravel

// DEFAULT regija WORLD

$popularity = \Lava::DataTable();

$popularity->addStringColumn('Country')
           ->addNumberColumn('Popularity')
           ->addRow(array('Germany', 200))
           ->addRow(array('United States', 300))
           ->addRow(array('Brazil', 400))
           ->addRow(array('Canada', 500))
           ->addRow(array('France', 600))
           ->addRow(array('RU', 700));
 
\Lava::GeoChart('Popularity', $popularity); 

// REGIJA ITALIJA

$itpop = \Lava::DataTable();
$itpop->addStringColumn('City')
        ->addNumberColumn('Population')
        ->addNumberColumn('Area')
        ->addRow(array('Rome',      2761477,    1285.31))
        ->addRow(array('Milan',     1324110,    181.76))
        ->addRow(array('Naples',    959574,     117.27))
        ->addRow(array('Turin',     907563,     130.17))
        ->addRow(array('Palermo',   655875,     158.9))
        ->addRow(array('Genoa',     607906,     243.60))
        ->addRow(array('Bologna',   380181,     140.7))
        ->addRow(array('Florence',  371282,     102.41))
        ->addRow(array('Fiumicino', 67370,      213.44))
        ->addRow(array('Anzio',     52192,      43.43))
        ->addRow(array('Ciampino',  38262,      11));


\Lava::GeoChart('ITPopularity', $itpop, [
    'region'=>'IT',
    'displayMode'=> 'markers']);


//  Krivulje

$finances = \Lava::DataTable();

$finances->addDateColumn('Year')
         ->addNumberColumn('Sales')
         ->addNumberColumn('Expenses')
         ->addNumberColumn('Net Worth')
         ->addRow(['2009-1-1', 1100, 490, 1324])
         ->addRow(['2010-1-1', 1000, 400, 1524])
         ->addRow(['2011-1-1', 1400, 450, 1351])
         ->addRow(['2012-1-1', 1250, 600, 1243])
         ->addRow(['2013-1-1', 1100, 550, 1462]);

\Lava::ComboChart('Finances', $finances, [
    'title' => 'Company Performance',
    'titleTextStyle' => [
        'color'    => 'rgb(123, 65, 89)',
        'fontSize' => 16
    ],
    'legend' => [
        'position' => 'in'
    ],
    'seriesType' => 'bars',
    'series' => [
        2 => ['type' => 'line']
    ]
]);
 
//  TREBA DODATI OVU ODLIČNU STATISTIKU
/*
 * 
 * 
SELECT 
stud.mbrStud,
stud.imeStud,
stud.prezStud, 
AVG(ispit.ocjena) AS prosjek, 
COUNT(ispit.ocjena) AS brojpolozenih, 
SUM(ispit.ocjena) AS zbrojocjena,
(COUNT(ispit.ocjena)*SUM(ispit.ocjena)) AS rank, 
YEAR(datIspit) godina
FROM stud RIGHT JOIN ispit on stud.mbrStud=ispit.mbrStud
WHERE ocjena>1  
GROUP BY godina, stud.mbrStud 
ORDER BY godina ASC,rank DESC, brojpolozenih DESC, prosjek DESC;
 * 
 * 
 */
$query="
SELECT 
stud.mbrStud,
stud.imeStud,
stud.prezStud, 
AVG(ispit.ocjena) AS prosjek, 
COUNT(ispit.ocjena) AS brojpolozenih, 
SUM(ispit.ocjena) AS zbrojocjena, 
(COUNT(ispit.ocjena)*SUM(ispit.ocjena)/10) AS rank, 
YEAR(datIspit) godina 
FROM stud RIGHT JOIN ispit on stud.mbrStud=ispit.mbrStud 
WHERE ocjena>1  
GROUP BY godina, stud.mbrStud,stud.imeStud,stud.prezStud  
ORDER BY godina ASC,rank DESC, brojpolozenih DESC, prosjek DESC 
LIMIT 0,10 ;
";
$statstable= \Illuminate\Support\Facades\DB::select($query);


//dd($statstable);
$studranked = \Lava::DataTable();

$studranked->addStringColumn('Imena')
         ->addNumberColumn('Sales')
         ->addNumberColumn('Expenses')
         ->addNumberColumn('Net Worth');
foreach ($statstable as $s){
$studranked->addRow(
        [$s->imeStud.' '.$s->prezStud
        , $s->prosjek
        , $s->brojpolozenih
        , $s->rank]);
}
  // dd($studranked)    ;  

\Lava::ComboChart('Studranked', $studranked, [
    'title' => 'Rank za rektorovu nagradu',
    'titleTextStyle' => [
        'color'    => 'rgb(123, 65, 89)',
        'fontSize' => 16
    ],
    'legend' => [
        'position' => 'in'
    ],
    'seriesType' => 'bars',
    'series' => [
        2 => ['type' => 'line']
    ]
]);


        
        return View::make('fakultet.student.stats')
                        ->with('lava', $lava);
    }

    
///////////////////////////////////////////////
/*
 * 
 *             CRUD STUDENT
 * 
 * 
 */
///////////////////////////////////////////////
    
public function studloc($pbr) {
        $m = new Mjesto;
        $os = $m->find($pbr)->student_rod->first();

        echo "<h2>Prvi student iz mjesta "
        . $m->find($pbr)->nazMjesto
        . " sa matičnim br:"
        . $os->mbrStud
        . "</h2>";
        echo $os->imeStud . " " . $os->prezStud;

        $svios = $m->find($pbr)->student_rod->toArray();

        echo "<h2>Svi studenti iz " . $m->find($pbr)->nazMjesto . " ARRAY</h2>";
        echo "<ol>";
        foreach ($svios as $oosj) {
            echo "<li>" . $oosj['imeStud']
            . " "
            . $oosj['prezStud'] . "</li>";
        }
        echo "</ol>";

        echo "<h2>Svi studenti iz " . $m->find($pbr)->nazMjesto . " DIREKTNO</h2>";

        $svios = $m->find($pbr)->student_rod;
        echo "<ol>";
        foreach ($svios as $oosj) {
            printf("<li>%s %s </li>", $oosj->imeStud, $oosj->prezStud);
        }
        echo "</ol>";
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        $studenti = Stud::all()->reverse();

        return View::make('fakultet.student.index')
                        ->with('studenti', $studenti);
        
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {
        return View::make('fakultet.student.create');
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
            'imeStud' => 'required',
            'prezStud' => 'required',
            'pbrRod' => 'required|numeric|size:5',
            'pbrStan' => 'required|numeric|size:5',
          //  'datRodStud' => 'required|date||date_format:Y-n-j',
            'datRodStud' => 'required|date|date_format:"Y-m-d"',
            'jmbgStud' => 'required'
            
        );
      
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            //echo Input::get('datRodStud');
            
            return Redirect::to('studenti/create')
                            ->withErrors($validator)
                            ->withInput(Input::except('password'));
        } else {
            // store
/*
             $rules = array(
        //    'mbrStud' => 'required|numeric',
            'imeStud' => 'required',
            'prezStud' => 'required',
            'pbrRod' => 'required|numeric',
            'pbrStan' => 'required|numeric',
            'datRodStud' => 'required|date|date_format:Y-n-j',
            'jmbgStud' => 'required'
        );
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to('studenti/create')
                            ->withErrors($validator)
                            ->withInput(Input::except('password'));
        } else {
            // store
          */
               $student = new Stud;
   // mbrstud se dodjeljuje automatski jer je u modelu Student postavljen
   // pogledaj >>>  migrations/2016_11_03_231443_create_stud_table
   // $table->increments('mbrStud');
   //     $student->mbrStud = Input::get('mbrStud');
            
            $student->imeStud = Input::get('imeStud');
            $student->prezStud = Input::get('prezStud');
            $student->pbrRod = Input::get('pbrRod');
            $student->pbrStan = Input::get('pbrStan');
            $student->datRodStud = Input::get('datRodStud');
            $student->jmbgStud = Input::get('jmbgStud');
            // Prvo kreiramo studenta da nam dodjeli autoincrement mbrStud
            $student->slikaStud = 0;// Input::get('slikaStud');

            $student->save();
            
            // Pokušaj uploadati sliku
            try {
  

            if (Input::hasFile('photo')) {
                // Ovo istoradi, alteranativa je dolje...
                /*
                  $request->file('photo')->move(
                  base_path() . '/public/slike-studenata/', 'maja.jpg'
                  );
                 */
                $imageName = $student->mbrStud;
                $imageExtension = $request->photo->getClientOriginalExtension();
                $request->photo->move(public_path('slike-studenata'), $imageName . "." . $imageExtension);

// RESIZE SLIKE I KREIRANJE THUMBNAILA
                // Get new sizes

                $filename = public_path('slike-studenata') . DIRECTORY_SEPARATOR . $imageName . "." . $imageExtension; //'test.jpg';
                list($width, $height) = getimagesize($filename);

// generate thumbnail
                $newwidth = 100;
                $newheight = $height * ($newwidth / $width);

// Load
                $thumb = imagecreatetruecolor($newwidth, $newheight);
                $source = imagecreatefromjpeg($filename);

// Resize
                imagecopyresized($thumb, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
                imagejpeg($thumb, public_path('slike-studenata') . DIRECTORY_SEPARATOR . 'thumb_' . $imageName . "." . $imageExtension, 75);
           
                $newwidth = 400;
                $newheight = $height * ($newwidth / $width);

// Load
                $thumb = imagecreatetruecolor($newwidth, $newheight);
                $source = imagecreatefromjpeg($filename);

// Resize
                imagecopyresized($thumb, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);

//Sacuvaj resizanu sliku
                imagejpeg($thumb, public_path('slike-studenata') . DIRECTORY_SEPARATOR . $imageName . "." . $imageExtension, 75);

                
            }
            if (file_exists(public_path('slike-studenata' . DIRECTORY_SEPARATOR . $student->mbrStud . ".jpg"))) {
                $student->slikaStud = 1;
            } else {
                $student->slikaStud = 0;
            }
            $student->save();
            } catch (Exception $e) {
            // Ukoliko upload ne odradi javi poruku
            Session::flash('message', 'Student je kreiran ali nije uspio upload slike: '.$e->getMessage());
            return Redirect::to('studenti');
}

           
            
            
            
            // redirect
            Session::flash('message', 'Uspjesno kreiran student!');
            
            return Redirect::to('studenti');
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
        $s = Stud::find($id);
        //return $s->mjesto_rod->nazMjesto;
        return View::make('fakultet.student.show')
                        ->with('student', $s);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id) {
        $student = Stud::find($id);

        // Pokazi formu za editiranje studenata
        return View::make('fakultet.student.edit')
                        ->with('student', $student);
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
            'imeStud' => 'required',
            'prezStud' => 'required',
            'pbrRod' => 'required|numeric',
            'pbrStan' => 'required|numeric',
            'datRodStud' => 'required|date|date_format:Y-n-j',
            'jmbgStud' => 'required'
        );
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to('studenti/' . $id . '/edit')
                            ->withErrors($validator)
                            ->withInput(Input::except('password'));
        } else {
            // store
           
            
                $student = Stud::find($id);
             //   $student->mbrStud = Input::get('mbrStud');
            
            
            $student->imeStud = Input::get('imeStud');
            $student->prezStud = Input::get('prezStud');
            $student->pbrRod = Input::get('pbrRod');
            $student->pbrStan = Input::get('pbrStan');
            $student->datRodStud = Input::get('datRodStud');
            $student->jmbgStud = Input::get('jmbgStud');
            // $student->slikaStud = Input::get('slikaStud');
     
            if (Input::hasFile('photo')) {
                // Ovo istoradi, alteranativa je dolje...
                /*
                  $request->file('photo')->move(
                  base_path() . '/public/slike-studenata/', 'maja.jpg'
                  );
                 */
                $imageName = $student->mbrStud;
                $imageExtension = $request->photo->getClientOriginalExtension();

                $request->photo->move(public_path('slike-studenata'), $imageName . "." . $imageExtension);

// RESIZE SLIKE I KREIRANJE THUMBNAILA
                // Get new sizes

                $filename = public_path('slike-studenata') . DIRECTORY_SEPARATOR . $imageName . "." . $imageExtension; //'test.jpg';

                list($width, $height) = getimagesize($filename);

// generate thumbnail
                                $newwidth = 100;
                $newheight = $height * ($newwidth / $width);

// Load
                $thumb = imagecreatetruecolor($newwidth, $newheight);
                $source = imagecreatefromjpeg($filename);

// Resize
                imagecopyresized($thumb, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
                imagejpeg($thumb, public_path('slike-studenata') . DIRECTORY_SEPARATOR . 'thumb_' . $imageName . "." . $imageExtension, 75);
           
                                $newwidth = 400;
                $newheight = $height * ($newwidth / $width);

// Load
                $thumb = imagecreatetruecolor($newwidth, $newheight);
                $source = imagecreatefromjpeg($filename);

// Resize
                imagecopyresized($thumb, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);

//Sacuvaj resizanu sliku
                imagejpeg($thumb, public_path('slike-studenata') . DIRECTORY_SEPARATOR . $imageName . "." . $imageExtension, 75);

                
            }
            if (file_exists(public_path('slike-studenata' . DIRECTORY_SEPARATOR . $student->mbrStud . ".jpg"))) {
                $student->slikaStud = 1;
            } else {
                $student->slikaStud = 0;
            }

            $student->save();

            // redirect
            Session::flash('message', 'Uspjesno uređen student!');
            return Redirect::to('studenti');
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
        $s = Stud::find($id);
        $s->delete();

        // Prilikom brisanja obrisi i sliku i thumbnail ukoliko postoje
        try{
        $filename       = public_path('slike-studenata') . DIRECTORY_SEPARATOR. $s->mbrStud . ".jpg"; 
        $filename_thumb = public_path('slike-studenata') . DIRECTORY_SEPARATOR. "thumb_" . $s->mbrStud . ".jpg"; 
        if (file_exists($filename)){
            unlink($filename);
        }
        if (file_exists($filename_thumb)){
            unlink($filename_thumb);
        }
        }
 catch (Exception $e){
     
 }
        // redirect
        Session::flash('message', 'Student uspješno obrisan!');
        return Redirect::to('studenti');
    }

}
