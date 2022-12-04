<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\TopicResource;
use App\Models\Topic;
use Illuminate\Support\Facades\Validator;

class TopicController extends Controller
{
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        //get topic
        $topic = Topic::latest()->paginate(5);

        //return collection of topic as a resource
        return new TopicResource(true, 'List Data Topic', $topic);
    }

    public function store(Request $request)
    {
        //define validation rules
        $validator = Validator::make($request->all(), [
            'tenant_id' => 'required',
            'group_topic_id'    => 'required',
            'slug'              => 'required',
            'name'              => 'required',
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //create topic
        $topic = Topic::create([
            'tenant_id'         => $request->tenant_id,
            'group_topic_id' => $request->group_topic_id,
            'slug'           => $request->slug,
            'name'           => $request->name,

        ]);

        //return response
        return new TopicResource(true, 'Data Topic Berhasil Ditambahkan!', $topic);
    }

    /**
     * show
     *
     * @param  mixed $topic
     * @return void
     */
    public function show(Topic $topic)
    {
        //return single topic as a resource
        return new TopicResource(true, 'Data Topic Ditemukan!', $topic);
    }

    /**
     * update
     *
     * @param  mixed $request
     * @param  mixed $topic
     * @return void
     */
    public function update(Request $request, Topic $topic)
    {
        //define validation rules
        $validator = Validator::make($request->all(), [
            'group_topic_id'    => 'required',
            'slug'              => 'required',
            'name'              => 'required',
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //update topic without image
        $topic->update([
            'group_topic_id' => $request->group_topic_id,
            'slug'           => $request->slug,
            'name'           => $request->name,
        ]);

        //return response
        return new TopicResource(true, 'Data Topic Berhasil Diubah!', $topic);
    }
}
