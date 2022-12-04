<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    use HasFactory;
    use Uuids;

    protected $hidden = [
        'group_topic_id', 'tenant_id', 'deleted_at',
    ];

    /**
     * fillable
     *
     * @var array
     */
    protected $fillable = [
        'tenant_id',
        'group_topic_id',
        'slug',
        'name',
    ];

    protected $appends = ['tenant', 'group_topic'];

    public function getTenantAttribute()
    {
        return json_decode(Tenant::where('id', $this->tenant_id)->first());
    }

    public function getGroupTopicAttribute()
    {
        return json_decode(GroupTopic::where('id', $this->group_topic_id)->first()->makeHidden(['tenant']));
    }
}
