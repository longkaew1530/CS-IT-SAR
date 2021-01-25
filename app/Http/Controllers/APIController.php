<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\User;
use App\rolepermission;
use App\Menu;
use App\Groupmenu;
use App\Course;
use App\Faculty;
use App\groupuser;
use App\Year;
use Validator;
use File;
use App\imagetest;
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
        $user=auth()->user();
        $user_group=$user->user_group_id;
        $groupmenu=Groupmenu::all();
        $rolepermiss=rolepermission::where('user_group_id',$user_group)->get();
       
         foreach ($groupmenu as $key => $value){
            $value->menu->first(); 
         }
        session()->put('groupmenu',$groupmenu);
        session()->put('roleper',$rolepermiss);
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
        return redirect('/Menu');
    }
    public function updatemenu(Request $request)
    {
        $gid=$request->input('m_id1');
        $data = Menu::find($gid);
        $data->m_name = $request->input('m_name1');
        $data->m_url = $request->input('m_url1');
        $data->g_id = $request->input('g_id1');
        $data->save();
        return redirect('/Menu');
    }
    public function deletemenu($id)
    {
        $product = Menu::find($id);
        $product->delete();
        
        return redirect('/Menu');
    }
    /////menu/////menu/////menu/////menu/////menu/////menu

     /////หลักสูตร/////หลักสูตร/////หลักสูตร/////หลักสูตร/////หลักสูตร/////หลักสูตร
     public function getcourse($id)
     {
         $course = Course::where('course_id',$id)->get();
         return $course;
     }
     public function addcourse(Request $request)
     {
         $data['course_name']=$request->course_name;
         $data['faculty_id']=$request->faculty_id ;
         $data['course_code']=$request->course_code;
         $data['branch']=$request->branch;
         $data['update_course']=$request->update_course;
         $data['place']=$request->place;
         Course::insert($data);
         return redirect('/dashboard/course');
     }
     public function updatecourse(Request $request)
     {
         $course_id=$request->input('course_id');
         $data = Course::find($course_id);
         $data->course_name = $request->input('course_name');
         $data->faculty_id = $request->input('faculty_id');
         $data->course_code = $request->input('course_code');
         $data->branch = $request->input('branch');
         $data->update_course = $request->input('update_course');
         $data->place = $request->input('place');
         $data->save();
         return redirect('/dashboard/course');
     }
     public function deletecourse($id)
     {
         $product = Course::find($id);
         $product->delete();
         
         return redirect('/dashboard/course');
     }
     /////หลักสูตร/////หลักสูตร/////หลักสูตร/////หลักสูตร/////หลักสูตร/////หลักสูตร

     /////คณะ/////คณะ/////คณะ/////คณะ/////คณะ/////คณะ
     public function getfaculty($id)
     {
         $faculty = Faculty::where('faculty_id',$id)->get();
         return $faculty;
     }
     public function addfaculty(Request $request)
     {
         $data['faculty_name']=$request->faculty_name;
         Faculty::insert($data);
         return redirect('/dashboard/faculty');
     }
     public function updatefaculty(Request $request)
     {
         $course_id=$request->input('faculty_id');
         $data = Faculty::find($course_id);
         $data->faculty_name = $request->input('faculty_name');
         $data->save();
         return redirect('/dashboard/faculty');
     }
     public function deletefaculty($id)
     {
         $product = Faculty::find($id);
         $product->delete();
         
         return redirect('/dashboard/faculty');
     }
     /////คณะ/////คณะ/////คณะ/////คณะ/////คณะ/////คณะ

     /////กลุ่มผู้ใช้งาน/////กลุ่มผู้ใช้งาน/////กลุ่มผู้ใช้งาน/////กลุ่มผู้ใช้งาน/////กลุ่มผู้ใช้งาน/////กลุ่มผู้ใช้งาน
     public function getusergroup($id)
     {
         $groupuser = groupuser::where('user_group_id',$id)->get();
         return $groupuser;
     }
     public function addusergroup(Request $request)
     {
         $data['user_group_name']=$request->user_group_name;
         groupuser::insert($data);
         return redirect('/dashboard/usergroup');
     }
     public function updateusergroup(Request $request)
     {
         $course_id=$request->input('user_group_id');
         $data = groupuser::find($course_id);
         $data->user_group_name = $request->input('user_group_name');
         $data->save();
         return redirect('/dashboard/usergroup');
     }
     public function deleteusergroup($id)
     {
         $product = groupuser::find($id);
         $product->delete();
         
         return redirect('/dashboard/usergroup');
     }
     /////กลุ่มผู้ใช้งาน/////กลุ่มผู้ใช้งาน/////กลุ่มผู้ใช้งาน/////กลุ่มผู้ใช้งาน/////กลุ่มผู้ใช้งาน/////กลุ่มผู้ใช้งาน
     
     /////ปีถัดไป/////ปีถัดไป/////ปีถัดไป/////ปีถัดไป/////ปีถัดไป/////ปีถัดไป
     public function nextyear()
     {
         $getyear=Year::all();
         foreach($getyear as $value){
             $nextyear=$value['year_name'];
         }
         $queryyaer=Year::find(1);
         $nextyear++;
         $queryyaer->year_name=$nextyear;
         $queryyaer->save();
         return $queryyaer;
     }
     /////ปีถัดไป/////ปีถัดไป/////ปีถัดไป/////ปีถัดไป/////ปีถัดไป/////ปีถัดไป

     /////ปีก่อนหน้า/////ปีก่อนหน้า/////ปีก่อนหน้า/////ปีก่อนหน้า/////ปีก่อนหน้า/////ปีก่อนหน้า
     public function backyear()
     {
         $getyear=Year::all();
         foreach($getyear as $value){
             $backyear=$value['year_name'];
         }
         $queryyaer=Year::find(1);
         $backyear--;
         $queryyaer->year_name=$backyear;
         $queryyaer->save();
         return $queryyaer;
     }
     /////ปีก่อนหน้า/////ปีก่อนหน้า/////ปีก่อนหน้า/////ปีก่อนหน้า/////ปีก่อนหน้า/////ปีก่อนหน้า


     /////เพิ่มผู้ใช้งาน/////เพิ่มผู้ใช้งาน/////เพิ่มผู้ใช้งาน/////เพิ่มผู้ใช้งาน/////เพิ่มผู้ใช้งาน/////เพิ่มผู้ใช้งาน
     public function getuser($id)
     {
         $user = User::where('id',$id)->get();
         return $user;
     }
     public function adduser(Request $request)
     {
         
        request()->validate([
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
       ]); 
       $data = ['user_fullname' => $request->user_fullname,
         'email' => $request->email,
          'username' => $request->username,
          'password' => Hash::make($request->password),
          'user_faculty' => $request->user_faculty,
          'user_course' => $request->user_course,
          'user_group_id' => $request->user_group_id,
          'academic_position' => $request->academic_position,
        ];
        if ($files = $request->file('image')) {
            
           //delete old file
           \File::delete('public/user/'.$request->hidden_image);
         
           //insert new file
           $destinationPath = 'public/user/'; // upload path
           $profileImage = date('YmdHis') . "." . $files->getClientOriginalExtension();
           $files->move($destinationPath, $profileImage);
           $data['image'] = "$profileImage";
        }
        
        User::insert($data);  
    
        
     }
     public function updateuser(Request $request)
     {
        $user_id=$request->input('userid');
        $data = User::find($user_id);
         request()->validate([
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
       ]); 
       $data->user_fullname = $request->input('user_fullname');
       $data->email = $request->input('email');
       $data->username = $request->input('username');
       if($request->input('password')){
        $data->password = Hash::make($request->input('password'));
       }
       $data->user_faculty = $request->input('user_faculty');
       $data->user_course = $request->input('user_course');
       $data->user_group_id = $request->input('user_group_id');
       $data->academic_position = $request->input('academic_position');
        if ($files = $request->file('image')) {
           //delete old file
           \File::delete('public/user/'.$request->hidden_image);
           //insert new file
           $destinationPath = 'public/user/'; // upload path
           $profileImage = date('YmdHis') . "." . $files->getClientOriginalExtension();
           $files->move($destinationPath, $profileImage);
           $data->image = "$profileImage";
        }
        $data->save();
        return redirect('/dashboard/addmember'); 
     }
     public function deleteuser($id)
     {
         $product = User::find($id);
         $product->delete();
         
         
     }
     /////เพิ่มผู้ใช้งาน/////เพิ่มผู้ใช้งาน/////เพิ่มผู้ใช้งาน/////เพิ่มผู้ใช้งาน/////เพิ่มผู้ใช้งาน/////เพิ่มผู้ใช้งาน
}
