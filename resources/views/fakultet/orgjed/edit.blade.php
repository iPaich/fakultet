
@extends('fakultet.master')
@section('title', 'Uredi orgjed')
@section('content')
<h1>Edit Organizacijsku jedinicu</h1>

<!-- will be used to show any messages -->
@if (Session::has('message'))
<div class="alert alert-info">{{ Session::get('message') }}</div>
@endif
{{ Form::model($orgjedi, array('action' => array('OrgjedController@update', $orgjedi->sifOrgjed), 'method' => 'PUT', 'files' => true)) }}
<div class="form-group">
    {{ Form::label('sifOrgjed', 'sifOrgjed') }}
    {{ Form::text( 'sifOrgjed', Input::old('sifOrgjed'), array('class' => 'form-control')) }}
</div>
<div class="form-group">
    {{ Form::label('nazOrgjed', 'nazOrgjed') }}
    {{ Form::text( 'nazOrgjed', Input::old('nazOrgjed'), array('class' => 'form-control')) }}
</div>
<div class="form-group">
    {{ Form::label('sifNadorgjed', 'sifNadorgjed') }}
    {{ Form::text( 'sifNadorgjed',Input::old('sifNadorgjed') , array('class' => 'form-control')) }}
</div>

{{ Form::submit('Uredi organizacijsku jedinicu!', array('class' => 'btn btn-primary','name'=>'Uredi organizacijsku jedinicu')) }}

{{ Form::close() }}

@endsection
