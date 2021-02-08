<?php

namespace App\Policies;

use App\Models\UserModel;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
	use HandlesAuthorization;

	public function viewAny($payload)
	{
		return true;
	}

	public function view($payload, UserModel $userModel)
	{
		return true;
	}

	public function create($payload)
	{
		return true;
	}

	public function update($payload, UserModel $userModel)
	{
		return true;
	}

	public function delete($payload, UserModel $userModel)
	{
		return true;
	}

	public function restore($payload, UserModel $userModel)
	{
		return true;
	}

	public function forceDelete($payload, UserModel $userModel)
	{
		return true;
	}
}
