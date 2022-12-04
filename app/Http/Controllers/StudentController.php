<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Resources\StudentResource;
use Illuminate\Http\Request;
use App\Models\Student;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Spatie\QueryBuilder\QueryBuilder;

class StudentController extends Controller
{
    /**
     * index
     *
     * @return void
     */
    public function index(Request $request)
    {
        //get student
        $student = QueryBuilder::for(Student::class)
            ->allowedFilters(['full_name', 'email'])
            ->paginate(5);

        //return collection of student as a resource
        return new StudentResource(true, 'List Data Students', $student);
    }

    public function store(Request $request)
    {
        //define validation rules
        $validator = Validator::make($request->all(), [
            'full_name'     => 'required',
            'tenant_id'     => 'required',
            'whatsapp'      => 'required',
            'photo'         => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'email'         => 'required|email', 'unique:users',
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //upload photo
        $photo = $request->file('photo');
        $photo->storeAs('public/user', $photo->hashName());

        //create student
        $student = Student::create([
            'photo'         => $photo->hashName(),
            'full_name'     => $request->full_name,
            'tenant_id'     => $request->tenant_id,
            'whatsapp'      => $request->whatsapp,
            'email'         => $request->email,
        ]);

        //return response
        return new StudentResource(true, 'Data Student Berhasil Ditambahkan!', $student);
    }

    /**
     * show
     *
     * @param  mixed $student
     * @return void
     */
    public function show(Student $student)
    {
        //return single student as a resource
        return new StudentResource(true, 'Data Student Ditemukan!', $student);
    }

    /**
     * update
     *
     * @param  mixed $request
     * @param  mixed $student
     * @return void
     */
    public function update(Request $request, Student $student)
    {
        //define validation rules
        $validator = Validator::make($request->all(), [
            'photo'         => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'full_name'     => 'required',
            'tenant_id'     => 'required',
            'whatsapp'      => 'required',
            'email'         => 'required|email', 'unique:users',
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //check if photo is not empty
        if ($request->hasFile('photo')) {

            //upload photo
            $photo = $request->file('photo');
            $photo->storeAs('public/user', $photo->hashName());

            //delete old photo
            Storage::delete('public/user/' . $student->photo);

            //update student with new photo
            $student->update([
                'photo'         => $photo->hashName(),
                'full_name'     => $request->full_name,
                'tenant_id'     => $request->tenant_id,
                'whatsapp'      => $request->whatsapp,
                'email'         => $request->email,
            ]);
        } else {
            //update student without image
            $student->update([
                'full_name'     => $request->full_name,
                'tenant_id'     => $request->tenant_id,
                'whatsapp'      => $request->whatsapp,
                'email'         => $request->email,
            ]);
        }

        //return response
        return new StudentResource(true, 'Data Student Berhasil Diubah!', $student);
    }
}
