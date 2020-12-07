<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\UserTypeModel;
use Illuminate\Support\Facades\Request;

class UserTypeController extends Controller {
	function list() {
		$userType = UserTypeModel::withTrashed()->get();
		// return $userType;
		return view('panel/user_type/list', [ 'usertype' => $userType ]);
	}

	function form(Request $request, $id = null) {
		$userType = null;
		if ($id) {
			$userType = UserTypeModel::find($id);
		}

		return view('panel/user_type/form', [ 'usertype' => $userType ]);
	}

	function save(Request $request) {
		$usertype = $request::get('id') ? UserTypeModel::find($request::get('id')) : new UserTypeModel;

		$usertype->fill($request::all())->save();
		return redirect('/panel/user_type');
	}


	function delete(Request $request, $id) {
		UserTypeModel::find($id)->delete();

		return redirect('/panel/user_type');
	}
	function restore(Request $request, $id) {
		UserTypeModel::withTrashed()
		->where('id', $id)
		->restore();

		return redirect('/panel/user_type');
	}
}
