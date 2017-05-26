<!--

NEDOVRSENO   !!!!
Treba:
- prilagoditi tip polja podacima iz baze
- stilski posloziti formula
- validator za text
- validator duljine pbr-a 
- validator datuma rodjenja

-->

<!-- resources/views/fakultet/student/edit.blade.php -->
@extends('fakultet.master')
@section('title', 'Uredi studenta')

@section('content')
<h1>Dodaj novog studenta</h1>

<!-- will be used to show any messages -->
@if (Session::has('message'))
<div class="alert alert-info">{{ Session::get('message') }}</div>
@endif

{{ Form::open(array('url' => 'nastavnik', 'files' => true)) }}

 {{-- 
<div class="form-group">
    {{ Form::label('mbrStud', 'Matični broj studenta') }}
    {{ Form::text( 'mbrStud', Input::old('mbrStud'), array('class' => 'form-control')) }}
</div>
 --}} 
<div class="form-group">
    {{ Form::label('imeNastavnik', 'Ime nastavnika') }}
    {{ Form::text( 'imeNastavnik', Input::old('imeNastavnik'), array('class' => 'form-control')) }}
</div>
 
<div class="form-group">
    {{ Form::label('prezNastavnik', 'Prezime nastavnika') }}
    {{ Form::text( 'prezNastavnik',Input::old('prezNastavnik') , array('class' => 'form-control')) }}
</div>
 
<div class="form-group">
    {{ Form::label('pbrStan', 'Mjesto stanovanja') }}
    {{ Form::text( 'pbrStan', Input::old('pbrStan'), array('class' => 'form-control')) }}
    
<div class="form-group">
    {{ Form::label('sifOrgjed', 'Sifra organizacijske jedinice') }}
    {{ Form::text( 'sifOrgjed', Input::old('sifOrgjed'), array('class' => 'form-control')) }}
</div>
    <div class="form-group">
    {{ Form::label('koef', 'koeficijent') }}
    {{ Form::text( 'koef', Input::old('koef'), array('class' => 'form-control')) }}
</div>
</div>

{{ Form::submit('Kreiraj novog nastavnika!', array('class' => 'btn btn-primary')) }}

{{ Form::close() }}

@endsection
