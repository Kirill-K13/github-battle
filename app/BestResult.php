<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BestResult extends Model
{
    protected $fillable = ['login', 'repository', 'avatar_url', 'rating'];
}
