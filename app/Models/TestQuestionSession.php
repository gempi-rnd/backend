<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestQuestionSession extends Model
{
    use HasFactory;
    use Uuids;


    protected $hidden = [
        'test_session_id',
        'question_id',
        'tenant_id',
        'deleted_at',
    ];

    /**
     * fillable
     *
     * @var array
     */
    protected $fillable = [
        'tenant_id',
        'test_session_id',
        'question_id',
        'options',
        'user_answer',
        'status',
        'time_taken',
    ];

    protected $appends = ['tenant', 'test_session', 'question'];
    public function getTenantAttribute()
    {
        return json_decode(Tenant::where('id', $this->tenant_id)->first());
    }

    public function getTestSessionAttribute()
    {
        return json_decode(TestSession::where('id', $this->test_session_id)->first()->makeHidden(['tenant']));
    }

    public function getQuestionAttribute()
    {
        return json_decode(Question::where('id', $this->question_id)->first()->makeHidden(['tenant']));
    }
}
