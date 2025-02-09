<?php

namespace App\Models\Table;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    use HasFactory;

    protected $connection = 'mysql';
    protected $table = 'jadwal';
    protected $primarykey = 'id';

    protected $fillable = [
        'id',
        'title',
        'date_start',
        'date_end',
        'ket'
    ];
}
