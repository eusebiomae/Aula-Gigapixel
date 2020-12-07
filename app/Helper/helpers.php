<?php

use Illuminate\Support\Facades\Auth;

function authMenu($route) {

	$mapAutMenu = [
		'panel.index' => [6, 5, 4, 3],
		'panel.configUser'=> [6, 5, 4],
		'panel.userType' => [6, 5],
		'panel.user' => [6, 5, 4],
	];

	$level = Auth::user()->userType->level;

	return isset($mapAutMenu[$route]) ? in_array($level, $mapAutMenu[$route]) : false;
}


