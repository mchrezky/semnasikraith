<?php

namespace App\Models\Table;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MsSemnas extends Model
{
    use HasFactory;

    protected $connection = 'mysql';
    protected $table = 'ms_semnas';
    protected $primarykey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'id',
        'name',
        'foto',
        'file_sertifikat_pemakalah',
        'file_sertifikat_non_pemakalah',
        'tema',
        'tanggal',
        'status'
    ];
}
