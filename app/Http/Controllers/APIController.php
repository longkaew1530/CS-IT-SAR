<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\User;
use App\rolepermission;
use App\Menu;
use App\Groupmenu;
use App\Course;
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
        if($deleterolepermission!=null){
            $deleterolepermission->delete();
        }
        
        if(isset($data['per'])){
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
       
        
        return redirect('dashboard/permission');
    }

    /////groupmenu/////groupmenu/////groupmenu/////groupmenu/////groupmenu/////groupmenu
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
    public function updategroupmenu(Request $request)
    {
        $gid=$request->input('g_id');
        $data = Groupmenu::find($gid);
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
    /////groupmenu/////groupmenu/////groupmenu/////groupmenu/////groupmenu/////groupmenu

    /////menu/////menu/////menu/////menu/////menu/////menu
    public function getmenu($id)
    {
        $groupmenu = Menu::where('m_id',$id)->get();
        return $groupmenu;
    }
    public function addmenu(Request $request)
    {
        $data['m_name']=$request->m_name;
        $data['m_url']=$request->m_url;
        $data['g_id']=$request->g_id;
        Menu::insert($data);
        return redirect('/dashboard/Menu');
    }
    public function updatemenu(Request $request)
    {
        $gid=$request->input('m_id1');
        $data = Menu::find($gid);
        $data->m_name = $request->input('m_name1');
        $data->m_url = $request->input('m_url1');
        $data->g_id = $request->input('g_id1');
        $data->save();
        return redirect('/dashboard/Menu');
    }
    public function deletemenu($id)
    {
        $product = Menu::find($id);
        $product->delete();
        
        return redirect('/dashboard/Menu');
    }
    /////menu/////menu/////menu/////menu/////menu/////menu

     /////หลักสูตร/////หลักสูตร/////หลักสูตร/////หลักสูตร/////หลักสูตร/////หลักสูตร
     public function getcourse()
     {
         $course = Course::where('course_id',$id)->get();
         return $course;
     }
     public function addcourse(Request $request)
     {
         $data['m_name']=$request->m_name;
         $data['m_url']=$request->m_url;
         $data['g_id']=$request->g_id;
         Course::insert($data);
         return redirect('/dashboard/Menu');
     }
     public function updatecourse(Request $request)
     {
         $gid=$request->input('m_id1');
         $data = Course::find($gid);
         $data->m_name = $request->input('m_name1');
         $data->m_url = $request->input('m_url1');
         $data->g_id = $request->input('g_id1');
         $data->save();
         return redirect('/dashboard/Menu');
     }
     public function deletecourse($id)
     {
         $product = Course::find($id);
         $product->delete();
         
         return redirect('/dashboard/Menu');
     }
     /////หลักสูตร/////หลักสูตร/////หลักสูตร/////หลักสูตร/////หลักสูตร/////หลักสูตร
     
}
