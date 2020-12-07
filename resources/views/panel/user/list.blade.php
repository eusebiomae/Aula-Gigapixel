@extends('panel.layouts.app')

@section('title', 'User')

@section('content')
<br>
<table class="table">
	<thead class="thead-light">
		<tr>
			<th scope="col">Id</th>
			<th scope="col">E-mail</th>
			<th scope="col">Nome</th>
			<th scope="col">Tipo de Usuário</th>
			<th scope="col">Superior</th>
		</tr>
	</thead>

	@foreach ($user as $item)

		<tbody>
			<tr>

				<td>{{$item->id}}</td>
				<td>{{$item->email}}</td>
				<td>{{$item->name}}</td>
				<td>{{$item->userType->desc}}</td>

				<td>
					@if (isset($item->user))
						{{$item->user->name}}
					@endif
				</td>

				@if ($item->deleted_at!=null)

					@if (Auth::user()->can('restore-user', $item) && !$item->deleted_at)
					<td><a href="/panel/user/restore/{{$item->id}}"> <button type="button" class="btn btn-warning"> Restaurar </button></a> </td>
					@endif

					<td>Foi excluido</td>

					@else

					@if (Auth::user()->can('form-user', $item) && !$item->deleted_at)
					<td><a href="/panel/user/update/{{$item->id}}"> <button type="button" class="btn btn-primary"> Editar </button> </a> </td>
					@endif

					@if (Auth::user()->can('delete-user', $item) && !$item->deleted_at)
					<td><a href="/panel/user/delete/{{$item->id}}"> <button type="button" class="btn btn-danger"> Deletar </button> </a> </td>
					@endif

				@endif

			</tr>
		</tbody>

	@endforeach


</table>

@if (Auth::user()->can('save-user', $item) && !$item->deleted_at)
<a href="/panel/user/insert"> <button type="button" class="btn btn-success"> Novo </button> </a>
@endif
@endsection

