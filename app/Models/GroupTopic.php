<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupTopic extends Model
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
        'tenant_id',
        'slug',
        'name',
    ];

    protected $appends = ['tenant'];
    public function getTenantAttribute()
    {
        return json_decode(Tenant::where('id', $this->tenant_id)->first());
    }
}
