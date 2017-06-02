@extends('fakultet.master')
@section('title', 'Sve Orgjedinice')

@section('content')
<h1>Svi orgjedi</h1>
<a href="{{ URL::to('orgjed/create') }}">Kreiraj novu orgjed</a>

<!-- will be used to show any messages -->
@if (Session::has('message'))
<div class="alert alert-info">{{ Session::get('message') }}</div>
@endif

<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>nazOrgjed i sifNadorgjed</th>
            <th>dugmad</th>
        </tr>
    </thead>
    <tbody>
        @foreach($orgjedi as $key => $value)
        <tr>
            <td>{{ $value->sifOrgjed }} </td>
            <td>{{ $value->nazOrgjed }} {{ $value->sifNadorgjed }}</td>

            <!-- we will also add show, edit, and delete buttons -->
            <td>


                <!-- we will add this later since its a little more complicated than the first two buttons -->
                {{ Form::open(array('url' => 'orgjed/' . $value->sifOrgjed, 'class' => 'pull-right')) }}
                {{ Form::hidden('_method', 'DELETE') }}
                {{ Form::submit('Obrisi ovu orgjed', array('class' => 'btn btn-warning','id'=>'student-del-'.$value->sifOrgjed)) }}
                {{ Form::close() }}

                <!-- show the nerd (uses the show method found at GET /nerds/{id} -->
                <a class="btn btn-small btn-success" id="{{'orgjed-' . $value->sifOrgjed}}" href="{{ URL::to('orgjed/' . $value->sifOrgjed) }}">Pokaži ovu orgjed</a>

                <!-- edit this nerd (uses the edit method found at GET /nerds/{id}/edit -->
                <a class="btn btn-small btn-info" href="{{ URL::to('orgjed/' . $value->sifOrgjed . '/edit') }}">Uredi ovu orgjed</a>

            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection