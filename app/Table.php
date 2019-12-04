<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Table extends Model
{
    protected $fillable = ['nr_of_chairs','name'];

    public function host()
    {
        return $this->belongsTo('App\Host');
    }
}
