@extends('panel.layouts.app')

@section('title', 'UserType')

@section('content')
<br>
<table class="table">
	<thead class="thead-light">
		<tr>
			<th scope="col">Id</th>
			<th scope="col">Descrição</th>
			<th scope="col">Nível</th>
		</tr>
	</thead>

		@foreach ($usertype as $item)

	<tbody>
		<tr>
			<td> {{$item->id}}</td>
			<td>{{$item->desc}}</td>
			<td>{{$item->level}}</td>

		@if ($item->deleted_at!=null)

		<td><a href="/panel/user_type/restore/{{$item->id}}"><button type="button" class="btn btn-warning"> Restaurar </button></a> </td>
		<td>Foi excluido</td>

		@else

		<td><a href="/panel/user_type/update/{{$item->id}}"><button type="button" class="btn btn-primary"> Editar </button></a> </td>
		<td><a href="/panel/user_type/delete/{{$item->id}}"><button type="button" class="btn btn-danger"> Deletar </button></a> </td>

		@endif

		</tr>
	</tbody>

		@endforeach


</table>

<a href="/panel/user_type/insert"><button type="button" class="btn btn-success"> Novo </button></a>

@endsection

