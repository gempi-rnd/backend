<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestSession extends Model
{
    use HasFactory;
    use Uuids;


    protected $hidden = [
        'tenant_id',
        'deleted_at',
        'user_id',
        'test_id',
    ];

    /**
     * fillable
     *
     * @var array
     */
    protected $fillable = [
        'tenant_id',
        'user_id',
        'test_id',
        'start_time',
        'end_time',
    ];

    protected $appends = ['tenant', 'user', 'test'];
    public function getTenantAttribute()
    {
        return json_decode(Tenant::where('id', $this->tenant_id)->first());
    }

    public function getUserAttribute()
    {
        return json_decode(User::where('id', $this->user_id)->first()->makeHidden(['tenant']));
    }

    public function getTestAttribute()
    {
        return json_decode(Test::where('id', $this->test_id)->first()->makeHidden(['tenant']));
    }
}
