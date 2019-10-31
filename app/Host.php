<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Host extends Model
{
    protected $fillable = ['name', 'description', 'logo', 'city', 'street', 'nr'];

}
