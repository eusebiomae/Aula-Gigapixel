<?php

namespace App\Http\Controllers;
use App\Models\UserModel;
use App\Models\UserTypeModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = UserModel::withTrashed()->with(['userType', 'user'])->get();

        // $this->authorize('list-user');

        return $user;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request )    {

        $user = $request->get('id') ? UserModel::find($request->get('id')) : new UserModel;

        $input = $request->all();

		$input['password'] = Hash::make($input['password']);

		$user->fill($input)->save();

        return ($user);

        // if (!(isset($input['password']) && $input['password'] && isset($input['passwordConf'])
		// 		&& $input['password'] == $input['passwordConf'])) {

		// 	unset($input['password']);
        // }

        // return $input;

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id = null)    {

        $user = null;
		if ($id) {
			$user = UserModel::find($id);
        }

        return (['user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)    {

        UserModel::find($id)->fill($request->all())->save();




    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        UserTypeModel::find($id)->delete();

        return 'Foi Deletado';
    }

    public function restore(Request $request, $id) {
        UserTypeModel::withTrashed()
		->where('id', $id)
		->restore();

        return 'Restaurado';
    }
}
