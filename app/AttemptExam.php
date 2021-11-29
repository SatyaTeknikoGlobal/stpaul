<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AttemptExam extends Model{
    
    protected $table = 'attempted_exam';

    protected $guarded = ['id'];
    

    protected $fillable = [
       
    ];
}