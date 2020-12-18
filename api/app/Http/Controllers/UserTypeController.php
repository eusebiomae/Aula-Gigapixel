<?php

namespace App\Http\Controllers;

use App\Models\UserTypeModel;
use Illuminate\Http\Request;

class UserTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userType = UserTypeModel::withTrashed()->get();
        return $userType;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request )    {

        $userType = $request->get('id') ? UserTypeModel::find($request->get('id')) : new UserTypeModel;

        $userType->fill($request->all())->save();

        return ($userType);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id = null)
    {
        $userType = null;
		if ($id) {
			$userType = UserTypeModel::find($id);
        }

        return view(['userType' => $userType]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)    {

        UserTypeModel::find($id)->fill($request->all())->save();




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
