<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class Student extends Model
{
    use HasApiTokens, Notifiable;
    use Uuids;

    protected $appends = ['tenant'];
    protected $hidden = ['tenant_id', 'deleted_at'];

    protected $fillable = [
        'user_id',
        'tenant_id',
        'full_name',
        'email',
        'whatsapp',
        'photo'
    ];

    public function student()
    {
        return $this->belongsTo('App\Student');
    }


    public function getTenantAttribute()
    {
        return json_decode(Tenant::where('id', $this->tenant_id)->first());
    }
}
