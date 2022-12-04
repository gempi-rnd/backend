<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestQuestion extends Model
{
    use HasFactory;
    use Uuids;


    protected $hidden = [
        'deleted_at',
        'question_id',
        'test_id',
        'tenant_id',
    ];

    /**
     * fillable
     *
     * @var array
     */
    protected $fillable = [
        'tenant_id',
        'order',
        'question_id',
        'test_id',
    ];

    protected $appends = ['tenant', 'question', 'test'];
    public function getTenantAttribute()
    {
        return json_decode(Tenant::where('id', $this->tenant_id)->first());
    }

    public function getQuestionAttribute()
    {
        return json_decode(Question::where('id', $this->question_id)->first()->makeHidden('tenant'));
    }

    public function getTestAttribute()
    {
        return json_decode(Test::where('id', $this->test_id)->first()->makeHidden('tenant'));
    }
}
