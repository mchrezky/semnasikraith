<?php

namespace App\Models\Table;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventNon extends Model
{
    use HasFactory;

    protected $connection = 'mysql';
    protected $table = 'event_non';
    protected $primarykey = 'id';

    protected $fillable = [
        'id',
        'id_user',
        'nama_lengkap',
        'institusi_asal',
        'bidang_ilmu',
        'alamat_institusi',
        'kota',
        'event_list',
        'seminar_name',
        'konfirmasi_bayar',
        'date',
        'order_id',
        'created_at',
        'updated_at',
        'status',
    ];
}
