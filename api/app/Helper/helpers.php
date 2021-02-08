<?php
// Comando para registrar novos Helpers depois de adicionados no composer.json
// composer dump-autoload

use Illuminate\Support\Facades\Validator;

function hasInvalidRulesModel($modelClass, $data) {
	$validator = Validator::make($data, $modelClass::$rules);

	if ($validator->fails()) {
		return response()->json([ 'errors' => $validator->errors()->all() ], 422);
	}

	return null;
}
