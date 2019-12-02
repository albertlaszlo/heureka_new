<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Host extends Model
{
    protected $fillable = ['name', 'description', 'logo', 'city', 'street', 'nr'];

    public function tables()
    {
        return $this->hasMany('App\Table');
    }

    public function images()
    {
        return $this->hasMany('App\Image');
    }

    public function freeTables($start, $end) {
        $table_ids = $this->tables()
            ->select('tables.id')
            ->where('tables.host_id', '=', 1)
            ->join('reservations', 'tables.id', '=', 'reservations.table_id')
            ->where('reservations.end', '>', $start)
            ->where('reservations.start', '<', $end)
            ->get();
        return $this->tables()
            ->select('*')
            ->whereNotIn('tables.id', $table_ids)
            ->get();
    }

    public static function search($search) {
        // select(['name', 'description'])
        return self::query()
            ->where('name', "LIKE", "%$search%")
            ->orWhere('description', "LIKE", "%$search%")
            ->orWhere('city', "LIKE", "%$search%")
            ->orderBy('name')
            ->get();
    }
}
