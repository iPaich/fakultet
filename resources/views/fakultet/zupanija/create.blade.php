@extends('fakultet.master')
@section('title', 'Kreirajte novu Županiju')

@section('content')
<h1>Dodaj novu županiju</h1>

<!-- will be used to show any messages -->
@if (Session::has('message'))
	<div class="alert alert-info">{{ Session::get('message') }}</div>
@endif

{{ Form::open(array('url' => 'zupanija')) }}


	<div class="form-group">
		{{ Form::label('sifZupanija', 'Broj županije') }}
		{{ Form::number('sifZupanija', Input::old('sifZupanija'), array('class' => 'form-control')) }}
	</div>
	<div class="form-group">
		{{ Form::label('nazZupanija', 'Ime županije') }}
		{{ Form::text('nazZupanija', Input::old('nazZupanija'), array('class' => 'form-control')) }}
	</div>


	{{ Form::submit('Dodaj novu županiju!', array('class' => 'btn btn-primary','id'=>'zupanija-dodaj')) }}

{{ Form::close() }}

@endsection
 