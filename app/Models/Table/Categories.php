<?php

namespace App\Models\Table;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    use HasFactory;

    protected $connection = 'mysql';
    protected $table = 'categories';
    protected $primarykey = 'id';

    protected $fillable = [
        'id',
        'name',
        'paper',
    ];
}
