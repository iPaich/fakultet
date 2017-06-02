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
@section('title', 'Uredi orgjed')

@section('content')
{{ print_r($errors) }}
<h1>Edit {{ $orgjed->nazOrgjed }}</h1>

<!-- will be used to show any messages -->
@if (Session::has('message'))
<div class="alert alert-info">{{ Session::get('message') }}</div>
@endif

{{ Form::model($orgjed, array('action' => array('orgjedController@update', $orgjed->sifOrgjed), 'method' => 'PUT', 'files' => true)) }}


<div class="form-group">
    {{ Form::label('sifOrgjed', 'sifOrgjed') }}
    {{ Form::text( 'sifOrgjed', Input::old('sifOrgjed'), array('class' => 'form-control','disabled'=>true)) }}
</div>
<div class="form-group">
    {{ Form::label('nazOrgjed', 'nazOrgjed') }}
    {{ Form::text( 'nazOrgjed', Input::old('nazOrgjed'), array('class' => 'form-control')) }}
</div>
<div class="form-group">
    {{ Form::label('sifNadorgjed', 'sifNadorgjed') }}
    {{ Form::text( 'sifNadorgjed',Input::old('sifNadorgjed') , array('class' => 'form-control')) }}
</div>

{{ Form::submit('Uredi studenta!', array('class' => 'btn btn-primary','name'=>'Uredi studenta')) }}

{{ Form::close() }}

@endsection
