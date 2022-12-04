<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\TestQuestionResource;
use App\Models\TestQuestion;
use Illuminate\Support\Facades\Validator;

class TestQuestionController extends Controller
{
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        //get testQuestion
        $testQuestion = TestQuestion::latest()->paginate(5);

        //return collection of testQuestion as a resource
        return new TestQuestionResource(true, 'List Data Test Question', $testQuestion);
    }

    public function store(Request $request)
    {
        //define validation rules
        $validator = Validator::make($request->all(), [
            'tenant_id'         => 'required',
            'order'             => 'required',
            'question_id'   => 'required',
            'test_id'       => 'required',
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //create testQuestion
        $testQuestion = TestQuestion::create([
            'tenant_id'     => $request->tenant_id,
            'order'         => $request->order,
            'question_id'   => $request->question_id,
            'test_id'       => $request->test_id,
        ]);

        //return response
        return new TestQuestionResource(true, 'Data Test Question Berhasil Ditambahkan!', $testQuestion);
    }

    /**
     * show
     *
     * @param  mixed $testQuestion
     * @return void
     */
    public function show(TestQuestion $testQuestion)
    {
        //return single testQuestion as a resource
        return new TestQuestionResource(true, 'Data Test Question Ditemukan!', $testQuestion);
    }

    /**
     * update
     *
     * @param  mixed $request
     * @param  mixed $testQuestion
     * @return void
     */
    public function update(Request $request, TestQuestion $testQuestion)
    {
        //define validation rules
        $validator = Validator::make($request->all(), [
            'question_id'     => 'required',
            'test_id'         => 'required',
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //update testQuestion without image
        $testQuestion->update([
            'question_id'     => $request->question_id,
            'test_id'         => $request->test_id,
        ]);

        //return response
        return new TestQuestionResource(true, 'Data Test Question Berhasil Diubah!', $testQuestion);
    }
}
