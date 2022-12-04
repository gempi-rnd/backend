<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestionType extends Model
{
    use HasFactory;
    use Uuids;

    protected $hidden = [
        'tenant_id', 'deleted_at',
    ];

    /**
     * fillable
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'tenant_id',
        'code',
        'short_description',
    ];

    protected $appends = ['tenant'];
    public function getTenantAttribute()
    {
        return json_decode(Tenant::where('id', $this->tenant_id)->first());
    }
}
