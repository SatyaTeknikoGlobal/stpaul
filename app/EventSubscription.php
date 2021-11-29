<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EventSubscription extends Model
{
    //
    protected $table = 'event_subscription';
    protected $guarded = ['id'];
}
