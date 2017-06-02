
@extends('fakultet.master')
@section('title', 'Uredi orgjed')

@section('content')
<h1>Orgjed</h1>

<!-- will be used to show any messages -->
@if (Session::has('message'))
<div class="alert alert-info">{{ Session::get('message') }}</div>
@endif

{{ Form::open(array('url' => 'orgjed', 'files' => true)) }}



<div class="form-group">
    {{ Form::label('sifOrgjed', 'Šifra orgjed') }}
    {{ Form::text( 'sifOrgjed', Input::old('sifOrgjed'), array('class' => 'form-control')) }}
</div>

<div class="form-group">
    {{ Form::label('nazOrgjed', 'Naziv organizacijske jedinice') }}
    {{ Form::text( 'nazOrgjed', Input::old('nazOrgjed'), array('class' => 'form-control')) }}
</div>
<div class="form-group">
    {{ Form::label('sifNadorgjed', 'sifNadorgjed') }}
    {{ Form::text( 'sifNadorgjed',Input::old('sifNadorgjed') , array('class' => 'form-control')) }}
</div>

{{ Form::submit('Kreiraj novu orgjed!', array('class' => 'btn btn-primary')) }}

{{ Form::close() }}

@endsection
