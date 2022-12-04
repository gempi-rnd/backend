<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\DifficultyLevelResource;
use App\Models\DifficultyLevels;
use Illuminate\Support\Facades\Validator;

class DifficultyLevelController extends Controller
{
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        //get difficultyLevel
        $difficultyLevel = DifficultyLevels::latest()->paginate(5);

        //return collection of difficultyLevel as a resource
        return new DifficultyLevelResource(true, 'List Data Difficulty Levels', $difficultyLevel);
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

        //create difficultyLevel
        $difficultyLevel = DifficultyLevels::create([
            'name'              => $request->name,
            'code'              => $request->code,
            'short_description' => $request->short_description,
        ]);

        //return response
        return new DifficultyLevelResource(true, 'Data Difficulty Level Berhasil Ditambahkan!', $difficultyLevel);
    }

    /**
     * show
     *
     * @param  mixed $difficultyLevel
     * @return void
     */
    public function show(DifficultyLevels $difficultyLevel)
    {
        //return single difficultyLevel as a resource
        return new DifficultyLevelResource(true, 'Data Difficulty Level Ditemukan!', $difficultyLevel);
    }

    /**
     * update
     *
     * @param  mixed $request
     * @param  mixed $difficultyLevel
     * @return void
     */
    public function update(Request $request, DifficultyLevels $difficultyLevel)
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

        //update difficultyLevel without image
        $difficultyLevel->update([
            'name'              => $request->name,
            'code'              => $request->code,
            'short_description' => $request->short_description,
        ]);

        //return response
        return new DifficultyLevelResource(true, 'Data Difficulty Level Berhasil Diubah!', $difficultyLevel);
    }
}
