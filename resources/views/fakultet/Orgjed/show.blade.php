@extends('fakultet.master')
@section('title', 'Details')

@section('content')
<!-- will be used to show any messages -->
@if (Session::has('message'))
<div class="alert alert-info">{{ Session::get('message') }}</div>
@endif

<div><h1>{{ $orgjed->sifOrgjed }} 

        <a class="btn btn-small btn-info" href="{{ URL::to('orgjed/' . $orgjed->sifOrgjed . '/edit') }}">
            Uredi ovog studenta <span class="glyphicon glyphicon-edit"></span></a></h1></div>

<div class="jumbotron text-center">
    <h2> orgjed </h2>

    <p>
    <table>
        <tr><td style="text-align: right"> Nazorgjed:  </td>
            <td style="text-align: left; font-weight: bold"> {{$orgjed->nazOrgjed}}</td></tr>
        <tr><td style="text-align: right"> SifNadorgjed:   </td>
            <td style="text-align: left; font-weight: bold"> {{$orgjed->sifNadorgjed}}</td></tr>


    </table>
</p>
</div>


@endsection

