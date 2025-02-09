<?php

namespace App\Models\Table;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    use HasFactory;

    protected $connection = 'mysql';
    protected $table = 'pembayaran';
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id',
        'id_user',
        'jumlah',
        'note',
        'tgl_bayar',
        'status',
        'file',
    ];
}
