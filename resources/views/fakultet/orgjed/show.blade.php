@extends('fakultet.master')
@section('title', 'Details')

@section('content')
<!-- will be used to show any messages -->
@if (Session::has('message'))
<div class="alert alert-info">{{ Session::get('message') }}</div>
@endif

<div><h1>{{ $orgjedi->sifOrgjed }} 

        <a class="btn btn-small btn-info" href="{{ URL::to('orgjed/' . $orgjedi->sifOrgjed . '/edit') }}">
            Uredi ovu organizacijsku jedinicu <span class="glyphicon glyphicon-edit"></span></a></h1></div>

<div class="jumbotron text-center">
    <h2> orgjed </h2>

    <p>
    <table>
        <tr><td style="text-align: right"> Nazorgjed:  </td>
            <td style="text-align: left; font-weight: bold"> {{$orgjedi->nazOrgjed}}</td></tr>
        <tr><td style="text-align: right"> SifNadorgjed:   </td>
            <td style="text-align: left; font-weight: bold"> {{$orgjedi->sifNadorgjed}}</td></tr>


    </table>
</p>
</div>


@endsection

