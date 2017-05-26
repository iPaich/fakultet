@extends('fakultet.master')
@section('title', 'Svi nastavnici')

@section('content')
<h1>Svi nastavnici</h1>

<a href="{{ URL::to('nastavnik/create') }}">Kreiraj novog nastavnika</a>

<!-- will be used to show any messages -->
@if (Session::has('message'))
<div class="alert alert-info">{{ Session::get('message') }}</div>
@endif

@component('fakultet.nastavnik.popularni_nastavnik')
    <strong>Naš najpopulariji nastavnik je:</strong> 
    
    
    @slot('popnastavnik_eloquent')
        Forbidden
    @endslot
   
    @slot('popnastavnik_rawsql')
        Forbidden
    @endslot
@endcomponent
<br>

<ol>    
    @foreach($nastavnici as $key => $value)
    <li>{{ $value->imeNastavnik }} {{ $value->sifNastavnik }}</li>

    @endforeach
</ol>
@endsection

