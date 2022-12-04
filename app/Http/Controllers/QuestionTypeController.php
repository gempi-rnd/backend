<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\QuestionTypeResource;
use App\Models\QuestionType;
use Illuminate\Support\Facades\Validator;

class QuestionTypeController extends Controller
{
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        //get questionType
        $questionType = QuestionType::latest()->paginate(5);

        //return collection of questionType as a resource
        return new QuestionTypeResource(true, 'List Data Question Types', $questionType);
    }

    public function store(Request $request)
    {
        //define validation rules
        $validator = Validator::make($request->all(), [
            'name'              => 'required',
            'code'              => 'required', 'unique:dificulty_levels',
            'short_description' => 'required',
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //create questionType
        $questionType = QuestionType::create([
            'name'              => $request->name,
            'code'              => $request->code,
            'short_description' => $request->short_description,
        ]);

        //return response
        return new QuestionTypeResource(true, 'Data Question Type Berhasil Ditambahkan!', $questionType);
    }

    /**
     * show
     *
     * @param  mixed $questionType
     * @return void
     */
    public function show(QuestionType $questionType)
    {
        //return single questionType as a resource
        return new QuestionTypeResource(true, 'Data Question Type Ditemukan!', $questionType);
    }

    /**
     * update
     *
     * @param  mixed $request
     * @param  mixed $questionType
     * @return void
     */
    public function update(Request $request, QuestionType $questionType)
    {
        //define validation rules
        $validator = Validator::make($request->all(), [
            'name'              => 'required',
            'code'              => 'required', 'unique:question_types',
            'short_description' => 'required',
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //update questionType without image
        $questionType->update([
            'name'              => $request->name,
            'code'              => $request->code,
            'short_description' => $request->short_description,
        ]);

        //return response
        return new QuestionTypeResource(true, 'Data Question Type Berhasil Diubah!', $questionType);
    }
}
