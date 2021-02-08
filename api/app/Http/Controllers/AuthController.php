<?php

namespace App\Http\Controllers;

use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use JWTHelper;

class AuthController extends Controller
{

	public function auth(Request $request)
	{
		$input = $request->all();

		$validator = Validator::make($input, [
			'email' => ['required', 'email'],
			'password' => ['required', 'min:3', 'max:32']
		]);

		if ($validator->fails()) {
			return response()->json(['errors' => $validator->errors()->all()], 422);
		}

		$userData = UserModel::where('email', $input['email'])->first();

		if ($userData && Hash::check($input['password'], $userData->makeVisible(['password'])->password)) {
			return (new JWTHelper())->build([
				'user' => [
					'id' => $userData->id,
					'userType' => $userData->userType->id,
					'level' => $userData->userType->level,
					'company' => 1,
				],
			]);
		}

		return response()->json(['errors' => ['E-mail ou Senha inválido']], 406);
	}

	public function getOctKey()
	{

		return JWTHelper::getOctKey();
	}
}
