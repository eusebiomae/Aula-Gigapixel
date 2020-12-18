<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserTypeModel extends Model
{
    use SoftDeletes;

    protected $table = 'user_type';

    protected $fillable = [
        'name',
        'level',
    ];
}
