<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BestResult extends Model
{
    protected $fillable = ['login', 'repository', 'avatar_url', 'repository_url', 'rating'];
}
