<?php

namespace Fakultet;


use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Orgjed extends Model
{
    protected $table    = 'orgjed';
    protected $primaryKey='sifOrgjed';
    
    public    $fillable = [
        'nazOrgjed',
        'sifNadorgjed',
        ];
   
    public function setnazOrgjedAttribute($in){
        // Mutator
        $this->attributes['nazOrgjed']=  ucfirst($in);
    }
    public function setsifNadorgjedAttribute($in){
        // Mutator
        $this->attributes['sifNadorgjed']=  ucfirst($in);
    }  

/**
 * php artisan tinker
 * 
 * http://www.stillat.com/blog/2016/08/16/becoming-a-laravel-rock-star-with-artisan-tinker/
*/

/*
[pmrvic@partedmagic fakultet]$ php artisan tinker
Psy Shell v0.7.2 (PHP 7.0.14 — cli) by Justin Hileman
>>> $s=new Fakultet\Stud;
=> Fakultet\Stud {#714}
>>> $s->find(1120);
=> Fakultet\Stud {#739
     mbrStud: "1120",
     imeStud: "Zdenko",
     prezStud: "Kolac",
     pbrRod: "31000",
     pbrStan: "40000",
     datRodStud: "1985-06-06 00:00:00",
     jmbgStud: "0606985330186",
     created_at: "2016-12-15 10:21:23",
     updated_at: null,
   }

//Možemo i ovako:
>>> $z=new Fakultet\Zupanija;
=> Fakultet\Zupanija {#928}
$z->find(21)->mjesto->find(10000)->student_stan; 
$z->find(14)->mjesto()->find(31000)->student_rod; 
 
//RADI, JEDINO I ISPRAVNO !!!
 * >>> $s->find(1120)->mjesto_rod;
=> Fakultet\Mjesto {#869
     pbr: 31000,
     nazMjesto: "Osijek",
     sifZupanija: 14,
     created_at: null,
     updated_at: null,
   }
>>> $s->find(1120)->mjesto_rod->nazMjesto;
=> "Osijek"

// Možemo ovako ali nije elegantno:
$s= new Fakultet\Stud;
$s->find(1120);
$m= new Fakultet\Mjesto;
$m->find($s->find(1120)->pbrRod)->nazMjesto;
=> "Osijek"

 */

}
