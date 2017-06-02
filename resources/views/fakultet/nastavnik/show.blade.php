@extends('fakultet.master')
@section('title', 'Details about nastavnik')

@section('content')
<!-- will be used to show any messages -->
@if (Session::has('message'))
<div class="alert alert-info">{{ Session::get('message') }}</div>
@endif

<div><h1>{{ $nastavnici->imeNastavnik }} 

        <a class="btn btn-small btn-info" href="{{ URL::to('nastavnik/' . $nastavnici->sifNastavnik . '/edit') }}">
            Uredi nastavnika <span class="glyphicon glyphicon-edit"></span></a></h1></div>

<div class="jumbotron text-center">
    <h2>Nastavnik</h2>

    <p>
    <table>
        <tr><td style="text-align: right"> Ime:  </td>
            <td style="text-align: left; font-weight: bold"> {{$nastavnici->imeNastavnik}}</td></tr>
        <tr><td style="text-align: right"> Prezime:   </td>
            <td style="text-align: left; font-weight: bold"> {{$nastavnici->prezNastavnik}}</td></tr>
        <tr><td style="text-align: right"> Mjesto stanovanja:   </td>
            <td style="text-align: left; font-weight: bold"> {{ $nastavnici->pbrStan }}</td></tr>
        <tr><td style="text-align: right"> Organizacijska jedinica:   </td>
            <td style="text-align: left; font-weight: bold"> {{$nastavnici->sifOrgjed}}</td></tr>
        <tr><td style="text-align: right"> Koeficijent:   </td>
            <td style="text-align: left; font-weight: bold"> {{$nastavnici->koef}}</td></tr>

    </table>
</p>
</div>


@endsection

