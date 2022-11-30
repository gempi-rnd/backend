<?php

namespace App\Models\Student;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

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
}
