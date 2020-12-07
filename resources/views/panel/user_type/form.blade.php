@extends('panel.layouts.app')

@section('title', 'User')

@section('content')

<br>

	<form action="/panel/user_type/save" method="post">
		@csrf
		<input type="hidden" class="form-control" name="id" value="{{is_null($usertype) ? '' : $usertype->id}}">

		<div class="row">
			<div class="col">
				<input type="text" class="form-control" name="desc" placeholder="Descrição" value="{{is_null($usertype) ? '' : $usertype->desc}}">
			</div>
			<div class="col">
				<input type="number" class="form-control" name="level" placeholder="Nível" value="{{is_null($usertype) ? '' : $usertype->level}}">
			</div>
		</div>
		<br>
		{{-- <div class="row">
			<div class="col">
				<input type="text" class="form-control" name="higher" placeholder="Superior" value="{{is_null($usertype) ? '' : $usertype->higher}}">
			</div>
		</div> --}}

		<input class="btn btn-primary" type="submit" value="Enviar">

	</form>

@endsection
