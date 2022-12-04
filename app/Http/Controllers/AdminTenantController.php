<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Resources\AdminTenantResource;
use Illuminate\Http\Request;
use App\Models\AdminTenant;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Spatie\QueryBuilder\QueryBuilder;

class AdminTenantController extends Controller
{
    /**
     * index
     *
     * @return void
     */
    public function index(Request $request)
    {
        //get adminTenant
        $adminTenant = QueryBuilder::for(AdminTenant::class)
            ->allowedFilters(['full_name', 'email'])
            ->paginate(5);

        //return collection of adminTenant as a resource
        return new AdminTenantResource(true, 'List Data Admin Tenants', $adminTenant);
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

        //create adminTenant
        $adminTenant = AdminTenant::create([
            'photo'         => $photo->hashName(),
            'full_name'     => $request->full_name,
            'tenant_id'     => $request->tenant_id,
            'whatsapp'      => $request->whatsapp,
            'email'         => $request->email,
        ]);

        //return response
        return new AdminTenantResource(true, 'Data Admin Tenant Berhasil Ditambahkan!', $adminTenant);
    }

    /**
     * show
     *
     * @param  mixed $adminTenant
     * @return void
     */
    public function show(AdminTenant $adminTenant)
    {
        //return single adminTenant as a resource
        return new AdminTenantResource(true, 'Data Admin Tenant Ditemukan!', $adminTenant);
    }

    /**
     * update
     *
     * @param  mixed $request
     * @param  mixed $adminTenant
     * @return void
     */
    public function update(Request $request, AdminTenant $adminTenant)
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
            Storage::delete('public/user/' . $adminTenant->photo);

            //update adminTenant with new photo
            $adminTenant->update([
                'photo'         => $photo->hashName(),
                'full_name'     => $request->full_name,
                'tenant_id'     => $request->tenant_id,
                'whatsapp'      => $request->whatsapp,
                'email'         => $request->email,
            ]);
        } else {
            //update adminTenant without image
            $adminTenant->update([
                'full_name'     => $request->full_name,
                'tenant_id'     => $request->tenant_id,
                'whatsapp'      => $request->whatsapp,
                'email'         => $request->email,
            ]);
        }

        //return response
        return new AdminTenantResource(true, 'Data Admin Tenant Berhasil Diubah!', $adminTenant);
    }
}
