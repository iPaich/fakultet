@extends('fakultet.master')
@section('title', 'Svi nastavnici')
@section('content')
    <h1>Svi Nastavnici</h1>
    <a href="{{ URL::to('nastavnik  /create') }}">Kreiraj novog nastavnika</a>

<!-- will be used to show any messages -->
@if (Session::has('message'))
	<div class="alert alert-info">{{ Session::get('message') }}</div>
@endif
<ol>
        @foreach ($nastavnici as $nastavnik)
        This is user {{ $nastavnik->sifNastavnik }} {{ $nastavnik->imeNastavnik }} <br>
        @endforeach
</ol>

@endsection