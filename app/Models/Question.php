<?php

namespace App\Models;

use App\Casts\JsonArray;
use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;
    use Uuids;

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'options' => JsonArray::class,
        'correct_answers' => JsonArray::class,
        'solutions' => JsonArray::class,
        'attachments' => JsonArray::class,
        'has_attachment' => 'boolean',
    ];


    protected $hidden = [
        'tenant_id',
        'topic_id',
        'difficult_level_id',
        'question_type_id',
        'deleted_at'
    ];

    /**
     * fillable
     *
     * @var array
     */
    protected $fillable = [
        'tenant_id',
        'topic_id',
        'difficult_level_id',
        'question_type_id',
        'question',
        'correct_answers',
        'options',
        'solutions',
        'has_attachment',
        'attachments',
    ];

    protected $appends = ['tenant', 'topic', 'difficult_level', 'question_type'];
    public function getTenantAttribute()
    {
        return json_decode(Tenant::where('id', $this->tenant_id)->first());
    }

    public function getTopicAttribute()
    {
        return json_decode(Topic::where('id', $this->topic_id)->first()->makeHidden(['tenant']));
    }

    public function getDifficultLevelAttribute()
    {
        return json_decode(DifficultyLevels::where('id', $this->difficult_level_id)->first()->makeHidden(['tenant']));
    }

    public function getQuestionTypeAttribute()
    {
        return json_decode(QuestionType::where('id', $this->question_type_id)->first()->makeHidden(['tenant']));
    }
}
