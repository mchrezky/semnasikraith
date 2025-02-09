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

    protected $fillable = [
        'id',
        'id_type',
        'nama',
        'harga',
        'foto',
        'ket',
        'lat',
        'lng',
        'status'
    ];
}
