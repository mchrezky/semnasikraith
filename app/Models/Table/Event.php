<?php

namespace App\Models\Table;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $connection = 'mysql';
    protected $table = 'event';
    protected $primarykey = 'id';

    protected $fillable = [
        'id',
        'id_user',
        'event_list',
        'seminar_name',
        'title',
        'writer1',
        'email1',
        'writer2',
        'email2',
        'writer3',
        'email3',
        'writer4',
        'email4',
        'writer5',
        'email5',
        'writer6',
        'email6',
        'writer7',
        'email7',
        'hasil_cek_turnitin',
        'file_hasil_cek_turnitin',
        'category',
        'link_url_ojs',
        'file_ojs',
        'konfirmasi_bayar',
        'date',
        'hibah',
        'review',
        'abstrak',
        'metode_penelitian',
        'pembahasan',
        'kesimpulan',
        'plagriasi_turnitin',
        'ket_review',
        'date_review',
        'review_by',
        'order_id',
        'created_at',
        'updated_at',
        'status'
    ];
}
