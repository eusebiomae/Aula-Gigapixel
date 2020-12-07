<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;

class HomeController extends Controller
{
	// /**
	//  * Handle an authentication attempt.
	//  *
	//  * @param  \Illuminate\Http\Request $request
	//  *
	//  * @return Response
	//  */

	function list()	{
		return view('panel.home.index');

	}
}

