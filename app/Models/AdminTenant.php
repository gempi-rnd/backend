<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminTenant extends Model
{
    use HasFactory;
    use Uuids;

    protected $fillable = [
        'user_id',
        'tenant_id',
        'full_name',
        'email',
        'whatsapp',
        'photo'
    ];

    public function adminTenant()
    {
        return $this->belongsTo('App\AdminTenant');
    }
}
