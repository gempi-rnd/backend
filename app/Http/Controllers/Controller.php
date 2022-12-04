<?php

namespace App\Http\Controllers;

use App\Http\Resources\GroupTopicResource;
use App\Http\Resources\StudentResource;
use App\Models\Student;
use App\Models\Tenant;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct()
    {
        try {
            // $this->middleware('auth:api');
        } catch (\Exception $e) {
            $response['status'] = false;
            $response['message'] = $e->getMessage();

            return response()->json($response, 401);
        }
    }

    public function tenantCheck()
    {
        $user = auth('api')->user();

        $student = Student::where('user_id', $user->id)->first();
        if (!$student) {
            return new StudentResource(false, 'Student Tidak Ditemukan!', null);
        }

        $tenant = Tenant::where('id', $student->tenant_id)->first();
        if (!$tenant) {
            return new GroupTopicResource(false, 'Tenant Tidak Ditemukan!', null);
        }

        return $tenant;
    }
}
