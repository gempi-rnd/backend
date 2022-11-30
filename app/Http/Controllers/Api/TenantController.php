<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Tenant\TenantResource;
use Illuminate\Http\Request;
use App\Models\Tenant\Tenant;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;


class TenantController extends Controller
{
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        //get tenant
        $tenant = Tenant::latest()->paginate(5);

        //return collection of tenant as a resource
        return new TenantResource(true, 'List Data Tenants', $tenant);
    }

    public function store(Request $request)
    {
        //define validation rules
        $validator = Validator::make($request->all(), [
            'slug'      => 'required',
            'name'      => 'required',
            'logo'      => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'locale'    => 'required',
            'timezone'  => 'required',
            'email'     => 'required',
            'content'   => 'required',
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //upload logo
        $logo = $request->file('logo');
        $logo->storeAs('public/tenant', $logo->hashName());

        //create tenant
        $tenant = Tenant::create([
            'logo'      => $logo->hashName(),
            'name'      => $request->name,
            'slug'      => $request->slug,
            'locale'    => $request->locale,
            'timezone'  => $request->timezone,
            'email'     => $request->email,
            'content'   => $request->content,
        ]);

        //return response
        return new TenantResource(true, 'Data Tenant Berhasil Ditambahkan!', $tenant);
    }

    /**
     * show
     *
     * @param  mixed $tenant
     * @return void
     */
    public function show(Tenant $tenant)
    {
        //return single tenant as a resource
        return new TenantResource(true, 'Data Tenant Ditemukan!', $tenant);
    }

    /**
     * update
     *
     * @param  mixed $request
     * @param  mixed $tenant
     * @return void
     */
    public function update(Request $request, Tenant $tenant)
    {
        //define validation rules
        $validator = Validator::make($request->all(), [
            'slug'      => 'required',
            'name'      => 'required',
            'logo'      => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'locale'    => 'required',
            'timezone'  => 'required',
            'email'     => 'required',
            'content'   => 'required',
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //check if logo is not empty
        if ($request->hasFile('logo')) {

            //upload logo
            $logo = $request->file('logo');
            $logo->storeAs('public/tenant', $logo->hashName());

            //delete old logo
            Storage::delete('public/tenant/' . $tenant->logo);

            //update tenant with new logo
            $tenant->update([
                'logo'      => $logo->hashName(),
                'name'      => $request->name,
                'slug'      => $request->slug,
                'locale'    => $request->locale,
                'timezone'  => $request->timezone,
                'email'     => $request->email,
                'content'   => $request->content,
            ]);
        } else {

            //update tenant without image
            $tenant->update([
                'name'      => $request->name,
                'slug'      => $request->slug,
                'locale'    => $request->locale,
                'timezone'  => $request->timezone,
                'email'     => $request->email,
                'content'   => $request->content,
            ]);
        }

        //return response
        return new TenantResource(true, 'Data Tenant Berhasil Diubah!', $tenant);
    }
}
