<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;

class UserModel extends Authenticatable
{
	use HasFactory, Notifiable, SoftDeletes;

	static public $rules = [
		'name' => [ 'required', 'min:3', 'max:64' ],
		'email' => [ 'required', 'email' ],
		'password' => [ 'required', 'min:3', 'max:32' ],
		'user_type_id' => [ 'required', 'numeric' ]
	];

	protected $table = 'user';

	/**
	* The attributes that are mass assignable.
	*
	* @var array
	*/
	protected $fillable = [
		'name',
		'email',
		'user_id',
		'password',
		'user_type_id',
	];

	protected $appends = [ 'userType' ];

	/**
	* The attributes that should be hidden for arrays.
	*
	* @var array
	*/
	protected $hidden = [
		'password',
		'remember_token',
	];

	/**
	* The attributes that should be cast to native types.
	*
	* @var array
	*/
	protected $casts = [
		'email_verified_at' => 'datetime',
	];

	protected function getUserTypeAttribute() {
		return UserTypeModel::find($this->attributes['user_type_id']);
	}

	protected function setPasswordAttribute($value) {
		$this->attributes['password'] = Hash::make($value);
	}

	public function userType() {
		return $this->belongsTo('App\Models\UserTypeModel');
	}

	public function user() {
		return $this->belongsTo('App\Models\UserModel');
	}
}
