@extends('fakultet.master')
@section('title', 'Details')

@section('content')
<!-- will be used to show any messages -->
@if (Session::has('message'))
<div class="alert alert-info">{{ Session::get('message') }}</div>
@endif

<div><h1>{{ $nastavnici->imeStud }} 

        <a class="btn btn-small btn-info" href="{{ URL::to('nastavnik/' . $nastavnici->sifNastavnik . '/edit') }}">
            Uredi ovog studenta <span class="glyphicon glyphicon-edit"></span></a></h1></div>

<div class="jumbotron text-center">
    <h2>Nastavnik</h2>

    <p>
    <table>
        <tr><td style="text-align: right"> Ime:  </td>
            <td style="text-align: left; font-weight: bold"> {{$nastavnici->imeNastavnik}}</td></tr>
        <tr><td style="text-align: right"> Prezime:   </td>
            <td style="text-align: left; font-weight: bold"> {{$nastavnici->prezNastavnik}}</td></tr>
        <tr><td style="text-align: right"> Mjesto rođenja:   </td>
            <td style="text-align: left; font-weight: bold"> {{$nastavnici->pbrStan}} </td></tr>
        <tr><td style="text-align: right"> siforg:   </td>
            <td style="text-align: left; font-weight: bold"> {{$nastavnici->sifOrgjed}} </td></tr>
        <tr><td style="text-align: right"> kof:   </td>
            <td style="text-align: left; font-weight: bold"> {{$nastavnici->koef}} </td></tr>


    </table>
</div>


@endsection

