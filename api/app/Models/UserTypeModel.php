<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserTypeModel extends Model
{
    use HasFactory, SoftDeletes;

    static public $rules = [
		'name' => [ 'required', 'min:2', 'max:64' ],
		'level' => [ 'required', 'numeric', 'between: 1,100' ],
	];

    protected $table = 'user_type';

    protected $fillable = [
        'name',
        'level',

    ];
}
