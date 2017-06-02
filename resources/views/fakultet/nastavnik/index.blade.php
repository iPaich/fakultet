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

<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Ime i prezime</th>
<th></th>

        </tr>
    </thead>
    <tbody>
        @foreach($nastavnici as $key => $value)
        <tr>
            <td>{{ $value->sifNastavnik}}</td>
            <td>{{ $value->imeNastavnik }} {{ $value->prezNastavnik}}</td>

            <!-- we will also add show, edit, and delete buttons -->
            <td>


                <!-- we will add this later since its a little more complicated than the first two buttons -->
                {{ Form::open(array('url' => 'nastavnik/' . $value->sifNastavnik, 'class' => 'pull-right')) }}
                {{ Form::hidden('_method', 'DELETE') }}
                {{ Form::submit('Obrisi ovog nastavnika'
                    , array('class' => 'btn btn-warning'
                    ,'id'=>'nastavnik-del-'.$value->sifNastavnik)) }}
                {{ Form::close() }}

                <!-- show the nerd (uses the show method found at GET /nerds/{id} -->
                <a class="btn btn-small btn-success" id="{{'nastavnik-' . $value->sifNastavnik}}" href="{{ URL::to('nastavnik/' . $value->sifNastavnik) }}">Pokaži nastavnika</a>

                <!-- edit this nerd (uses the edit method found at GET /nerds/{id}/edit -->
                <a class="btn btn-small btn-info" href="{{ URL::to('nastavnik/' . $value->sifNastavnik . '/edit') }}">Uredi nastavnika</a>

            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection

