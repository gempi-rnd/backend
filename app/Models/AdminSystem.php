<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminSystem extends Model
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

    public function adminSystem()
    {
        return $this->belongsTo('App\AdminSystem');
    }
}
