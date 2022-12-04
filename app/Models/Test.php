<?php

namespace App\Models;

use App\Casts\JsonArray;
use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    use HasFactory;
    use Uuids;

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'settings' => JsonArray::class,
    ];


    protected $hidden = [
        'deleted_at',
        'tenant_id',
    ];

    /**
     * fillable
     *
     * @var array
     */
    protected $fillable = [
        'code',
        'title',
        'tenant_id',
        'topic_id',
        'description',
        'total_questions',
        'total_duration',
        'settings',
        'status',
        'start_time',
        'end_time',
    ];

    protected $appends = ['tenant', 'topic'];
    public function getTenantAttribute()
    {
        return json_decode(Tenant::where('id', $this->tenant_id)->first());
    }

    public function getTopicAttribute()
    {
        return json_decode(Topic::where('id', $this->topic_id)->first());
    }
}
