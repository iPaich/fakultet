<!--

NEDOVRSENO   !!!!
Treba:
//TODO - prilagoditi tip polja podacima iz baze
//TODO - stilski posloziti formula
//TODO - validator za text
//TODO - validator duljine pbr-a 
//TODO - validator datuma rodjenja

-->

<!-- resources/views/fakultet/nastavnik/edit.blade.php -->
@extends('fakultet.master')
@section('title', 'Uredi nastavnika')

@section('content')
<h1>Uredi nastavnika</h1>

<!-- will be used to show any messages -->
@if (Session::has('message'))
<div class="alert alert-info">{{ Session::get('message') }}</div>
@endif

{{ Form::model($nastavnik, array('action' => array('NastavnikController@update', $nastavnik->sifNastavnik), 'method' => 'PUT', 'files' => true)) }}
 
<div class="form-group">
    {{ Form::label('imeNastavnik', 'Ime nastavnika') }}
    {{ Form::text( 'imeNastavnik', Input::old('imeNastavnik'), array('class' => 'form-control','required' => 'required')) }}
</div>
<div class="form-group">
    {{ Form::label('prezNastavnik', 'Prezime nastavnika') }}
    {{ Form::text( 'prezNastavnik',Input::old('prezNastavnik') , array('class' => 'form-control','required' => 'required')) }}
</div>
<div class="form-group">
    {{ Form::label('pbrStan', 'Mjesto stanovanja') }}
    {{ Form::number( 'pbrStan', Input::old('pbrStan'), array('class' => 'form-control','required' => 'required')) }}
</div>

<div class="form-group">
    {{ Form::label('sifOrgjed', 'Šifra organizacijske jedinice') }}
    {{ Form::number('sifOrgjed', Input::old('sifOrgjed'), array('class' => 'form-control', 'required' => 'required')) }}     
</div>
<div class="form-group">
    {{ Form::label('koef', 'Koeficijent') }}
    {{ Form::number( 'koef', Input::old('koef'), array('class' => 'form-control','required' => 'required')) }}
</div>

{{ Form::submit('Uredi nastavnika!', array('class' => 'btn btn-primary')) }}

{{ Form::close() }}

@endsection
