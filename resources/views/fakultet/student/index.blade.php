@extends('fakultet.master')
@section('title', 'Svi studenti')

@section('content')
    <h1>Svi studenti</h1>
    <a href="{{ URL::to('studenti/create') }}">Kreiraj novog studenta</a>

<!-- will be used to show any messages -->
@if (Session::has('message'))
	<div class="alert alert-info">{{ Session::get('message') }}</div>
@endif

<table class="table table-striped table-bordered">
	<thead>
		<tr>
			<th>ID</th>
                        <th>Slika</th>
			<th>Ime i prezime</th>
                        
		</tr>
	</thead>
	<tbody>
	@foreach($studenti as $key => $value)
		<tr>
			<td>{{ $value->mbrStud }}</td>
                        <td class="text-center">@if ($value->slikaStud!=0)
<img src="/slike-studenata/thumb_{{$value->mbrStud}}.jpg" width="50">
@endif
</td>
			<td>{{ $value->imeStud }} {{ $value->prezStud }}</td>

			<!-- we will also add show, edit, and delete buttons -->
			<td>

				<!-- delete the nerd (uses the destroy method DESTROY /nerds/{id} -->
				<!-- we will add this later since its a little more complicated than the first two buttons -->
				{{ Form::open(array('url' => 'studenti/' . $value->mbrStud, 'class' => 'pull-right')) }}
					{{ Form::hidden('_method', 'DELETE') }}
					{{ Form::submit('Obrisi ovog studenta', array('class' => 'btn btn-warning','id'=>'student-del-'.$value->mbrStud)) }}
				{{ Form::close() }}

				<!-- show the nerd (uses the show method found at GET /nerds/{id} -->
				<a class="btn btn-small btn-success" id="{{'studenti-' . $value->mbrStud}}" href="{{ URL::to('studenti/' . $value->mbrStud) }}">Pokaži ovog studenta</a>

				<!-- edit this nerd (uses the edit method found at GET /nerds/{id}/edit -->
				<a class="btn btn-small btn-info" href="{{ URL::to('studenti/' . $value->mbrStud . '/edit') }}">Uredi ovog studenta</a>

			</td>
		</tr>
	@endforeach
	</tbody>
</table>
@endsection