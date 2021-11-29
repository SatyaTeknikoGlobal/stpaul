<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaidUser extends Model
{
    //
    protected $table = 'user_exam';
    protected $guarded = ['id'];
}
