<?php

namespace App\Models\Table;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    use HasFactory;

    protected $connection = 'mysql';
    protected $table = 'banner';
    protected $primarykey = 'id';

    protected $fillable = [
        'id',
        'title',
        'foto',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by',
        'is_deleted'
    ];
}
