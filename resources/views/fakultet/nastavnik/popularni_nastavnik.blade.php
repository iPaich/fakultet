<div class="alert alert-info">
    
<!--  slot je kao parent kod sectiona, zadržava prethodni sadržaj placeholdera -->
    {{ $slot }}

<?php
/**
 * 
 * Pokušavamo dobit nastavnika koji studentima u prosjeku daje najveće ocjene
 * ukupna suma ocijena mora biti veća od 50 kako bi eliminirali one koji imaju mali uzorak
 * 
 */


////////////////////////////////////////
// ELOQUENT 
$popnastavnik_eloquent = \Illuminate\Support\Facades\DB::table('nastavnik')
        ->join('ispit', 'nastavnik.sifNastavnik', '=', 'ispit.sifNastavnik')
        ->select(DB::raw('concat(nastavnik.imeNastavnik," ",nastavnik.prezNastavnik) AS ime')
                , 'nastavnik.sifNastavnik AS sifra'
                , DB::raw('AVG(ispit.ocjena) AS prosjek')
                , DB::raw('sum(ispit.ocjena) AS ukupno')
        )
        ->groupBy('nastavnik.sifNastavnik', 'ime')
        ->having(DB::raw('sum(ispit.ocjena)'), '>', 50)
        ->orderBy(DB::raw('AVG(ispit.ocjena)'), 'desc')
        ->get();

////////////////////////////////////////
// 'ČISTI' SQL način:
$popnastavnik_rawsql = Illuminate\Support\Facades\DB::select('
SELECT
sifra
, ime
, prosjek
, ukupno
FROM(
SELECT
fakultet.nastavnik.sifNastavnik as sifra
,CONCAT(fakultet.nastavnik.imeNastavnik," ",fakultet.nastavnik.prezNastavnik) AS ime
, AVG(fakultet.ispit.ocjena) AS prosjek
, sum(fakultet.ispit.ocjena) AS ukupno
FROM fakultet.ispit inner join fakultet.nastavnik ON fakultet.ispit.sifNastavnik=fakultet.nastavnik.sifNastavnik
GROUP BY
fakultet.nastavnik.sifNastavnik, fakultet.nastavnik.imeNastavnik, fakultet.nastavnik.prezNastavnik
) AS prva
WHERE ukupno > 50 #ne broje se oni koji su dali manje od 10 petica
ORDER BY prosjek DESC
LIMIT 1
');
    ?>
    <span style="font-style: italic"> (Pomoću eloquenta) </span>

    <span style="font-weight: bold">
        {{ $popnastavnik_eloquent=$popnastavnik_eloquent[0]->ime}}
    </span>

    &nbsp;&nbsp;&nbsp;

    <span style="font-style: italic">  (Pomoću direktnog SQL poziva) </span>
    <span style="font-weight: bold">
        {{ $popnastavnik_rawsql=$popnastavnik_rawsql[0]->ime}}
    </span>
</div>



<!--
# Ovo radi kao direktan poziv MYSQL-u ali ne i preko laravela
SELECT
fakultet.nastavnik.sifNastavnik
,CONCAT(fakultet.nastavnik.imeNastavnik," ",fakultet.nastavnik.prezNastavnik)
, AVG(fakultet.ispit.ocjena) AS prosjek
, sum(fakultet.ispit.ocjena) AS ukupno
FROM fakultet.ispit inner join fakultet.nastavnik ON fakultet.ispit.sifNastavnik=fakultet.nastavnik.sifNastavnik
GROUP BY fakultet.nastavnik.sifNastavnik
HAVING ukupno > 50 #ne broje se oni koji su dali manje od 10 petica
ORDER BY prosjek DESC
LIMIT 1;


-->