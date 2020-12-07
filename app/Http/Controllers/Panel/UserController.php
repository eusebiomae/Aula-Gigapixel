<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\UserModel;
use App\Models\UserTypeModel;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Request;

class UserController extends Controller {

	function list() {
		$user = UserModel::withTrashed()->with(['userType', 'user'])->get();

		$this->authorize('list-user');

		return view('panel/user/list', [ 'user' => $user ]);
	}

	function form(Request $request, $id = null) {
		$dataForm = is_null($id) ? null : UserModel::find($id);

		$this->authorize('form-user', $dataForm);

		$user = null;
		if ($id) {
			$user = UserModel::find($id);
		}
		$userType = UserTypeModel::get();

		return view('panel/user/form', [
			'user' => $user,

			'userType' => $userType,

			'higher' => UserModel::whereHas('userType' , function($query) {
				return 	$query->where('level', 4);

				// if ($user == 'level' [3]);
				//  return 	$query->where('level', 4);

				// if ($user == 'level' [4]);
				//  return 	$query->where('level', 5);

				// if ($user == 'level' [5]);
				//  return 	$query->where('level', 6);

			})->orderBy('name')->get(),
		]);
	}

	function save(Request $request) {
		$user = $request::get('id') ? UserModel::find($request::get('id')) : new UserModel;

		$input = $request::all();

		$input['password'] = Hash::make($input['password']);

		$user->fill($input)->save();
		return redirect('/panel/user');

		if (!(isset($input['password']) && $input['password'] && isset($input['passwordConf'])
				&& $input['password'] == $input['passwordConf'])) {

			unset($input['password']);
		}


		return $input;
	}


	function delete(Request $request, $id) {
		UserModel::find($id)->delete();

		return redirect('/panel/user_type');
	}

	function restore(Request $request, $id) {
		UserModel::withTrashed()
		->where('id', $id)
		->restore();

		return redirect('/panel/user');
	}
}

