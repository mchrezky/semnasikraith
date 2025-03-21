<?php

namespace App\Models\Table;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventList extends Model
{
    use HasFactory;

    protected $connection = 'mysql';
    protected $table = 'event_list';
    protected $primarykey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'id',
        'id_type',
        'semnas_id',
        'nama',
        'harga',
        'foto',
        'ket',
        'lat',
        'lng',
        'status'
    ];
}
