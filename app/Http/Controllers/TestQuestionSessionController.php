<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\TestQuestionSessionResource;
use App\Models\TestQuestionSession;
use Illuminate\Support\Facades\Validator;

class TestQuestionSessionController extends Controller
{

    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        //get testQuestionSession
        $testQuestionSession = TestQuestionSession::latest()->paginate(5);

        //return collection of testQuestionSession as a resource
        return new TestQuestionSessionResource(true, 'List Data Test Question Session', $testQuestionSession);
    }

    public function generateTestQuestionSessions(Request $request)
    {
        var_dump(234);
        exit;
        //define validation rules
        $validator = Validator::make($request->all(), [
            'tenant_id'         => 'required',
            'test_session_id'   => 'required',
            'question_id'       => 'required',
            'options'           => 'required',
            'user_answer'       => 'required',
            'status'            => 'required',
            'time_taken'        => 'required',
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //create testQuestionSession
        $testQuestionSession = TestQuestionSession::create([
            'tenant_id'     => $request->tenant_id,
            'test_session_id'   => $request->test_session_id,
            'question_id'       => $request->question_id,
            'options'           => $request->options,
            'user_answer'       => $request->user_answer,
            'status'            => $request->status,
            'time_taken'        => $request->time_taken,
        ]);

        //return response
        return new TestQuestionSessionResource(true, 'Data Test Question Session Berhasil Ditambahkan!', $testQuestionSession);
    }

    public function store(Request $request)
    {
        //define validation rules
        $validator = Validator::make($request->all(), [
            'tenant_id'         => 'required',
            'test_session_id'   => 'required',
            'question_id'       => 'required',
            'options'           => 'required',
            'user_answer'       => 'required',
            'status'            => 'required',
            'time_taken'        => 'required',
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //create testQuestionSession
        $testQuestionSession = TestQuestionSession::create([
            'tenant_id'     => $request->tenant_id,
            'test_session_id'   => $request->test_session_id,
            'question_id'       => $request->question_id,
            'options'           => $request->options,
            'user_answer'       => $request->user_answer,
            'status'            => $request->status,
            'time_taken'        => $request->time_taken,
        ]);

        //return response
        return new TestQuestionSessionResource(true, 'Data Test Question Session Berhasil Ditambahkan!', $testQuestionSession);
    }

    /**
     * show
     *
     * @param  mixed $testQuestionSession
     * @return void
     */
    public function show(TestQuestionSession $testQuestionSession)
    {
        //return single testQuestionSession as a resource
        return new TestQuestionSessionResource(true, 'Data Test Question Session Ditemukan!', $testQuestionSession);
    }

    /**
     * update
     *
     * @param  mixed $request
     * @param  mixed $testQuestionSession
     * @return void
     */
    public function update(Request $request, TestQuestionSession $testQuestionSession)
    {
        //define validation rules
        $validator = Validator::make($request->all(), [
            'test_session_id'   => 'required',
            'question_id'       => 'required',
            'options'           => 'required',
            'user_answer'       => 'required',
            'status'            => 'required',
            'time_taken'        => 'required',
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //update testQuestionSession without image
        $testQuestionSession->update([
            'test_session_id'   => $request->test_session_id,
            'question_id'       => $request->question_id,
            'options'           => $request->options,
            'user_answer'       => $request->user_answer,
            'status'            => $request->status,
            'time_taken'        => $request->time_taken,
        ]);

        //return response
        return new TestQuestionSessionResource(true, 'Data Test Question Session Berhasil Diubah!', $testQuestionSession);
    }
}
