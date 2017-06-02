<?php
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/


Route::get('/nastavnik/all', function(){
    $d1= Fakultet\Nastavnik::all();
    return "<h1>Svi nastavnici</h1><br>". $d1;
});
Route::get('/nastavnik/top', 'NastavnikController@top');



Route::get('/ispit', 'ispitController@ispit');
Route::post('/ispit','ispitController@rezultat');

/**
 * Direktno sa Route -> Model -> Db
 * @todo DOhvati sve studente iz Osijeka
 */
Route::get('/studloc/{pbr}', 'StudController@studloc');

Route::get('/studenti/stats', 'StudController@stats');

Route::get('/dvorane', function () {
    $d=Fakultet\Dvorana::all();
    //$d::all(['kapacitet','oznDvorana']);
    //dd($d);
    foreach ($d as $dvorana){
        printf("%s %s <br>",$dvorana->oznDvorana,$dvorana->kapacitet);

        
        //attributes['nazZupanija'];
    }
    //return view('child');
})->name('svedvorane');


Route::get('m', 'mathController@index');
Route::get('orgjed', 'orgjedController@index');


// Osnovne matematičke operacije
Route::get('m/{br1}/{br2}/{op}', 'mathController@rezultat');

Route::get('/glavni', function () {
    return view('child');
});


Route::get('/fakultet', function () {
    return view('fakultet.index');
});
Route::get('/mjesto-zupanija', function(){
    //$comments = App\Post::find(1)->comments;
/*
    foreach ($comments as $comment) {
//
}
 * */
 
    $lista_mjesta=Fakultet\Zupanija::all();
   dd($lista_mjesta);
});

Route::get('/show-key', function(){
    var_dump( $_ENV['APP_KEY']);
    echo "<br>";
    $_ENV['proba']="neki text";
    echo $_ENV['DB_USERNAME'];
    dd($_ENV);
});

// Ovako isprintamo composer.json
Route::get('/get-composer-json', function(){
    $string = file_get_contents(base_path()."/composer.json");
    $json_a = json_decode($string, true);
   

    // This will dump and die, can also print_r($json_a);
    // CTRL-CLICK za expand all
    dd($json_a);
});
    

Route::get('/', function () {
    return view('welcome');
});
Route::get('/123', function () {
    return "xxx";
});


//Fakultet aplikacija
Route::get('/mjesto-ajax', function () {
    return view('fakultet.mjesto.index');
});

Route::resource('mjesto',   'MjestoController');
Route::resource('zupanija', 'ZupanijaController');
Route::resource('studenti', 'StudController');
Route::resource('nastavnik', 'NastavnikController');
Route::resource('dvorana', 'DvoranaController');
Route::resource('orgjed', 'OrgjedController');

Route::get('/laravel-version', function()
{
$laravel = app();
return "Your Laravel version is ".$laravel::VERSION;
});
