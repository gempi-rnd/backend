<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tenant extends Model
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
        'slug',
        'name',
        'logo',
        'locale',
        'timezone',
        'email',
        'content',
    ];
}
