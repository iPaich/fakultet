@extends('fakultet.master')
@section('title', 'Dobrodošli na Algebrin fakultet')

@section('content')
    <h1>Ukupno ima{{ $mjestos->total() }} Mjesta</h1>
    <strong> stranica {{ $mjestos->currentPage() }} od {{ $mjestos->lastPage() }}</strong><br>
    <a href="{{ URL::to('mjesto/create') }}">Kreiraj novu mjesto</a>

<!-- will be used to show any messages -->
@if (Session::has('message'))
	<div class="alert alert-info">{{ Session::get('message') }}</div>
@endif

{{ $mjestos->links() }}
<table class="table table-striped table-bordered">
	<thead>
		<tr>
			<th>Poštanski broj</th>
			<th>Naziv</th>
                        <th>Županija</th>
                        <th colspan="2"></th>
		</tr>
	</thead>
	<tbody>
	@foreach($mjestos as $key => $value)
		<tr>
			<td>{{ $value->pbr }}</td>
			<td>{{ $value->nazMjesto }}</td>
                        <td>{{ $value->zupanija->nazZupanija }}</td>
			<!-- we will also add show, edit, and delete buttons -->
			<td>

				<!-- delete the nerd (uses the destroy method DESTROY /nerds/{id} -->
				<!-- we will add this later since its a little more complicated than the first two buttons -->
				{{ Form::open(array('url' => 'mjesto/' . $value->pbr, 'class' => 'pull-right')) }}
					{{ Form::hidden('_method', 'DELETE') }}
					{{ Form::submit('Obriši ovo mjesto', array('class' => 'btn btn-warning','id'=>'mjesto-del-'.$value->pbr)) }}
				{{ Form::close() }}

				<!-- show the nerd (uses the show method found at GET /nerds/{id} -->
				<a class="btn btn-small btn-success" id="{{'mjesto-' . $value->pbr}}" href="{{ URL::to('mjesto/' . $value->pbr) }}">Pokaži ovu mjesto</a>

				<!-- edit this nerd (uses the edit method found at GET /nerds/{id}/edit -->
				<a class="btn btn-small btn-info" href="{{ URL::to('mjesto/' . $value->pbr . '/edit') }}">Uredi ovu mjesto</a>

			</td>
		</tr>
	@endforeach
        
	</tbody>
</table>

<!-- primjer paginate index@MjestoController -->
{{ $mjestos->links() }}

@endsection
