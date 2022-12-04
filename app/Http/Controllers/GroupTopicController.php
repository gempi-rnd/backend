<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\GroupTopicResource;
use App\Models\GroupTopic;
use App\Models\Student;
use App\Models\Tenant;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Laravel\Passport\Token;

class GroupTopicController extends Controller
{
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        $tenant = $this->tenantCheck();
        //get groupTopic
        $groupTopic = GroupTopic::where('tenant_id', $tenant->id)
            ->latest()
            ->paginate(5);

        //return collection of groupTopic as a resource
        return new GroupTopicResource(true, 'List Data Group Topic', $groupTopic);
    }

    public function store(Request $request)
    {
        //define validation rules
        $validator = Validator::make($request->all(), [
            'tenant_id' => 'required',
            'slug' => 'required', 'unique:group_topics',
            'name' => 'required',
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //create groupTopic
        $groupTopic = GroupTopic::create([
            'tenant_id'         => $request->tenant_id,
            'slug'              => $request->slug,
            'name'              => $request->name,
        ]);

        //return response
        return new GroupTopicResource(true, 'Data Group Topic Berhasil Ditambahkan!', $groupTopic);
    }

    /**
     * show
     *
     * @param  mixed $groupTopic
     * @return void
     */
    public function show(GroupTopic $groupTopic)
    {
        $tenant = $this->tenantCheck();

        //return single groupTopic as a resource
        return new GroupTopicResource(true, 'Data Group Topic Ditemukan!', $groupTopic);
    }

    /**
     * update
     *
     * @param  mixed $request
     * @param  mixed $groupTopic
     * @return void
     */
    public function update(Request $request, GroupTopic $groupTopic)
    {
        //define validation rules
        $validator = Validator::make($request->all(), [
            'slug' => 'required', 'unique:group_topics',
            'name' => 'required',
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //update groupTopic without image
        $groupTopic->update([
            'slug'              => $request->slug,
            'name'              => $request->name,
        ]);

        //return response
        return new GroupTopicResource(true, 'Data Group Topic Berhasil Diubah!', $groupTopic);
    }
}
