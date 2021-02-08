<?php

namespace App\Http\Controllers;

use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class UserController extends Controller
{

	/**
	* Display a listing of the resource.
	*
	* @return \Illuminate\Http\Response
	*/
	public function index(Request $request)
	{
		Gate::forUser($request['payload'])->authorize('user-viewAny');

		return UserModel::get();
	}

	/**
	* Store a newly created resource in storage.
	*
	* @param  \Illuminate\Http\Request  $request
	* @return \Illuminate\Http\Response
	*/
	public function store(Request $request)
	{
		Gate::forUser($request['payload'])->authorize('user-create');

		$data = $request->all();

		if ($hasInvalidRules = hasInvalidRulesModel(UserModel::class, $data)) {
			return $hasInvalidRules;
		}

		$userType = new UserModel;

		if ($userType->where('email', $data['email'])->first()) {
			return response()->json([ 'errors' => ['Usuário já cadastrado'] ], 409);
		}

		$userType->fill($data)->save();

		return $userType;
	}

	/**
	* Display the specified resource.
	*
	* @param  int  $id
	* @return \Illuminate\Http\Response
	*/
	public function show(Request $request, $id)
	{
		if ($user = UserModel::find($id)) {
			Gate::forUser($request['payload'])->authorize('user-view', $user);

			return $user;
		}

		return response()->json([ 'errors' => ['Usuário não existente ou desativado'] ], 410);
	}

	/**
	* Update the specified resource in storage.
	*
	* @param  \Illuminate\Http\Request  $request
	* @param  int  $id
	* @return \Illuminate\Http\Response
	*/
	public function update(Request $request, $id)
	{
		if ($user = UserModel::find($id)) {
			Gate::forUser($request['payload'])->authorize('user-update', $user);

			$data = $request->all();

			if ($hasInvalidRules = hasInvalidRulesModel(UserModel::class, $data)) {
				return $hasInvalidRules;
			}

			$user->fill($data)->save();

			return $user;
		}

		return response()->json([ 'errors' => ['Usuário não existente ou desativado'] ], 410);
	}

	/**
	* Remove the specified resource from storage.
	*
	* @param  int  $id
	* @return \Illuminate\Http\Response
	*/
	public function destroy(Request $request, $id)
	{
		if ($user = UserModel::find($id)) {
			Gate::forUser($request['payload'])->authorize('user-delete', $user);

			$user->delete();

			return $user;
		}

		return response()->json([ 'errors' => ['Usuário não existente ou já desativado'] ], 410);
	}
}
