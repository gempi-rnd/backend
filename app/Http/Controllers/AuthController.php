<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controllers;
use App\Models\Student;
use App\Models\Tenant;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login()
    {
        try {
            if (Auth::attempt(['email' => request('email'), 'password' => request('password')])) {
                $user = Auth::user();
                $response['status'] = true;
                $response['message'] = 'Berhasil login';
                $response['data']['token'] = 'Bearer ' . $user->createToken('snbtapp')->accessToken;

                return response()->json($response, 200);
            } else {
                $response['status'] = false;
                $response['message'] = 'Unauthorized';

                return response()->json($response, 401);
            }
        } catch (\Exception $e) {
            $response['status'] = false;
            $response['message'] = $e->getMessage();

            return response()->json($response, 401);
        }
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'full_name'     => 'required',
            'tenant_id'     => 'required',
            'whatsapp'      => 'required',
            'email'         => 'required|email', 'unique:users',
            'password'      => 'required',
            'c_password'    => 'required|same:password',
        ]);

        if ($validator->fails()) {
            $response['status'] = false;
            $response['message'] = 'Gagal registrasi';
            $response['error'] = $validator->errors();

            return response()->json($response, 422);
        }

        $tenant = Tenant::where('id', $request['tenant_id'])->first();
        if (!$tenant)
            return response()->json(['message' => 'Tenant not found'], 404);

        $user = User::create([
            'name' => $request['full_name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
        ]);


        $user = Student::create([
            'user_id' => $user->id,
            'tenant_id' => $tenant->id,
            'full_name' => $request['full_name'],
            'email' => $request['email'],
            'whatsapp' => $request['whatsapp'],
        ]);

        $response['status'] = true;
        $response['message'] = 'Berhasil registrasi';
        $response['data']['token'] = 'Bearer ' . $user->createToken('snbtapp')->accessToken;

        return response()->json($response, 200);
    }

    public function profile()
    {
        $user = Auth::user();
        $user = $user->makeHidden(['email_verified_at', 'password', 'remember_token']);

        $response['status'] = true;
        $response['message'] = 'User login profil';
        $response['data'] = $user;

        return response()->json($response, 200);
    }

    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        $response['status'] = true;
        $response['message'] = 'Berhasil logout';

        return response()->json($response, 200);
    }
}
