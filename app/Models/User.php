<?php

namespace App\Models;

use Core\BaseModelEloquent;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends BaseModelEloquent
{
    use SoftDeletes;

    public $table = "users";

    protected $fillable = ['name', 'email', 'password'];

    public static function rulesCreate()
    {
        return [
            'name' => 'min:4|max:255',
            'email' => 'email|unique:users',
            'password' => 'min:6|max:16|required_with:password_confirmation|same:password_confirmation',
            'password_confirmation' => 'min:6|max:16'

        ];
    }

    public static function rulesUpdate($id)
    {
        return [
            'name' => 'min:4|max:255',
            'email' => "unique:users,email,$id,id",
            'password' => 'min:6|max:16|required_with:password_confirmation|same:password_confirmation',
            'password_confirmation' => 'min:6|max:16'
        ];
    }

}