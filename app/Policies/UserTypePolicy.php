<?php
namespace App\Policies;


use App\Models\UserModel;
use Illuminate\Auth\Access\HandlesAuthorization;


class UserPolicy {
	use HandlesAuthorization;

	public function list(UserModel $user) {
		return in_array($user->userType->level, [6, 5]);
	}

	public function form(UserModel $user, UserModel $data = null) {
		return in_array($user->userType->level, [6, 5]);
	}
	public function save(UserModel $user, UserModel $data = null) {
		return in_array($user->userType->level, [6, 5]);
	}
	public function delete(UserModel $user, UserModel $data = null) {
		return in_array($user->userType->level, [6, 5]);
	}
	public function restore(UserModel $user, UserModel $data = null) {
		return in_array($user->userType->level, [6, 5]);
	}
}
