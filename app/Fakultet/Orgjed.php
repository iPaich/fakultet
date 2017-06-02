<?php
namespace Fakultet;

use Illuminate\Database\Eloquent\Model;



class Orgjed extends Model
{
    protected $table    = 'orgjed';
    protected $primaryKey='sifOrgjed';
    
    public    $fillable = [
        'nazOrgjed',
        'sifNadorgjed',
        ];

}
