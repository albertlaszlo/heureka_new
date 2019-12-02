<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $fillable = ['host_id','image'];

    public function host()
    {
        return $this->belongsTo('App\Host');
    }
}
