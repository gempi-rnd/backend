<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\TestResource;
use App\Models\Student;
use App\Models\Test;
use Illuminate\Support\Facades\Validator;

class TestController extends Controller
{
    /**
     * index
     *
     * @return void
     */
    public function index(Request $request)
    {
        $user = $request->user();
        $student = Student::where('user_id', $user->id)->first();
        if ($user->role->code == 'student' || $user->role->code == 'admintenant') {
            $test = Test::where('tenant_id', $student->tenant_id)->latest()->paginate(5);
        } else {
            $test = Test::latest()->paginate(5);
        }

        //return collection of test as a resource
        return new TestResource(true, 'List Data Test', $test);
    }

    public function store(Request $request)
    {
        //define validation rules
        $validator = Validator::make($request->all(), [
            'code' => 'required',
            'title' => 'required',
            'tenant_id' => 'required',
            'topic_id' => 'required',
            'description' => 'required',
            'total_questions' => 'required',
            'total_duration' => 'required',
            'settings' => 'required',
            'status' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',

        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //create test
        $test = Test::create([
            'code'              => $request->code,
            'title'              => $request->title,
            'tenant_id'     => $request->tenant_id,
            'topic_id'       => $request->topic_id,
            'description'   => $request->description,
            'total_questions'    => $request->total_questions,
            'total_duration'          => $request->total_duration,
            'settings'         => $request->settings,
            'status'         => $request->status,
            'start_time'         => $request->start_time,
            'end_time'         => $request->end_time,
        ]);

        //return response
        return new TestResource(true, 'Data Test Berhasil Ditambahkan!', $test);
    }

    /**
     * show
     *
     * @param  mixed $test
     * @return void
     */
    public function show(Test $test)
    {
        //return single test as a resource
        return new TestResource(true, 'Data Test Ditemukan!', $test);
    }

    /**
     * update
     *
     * @param  mixed $request
     * @param  mixed $test
     * @return void
     */
    public function update(Request $request, Test $test)
    {
        //define validation rules
        $validator = Validator::make($request->all(), [
            'code'              => 'required',
            'name'              => 'required',
            'description'       => 'required',
            'total_questions'   => 'required',
            'total_duration'    => 'required',
            'settings'          => 'required',
            'is_active'         => 'required',
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //update test without image
        $test->update([
            'code'              => $request->code,
            'name'              => $request->name,
            'description'       => $request->description,
            'total_questions'   => $request->total_questions,
            'total_duration'    => $request->total_duration,
            'settings'          => $request->settings,
            'is_active'         => $request->is_active,
        ]);

        //return response
        return new TestResource(true, 'Data Test Berhasil Diubah!', $test);
    }
}
