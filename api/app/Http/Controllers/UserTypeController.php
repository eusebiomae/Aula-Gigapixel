<?php

namespace App\Http\Controllers;

use App\Models\UserTypeModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
class UserTypeController extends Controller
{
	/**
	* Display a listing of the resource.
	*
	* @return \Illuminate\Http\Response
	*/
	public function index(Request $request)
	{
		Gate::forUser($request['payload'])->authorize('userType-viewAny');

		return UserTypeModel::get();
	}

	/**
	* Store a newly created resource in storage.
	*
	* @param  \Illuminate\Http\Request  $request
	* @return \Illuminate\Http\Response
	*/
	public function store(Request $request)
	{
		Gate::forUser($request['payload'])->authorize('userType-create');

		$data = $request->all();

		if ($hasInvalidRules = hasInvalidRulesModel(UserTypeModel::class, $data)) {
			return $hasInvalidRules;
		}

		$userType = new UserTypeModel;

		if ($userType->where('name', $data['name'])->where('level', $data['level'])->first()) {
			return response()->json([ 'errors' => ['Tipo de usuário já cadastrado'] ], 409);
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
		if ($userType = UserTypeModel::find($id)) {
			Gate::forUser($request['payload'])->authorize('userType-view', $userType);

			return $userType;
		}

		return response()->json([ 'errors' => ['Tipo de usuário não existente ou desativado'] ], 410);
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
		if ($userType = UserTypeModel::find($id)) {
			Gate::forUser($request['payload'])->authorize('userType-update', $userType);

			$data = $request->all();

			if ($hasInvalidRules = hasInvalidRulesModel(UserTypeModel::class, $data)) {
				return $hasInvalidRules;
			}

			$userType->fill($data)->save();

			return $userType;
		}

		return response()->json([ 'errors' => ['Tipo de usuário não existente ou desativado'] ], 410);
	}

	/**
	* Remove the specified resource from storage.
	*
	* @param  int  $id
	* @return \Illuminate\Http\Response
	*/
	public function destroy(Request $request, $id)
	{
		if ($userType = UserTypeModel::find($id)) {
			Gate::forUser($request['payload'])->authorize('userType-delete', $userType);

			$userType->delete();

			return $userType;
		}

		return response()->json([ 'errors' => ['Tipo de usuário não existente ou já desativado'] ], 410);
	}
}
