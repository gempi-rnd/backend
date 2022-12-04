<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\TestSessionResource;
use App\Models\TestSession;
use Illuminate\Support\Facades\Validator;

class TestSessionController extends Controller
{
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        //get testSession
        $testSession = TestSession::latest()->paginate(5);

        //return collection of testSession as a resource
        return new TestSessionResource(true, 'List Data Test Session', $testSession);
    }

    public function store(Request $request)
    {
        //define validation rules
        $validator = Validator::make($request->all(), [
            'tenant_id'         => 'required',
            'user_id'           => 'required',
            'test_id'           => 'required',
            'start_time'        => 'required',
            'end_time'          => 'required',
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //create testSession
        $testSession = TestSession::create([
            'tenant_id'         => $request->tenant_id,
            'user_id'           => $request->user_id,
            'test_id'           => $request->test_id,
            'start_time'        => $request->start_time,
            'end_time'          => $request->end_time,
        ]);

        //return response
        return new TestSessionResource(true, 'Data Test Session Berhasil Ditambahkan!', $testSession);
    }

    /**
     * show
     *
     * @param  mixed $testSession
     * @return void
     */
    public function show(TestSession $testSession)
    {
        //return single testSession as a resource
        return new TestSessionResource(true, 'Data Test Session Ditemukan!', $testSession);
    }

    /**
     * update
     *
     * @param  mixed $request
     * @param  mixed $testSession
     * @return void
     */
    public function update(Request $request, TestSession $testSession)
    {
        //define validation rules
        $validator = Validator::make($request->all(), [
            'tenant_id'         => 'required',
            'user_id'           => 'required',
            'test_id'           => 'required',
            'test_schedule_id'  => 'required',
            'start_time'        => 'required',
            'end_time'          => 'required',
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //update testSession without image
        $testSession->update([
            'tenant_id'         => $request->tenant_id,
            'user_id'           => $request->user_id,
            'test_id'           => $request->test_id,
            'test_schedule_id'  => $request->test_schedule_id,
            'start_time'        => $request->start_time,
            'end_time'          => $request->end_time,
        ]);

        //return response
        return new TestSessionResource(true, 'Data Test Session Berhasil Diubah!', $testSession);
    }
}
