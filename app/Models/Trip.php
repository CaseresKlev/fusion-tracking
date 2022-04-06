<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trip extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
            'trip_ticket_id',
            'driver_id',
            'truck_id',
            'source',
            'destination',
            'distance',
            'weigth',
            'rate',
            'bill',
            'date',
            
    ];
}
