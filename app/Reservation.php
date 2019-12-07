<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $fillable = ['host_id', 'table_id', 'email', 'start', 'end'];

    public function host()
    {
        return $this->belongsTo('App\Host');
    }
}
