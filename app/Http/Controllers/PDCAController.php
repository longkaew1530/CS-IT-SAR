<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
class PDCAController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data=new User;
        $data->user_fullname=$request->user_fullname;
        $data->email=$request->email;
        $data->username=$request->username;
        $inputpass=$request->password;
        $data->password = Hash::make($inputpass);
        $data->save();
        // $data->id;
        // $user=User::find($data->id);
        // if($request->role=='Admin')
        //     {
        //         $user->assignRole('Admin');
        //     }
        //     else if($request->role=='ผู้บริหาร')
        //     {
        //         $user->assignRole('ผู้บริหาร');
        //     }
        //     else if($request->role=='ประธานหลักสูตร')
        //     {
        //         $user->assignRole('ประธานหลักสูตร');
        //     }
        //     else if($request->role=='อาจารย์')
        //     {
        //         $user->assignRole('อาจารย์');
        //     }
        return redirect('dashboard/admember');
    }
    public function addpermission(Request $request)
    {
        $data=$request->all();
        $userid=$request->id;
        $user=auth()->user();
        $role=Role::find($userid);
        foreach($data['per'] as $value)
        {
            $role->givePermissionTo($value);
        }
        return redirect('dashboard/permission');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
