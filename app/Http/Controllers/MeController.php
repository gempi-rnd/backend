<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Student;

class MeController extends Controller
{
    /**
     * show
     *
     * @param  mixed $tenant
     * @return void
     */

    public function me(Request $request)
    {
        $user = $request->user();
        $response['status'] = true;
        $response['message'] = 'Berhasil mendapatkan data';
        $response['data'] = $user;
        $response['data']['student'] = Student::where('user_id', $user->id)->first()->makeHidden(['user_id']);
        return $response;
    }
}
