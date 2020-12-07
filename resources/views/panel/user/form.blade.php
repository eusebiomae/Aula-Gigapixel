@extends('panel.layouts.app')

@section('title', 'User')

@section('content')

<br>
	<form action="/panel/user/save" method="post">
		@csrf
		<input type="hidden" name="id" value="{{is_null($user) ? '' : $user->id}}">

		<div class="row">
			<div class="col">
				<input type="text" class="form-control" name="name" placeholder="Nome" value="{{is_null($user) ? '' : $user->name}}">
			</div>

			<div class="col">
				<input type="email" class="form-control" name="email" placeholder="E-mail" value="{{is_null($user) ? '' : $user->email}}">
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col">
				<input type="password" class="form-control" name="password" placeholder="Senha" value="">
			</div>

			<div class="col">
				<input type="passwordConf" class="form-control" name="passwordConf" placeholder="Confirmar Senha" value="">
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col">
				<select class="form-control" name="user_type_id" placeholder="Tipo de Usuario" @if (!authMenu('panel.user')) disabled @endif>
					<option value=""> Selecione o tipo </option>
					@foreach ($userType as $item)
					<option value="{{$item->id}}">{{$item->desc}}</option>
					@endforeach
				</select>
			</div>
			<br>
			<div class="col">
				<select class="form-control" name="user_id" placeholder="Superior" @if (!authMenu('panel.user')) disabled @endif>
					<option value=""> Selecione Superior </option>
					@foreach ($higher as $item)
					<option value="{{$item->id}}">{{$item->name}}</option>
					@endforeach
				</select>
			</div>
		</div>
		<br>

		<input class="btn btn-primary" type="submit" value="Enviar">

	</form>

@endsection


