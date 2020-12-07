<?php
namespace App\Policies;


use App\Models\UserModel;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Gate;


class UserPolicy {
	use HandlesAuthorization;

	public function list(UserModel $user) {
		return in_array($user->userType->level, [6, 5, 4]);
	}

	public function form(UserModel $user, UserModel $data = null) {

		if (in_array($user->userType->level, [6, 5])) {
			return true;

		} elseif (is_null($data)) {
				return false;

		} elseif ($user->id == $data->id) {
			return true;

		} elseif ($user->id == $data->user_id) {
			return true;

		} else {
			return false;
		}
	}

	public function save(UserModel $user, UserModel $data = null) {
		if (in_array($user->userType->level, [6, 5])) {
			return true;

		} elseif (is_null($data)) {
				return false;

		} elseif ($user->id == $data->id) {
			return true;

		} elseif ($user->id == $data->user_id) {
			return true;

		} else {
			return false;
		}
	}

	public function delete(UserModel $user, UserModel $data = null) {
		if (in_array($user->userType->level, [6])) {
			return true;

		} elseif (is_null($data)) {
				return false;

		} elseif ($user->id == $data->id) {
			return true;

		} elseif ($user->id == $data->user_id) {
			return true;

		} else {
			return false;
		}
	}

	public function restore(UserModel $user, UserModel $data = null) {
		if (in_array($user->userType->level, [6])) {
			return true;

		} elseif (is_null($data)) {
				return false;

		} elseif ($user->id == $data->id) {
			return true;

		} elseif ($user->id == $data->user_id) {
			return true;

		} else {
			return false;
		}
	}
}
