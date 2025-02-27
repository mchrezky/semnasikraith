<?php

namespace App\Models\Table;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventType extends Model
{
    use HasFactory;

    protected $connection = 'mysql';
    protected $table = 'event_type';
    protected $primarykey = 'id';

    protected $fillable = [
        'id',
        'nama',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by',
        'is_deleted'
    ];
}
