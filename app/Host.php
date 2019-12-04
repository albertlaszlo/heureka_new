<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Host extends Model
{
    protected $fillable = ['name', 'description', 'logo', 'city', 'street', 'nr' , 'status'];

    public function tables()
    {
        return $this->hasMany('App\Table');
    }

    public function reservations()
    {
        return $this->hasMany('App\Reservation');
    }

    public function images()
    {
        return $this->hasMany('App\Image');
    }

    public function freeTables($start, $end) {
        $table_ids = $this->tables()
            ->select('tables.id')
            ->where('tables.host_id', '=', $this->id)
            ->join('reservations', 'tables.id', '=', 'reservations.table_id')
            ->where('reservations.end', '>', $start)
            ->where('reservations.start', '<', $end)
            ->get();
        return $this->tables()
            ->select('*')
            ->whereNotIn('tables.id', $table_ids)
            ->get();
    }

    public static function search($search, $start, $end) {
        // select(['name', 'description'])
        $hosts = self::query()
            ->where('name', "LIKE", "%$search%")
            ->orWhere('description', "LIKE", "%$search%")
            ->orWhere('city', "LIKE", "%$search%")
            ->orderBy('name')
            ->get();
        foreach ($hosts as $host) {
            $host->free_tables = $host->freeTables($start, $end);
        }
        return $hosts;
    }
}
