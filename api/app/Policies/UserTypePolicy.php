<?php

namespace App\Policies;

use App\Models\UserTypeModel;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserTypePolicy
{
	use HandlesAuthorization;

	public function viewAny($payload)
	{
		return true;
	}

	public function view($payload, UserTypeModel $userTypeModel)
	{
		return true;
	}

	public function create($payload)
	{
		return true;
	}

	public function update($payload, UserTypeModel $userTypeModel)
	{
		return true;
	}

	public function delete($payload, UserTypeModel $userTypeModel)
	{
		return true;
	}

	public function restore($payload, UserTypeModel $userTypeModel)
	{
		return true;
	}

	public function forceDelete($payload, UserTypeModel $userTypeModel)
	{
		return true;
	}
}
