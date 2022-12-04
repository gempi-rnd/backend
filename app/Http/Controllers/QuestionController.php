<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\QuestionResource;
use App\Models\Question;
use Illuminate\Support\Facades\Validator;

class QuestionController extends Controller
{
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        //get question
        $question = Question::latest()->paginate(5);

        //return collection of question as a resource
        return new QuestionResource(true, 'List Data Question', $question);
    }

    public function store(Request $request)
    {
        //define validation rules
        $validator = Validator::make($request->all(), [
            'tenant_id'             => 'required',
            'topic_id'              => 'required',
            'difficult_level_id'    => 'required',
            'question_type_id'      => 'required',
            'question'              => 'required',
            'correct_answers'       => 'required',
            'options'               => 'required',
            'solutions'             => 'required',
            'has_attachment'        => 'required',
            'attachments'           => 'required',
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //create question
        $question = Question::create([
            'tenant_id'             => $request->tenant_id,
            'topic_id'              => $request->topic_id,
            'difficult_level_id'    => $request->difficult_level_id,
            'question_type_id'      => $request->question_type_id,
            'question'              => $request->question,
            'correct_answers'       => $request->correct_answers,
            'options'               => $request->options,
            'solutions'             => $request->solutions,
            'has_attachment'        => $request->has_attachment,
            'attachments'           => $request->attachments,
        ]);

        //return response
        return new QuestionResource(true, 'Data Question Berhasil Ditambahkan!', $question);
    }

    /**
     * show
     *
     * @param  mixed $question
     * @return void
     */
    public function show(Question $question)
    {
        //return single question as a resource
        return new QuestionResource(true, 'Data Question Ditemukan!', $question);
    }

    /**
     * update
     *
     * @param  mixed $request
     * @param  mixed $question
     * @return void
     */
    public function update(Request $request, Question $question)
    {
        //define validation rules
        $validator = Validator::make($request->all(), [
            'topic_id'              => 'required',
            'difficult_level_id'    => 'required',
            'question_type_id'      => 'required',
            'question'              => 'required',
            'correct_answers'       => 'required',
            'options'               => 'required',
            'solutions'             => 'required',
            'has_attachment'        => 'required',
            'attachments'           => 'required',
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //update question without image
        $question->update([
            'topic_id'              => $request->topic_id,
            'difficult_level_id'    => $request->difficult_level_id,
            'question_type_id'      => $request->question_type_id,
            'question'              => $request->question,
            'correct_answers'       => $request->correct_answers,
            'options'               => $request->options,
            'solutions'             => $request->solutions,
            'has_attachment'        => $request->has_attachment,
            'attachments'           => $request->attachments,
        ]);

        //return response
        return new QuestionResource(true, 'Data Question Berhasil Diubah!', $question);
    }
}
