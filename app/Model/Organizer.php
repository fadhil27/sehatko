<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Organizer extends Model
{
    protected $fillable = ['photo','name','position','instagram','email','team_category'];
}
