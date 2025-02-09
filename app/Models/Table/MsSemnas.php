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

}
