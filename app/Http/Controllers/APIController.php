<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\User;
use App\rolepermission;
use App\Menu;
use App\Groupmenu;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
class APIController extends Controller
{
   
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
        return redirect('dashboard/addmember');
    }
    public function addpermission(Request $request)
    {
        $data=$request->all();
        $userid=$request->id;
        $deleterolepermission = rolepermission::find($userid);
        $deleterolepermission->delete();
        if($data!=null){
        foreach($data['per'] as $value)
        {
          $item['user_group_id']=$userid;
          $querygroupid=Menu::select('g_id')->where('m_id',$value)->get();
          foreach($querygroupid as $row){
            $groupid=$row['g_id'];
          }
          $item['g_id']=$groupid;
          $item['m_id']=$value;
          rolepermission::insert($item);
        }
        }
        
        return redirect('dashboard/permission');
    }
    public function getrolepermission($id)
    {
        $permiss = rolepermission::where('user_group_id',$id)->get();
        session()->put('data',$permiss);
       
        $user=auth()->user();
        $user_group=$user->user_group_id;
        $rolepermiss=rolepermission::where('user_group_id',$user_group)->get();

        session()->put('roleper',$rolepermiss);
        return redirect('dashboard/permission');
    }
    public function getgroupmenu($id)
    {
        $groupmenu = Groupmenu::where('g_id',$id)->get();
        return $groupmenu;
    }
    public function addgroupmenu(Request $request)
    {
        $data['g_name']=$request->group;
        $data['g_icon']=$request->icon;
        Groupmenu::insert($data);
        return redirect('/dashboard/MenuGroup');
    }
    public function updategroupmenu(Request $request,$id)
    {
        $data = Groupmenu::find($id);
        $data->g_name = $request->input('g_name');
        $data->g_icon = $request->input('g_icon');
        $data->save();
        return redirect('/dashboard/MenuGroup');
    }
    public function deletegroupmenu($id)
    {
        $product = Groupmenu::find($id);
        $product->delete();
        
        return redirect('/dashboard/MenuGroup');
    }
}
