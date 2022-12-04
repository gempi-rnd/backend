<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;
    use Uuids;


    protected $hidden = [
        'deleted_at',
    ];

    /**
     * fillable
     *
     * @var array
     */
    protected $fillable = [
        'code',
        'name',
    ];
}
