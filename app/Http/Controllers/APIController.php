<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\User;
use App\rolepermission;
use App\user_permission;
use App\Menu;
use App\Groupmenu;
use App\defaulindicator;
use App\branch;
use App\instructor;
use App\Course;
use App\Faculty;
use App\groupuser;
use App\course_teacher;
use App\indicator1_1;
use App\Year;
use Validator;
use App\category;
use App\indicator;
use App\course_responsible_teacher;
use App\assessment_results;
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
        $rolepermiss=rolepermission::leftjoin('menu','role_permission.m_id','=','menu.m_id')
        ->where('user_group_id',$user_group)
        ->get();
       
         foreach ($groupmenu as $key => $value){
            $value->menu->first(); 
         }
        session()->put('groupmenu',$groupmenu);
        session()->put('roleper',$rolepermiss);
        return redirect('/permission');
    }
    public function getrolepermission($id)
    {
        $role=GroupMenu::all();
        $permiss = rolepermission::where('user_group_id',$id)->get();
        $userid=$id;
        $nameusergroup=groupuser::where('user_group_id',$id)
        ->get();
        
        return view('dashboard.showpermission',compact('permiss','role','userid','nameusergroup'));
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
        return redirect('/MenuGroup');
    }
    public function updategroupmenu(Request $request)
    {
        $gid=$request->input('g_id');
        $data = Groupmenu::find($gid);
        $data->g_name = $request->input('g_name');
        $data->g_icon = $request->input('g_icon');
        $data->save();
        return redirect('/MenuGroup');
    }
    public function deletegroupmenu($id)
    {
        $product = Groupmenu::find($id);
        $product->delete();
        
        return redirect('/MenuGroup');
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
         $queryyaer= new Year;
         $nextyear++;
         $queryyaer->year_name=$nextyear;
         $queryyaer->save();
         $getall=defaulindicator::all();
         $getcourse=Course::all();
         foreach($getcourse as $row){
            foreach($getall as $value){
                    $data=new indicator;
                    $data['Indicator_id']=$value['Indicator_id'];
                    $data['Indicator_name']=$value['Indicator_name'];
                    $data['category_id']=$value['category_id'];
                    $data['composition_id']=$value['composition_id'];
                    $data['url']=$value['url'];
                    $data['active']=1;
                    $data['year_id']=$queryyaer->year_id;
                    $data['course_id']=session()->get('usercourse');
                    $data->save();
                    $data1=new assessment_results;
                    $data1['category_id']=$value['category_id'];
                    $data1['active']=1;
                    $data1['year_id']=$queryyaer->year_id;
                    $data1['course_id']=session()->get('usercourse');
                    $data1->save();
                    
            }
         }
         
         return $queryyaer;
     }
     /////ปีถัดไป/////ปีถัดไป/////ปีถัดไป/////ปีถัดไป/////ปีถัดไป/////ปีถัดไป

     /////ปีก่อนหน้า/////ปีก่อนหน้า/////ปีก่อนหน้า/////ปีก่อนหน้า/////ปีก่อนหน้า/////ปีก่อนหน้า
     public function backyear(Request $request)
     {
         $delete=Year::where('active',1)
         ->get();
         $get=new Year;
         foreach($delete as $row){
             $get=Year::find($row['year_id']);
             $get['active']=0;
             $get->save();
         }
         $queryyaer=Year::find($request->id);
         $queryyaer['active']=1;
         $queryyaer->save();
         return $queryyaer;
     }
     /////ปีก่อนหน้า/////ปีก่อนหน้า/////ปีก่อนหน้า/////ปีก่อนหน้า/////ปีก่อนหน้า/////ปีก่อนหน้า

      /////ลบปี/////ลบปี/////ลบปี/////ลบปี/////ลบปี/////ลบปี
      public function deleteyear($id)
      {
          $delete=Year::find($id);
          $delete->delete();
          return $delete;
      }
      /////ลบปี/////ลบปี/////ลบปี/////ลบปี/////ลบปี/////ลบปี


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


      /////หมวด/////หมวด/////หมวด/////หมวด/////หมวด/////หมวด
      public function getcategory($id)
      {
          $course = category::where('category_id',$id)->get();
          return $course;
      }
      public function addcategory(Request $request)
      {
          $data['category_name']=$request->category_name;
          category::insert($data);
          return redirect('/category');
      }
      public function updatecategory(Request $request)
      {
          $course_id=$request->input('category_id');
          $data = category::find($course_id);
          $data['category_name']=$request->category_name;
          $data->save();
          return redirect('/category');
      }
      public function deletecategory($id)
      {
          $product = category::find($id);
          $product->delete();
          
          return redirect('/category');
      }
      /////หมวด/////หมวด/////หมวด/////หมวด/////หมวด/////หมวด

      /////สาขา/////สาขา/////สาขา/////สาขา/////สาขา/////สาขา
      public function getbranch($id)
      {
          $course = branch::where('id',$id)->get();
          return $course;
      }
      public function addbranch(Request $request)
      {
          $data['name']=$request->name;
          $data['course_id']=$request->course_id;
          branch::insert($data);
          return redirect('/branch');
      }
      public function updatebranch(Request $request)
      {
          $course_id=$request->input('id');
          $data = branch::find($course_id);
          $data['name']=$request->name;
          $data['course_id']=$request->course_id;
          $data->save();
          return redirect('/branch');
      }
      public function deletebranch($id)
      {
          $product = branch::find($id);
          $product->delete();
          
          return redirect('/branch');
      }
      /////สาขา/////สาขา/////สาขา/////สาขา/////สาขา/////สาขา

      public function addassessment_results(Request $request)
    {
        $data=$request->all();
        if(isset($data['per'])){
        foreach($data['per'] as $value)
        {
          $item['category_id']=$value;
          $item['year_id']=session()->get('year_id');
          assessment_results::insert($item);
        }
        }
        return redirect('/assessment_results');
    }

    /////เพิ่มอาจารย์ประจำหลักสูตร/////เพิ่มอาจารย์ประจำหลักสูตร/////เพิ่มอาจารย์ประจำหลักสูตร/////เพิ่มอาจารย์ประจำหลักสูตร/////เพิ่มอาจารย์ประจำหลักสูตร/////เพิ่มอาจารย์ประจำหลักสูตร
    public function gettccourse($id)
    {
        $course = course_teacher::where('category_id',$id)->get();
        return $course;
    }
    public function addtccourse(Request $request)
    {
        foreach($request->idall as $value){
            $data['user_id']=$value;
            $data['year_id']=session()->get('year_id');
            $data['course_id']=session()->get('usercourse');
            course_teacher::insert($data);
        }
        return $data;
    }
    public function deletetccourse($id)
    {
        $product = course_teacher::where('user_id',$id)
        ->where('year_id',session()->get('year_id'))
        ->where('course_id',session()->get('year_id'))
        ->delete();
        
        return $product;
    }
    /////เพิ่มอาจารย์ประจำหลักสูตร/////เพิ่มอาจารย์ประจำหลักสูตร/////เพิ่มอาจารย์ประจำหลักสูตร/////เพิ่มอาจารย์ประจำหลักสูตร/////เพิ่มอาจารย์ประจำหลักสูตร/////เพิ่มอาจารย์ประจำหลักสูตร

      /////เพิ่มอาจารย์ผู้สอน/////เพิ่มอาจารย์ประจำหลักสูตร/////เพิ่มอาจารย์ประจำหลักสูตร/////เพิ่มอาจารย์ประจำหลักสูตร/////เพิ่มอาจารย์ประจำหลักสูตร/////เพิ่มอาจารย์ประจำหลักสูตร
      public function getinstructor($id)
      {
          $course = instructor::where('category_id',$id)->get();
          return $course;
      }
      public function addinstructor(Request $request)
      {
          foreach($request->idall as $value){
              $data['user_id']=$value;
              $data['year_id']=session()->get('year_id');
              $data['course_id']=session()->get('usercourse');
              instructor::insert($data);
          }
          return $data;
      }
      public function deleteinstructor($id)
      {
          $product = instructor::where('user_id',$id)
          ->where('year_id',session()->get('year_id'))
          ->where('course_id',session()->get('year_id'))
          ->delete();
          
          return $product;
      }
      /////เพิ่มอาจารย์ประจำหลักสูตร/////เพิ่มอาจารย์ประจำหลักสูตร/////เพิ่มอาจารย์ประจำหลักสูตร/////เพิ่มอาจารย์ประจำหลักสูตร/////เพิ่มอาจารย์ประจำหลักสูตร/////เพิ่มอาจารย์ประจำหลักสูตร

      /////มอบหมายตัวบ่งชี้/////มอบหมายตัวบ่งชี้/////มอบหมายตัวบ่งชี้/////มอบหมายตัวบ่งชี้/////มอบหมายตัวบ่งชี้/////มอบหมายตัวบ่งชี้
      public function addindicator(Request $request)
      {
          $data=$request->all();
          $userid=$request->id;
          $deleterolepermission = user_permission::find($userid);
          if($deleterolepermission!=null){
              $deleterolepermission->delete();
          }
          
          if(isset($data['per'])){
          foreach($data['per'] as $value)
          {
            $item['user_id']=$userid;
            $querygroupid=indicator::select('category_id')->where('id',$value)->get();
            foreach($querygroupid as $row){
              $groupid=$row['category_id'];
            }
            $item['category_id']=$groupid;
            $item['Indicator_id']=$value;
            $item['year_id']=session()->get('year_id');
            user_permission::insert($item);
          }
          }
          $user=auth()->user();
          $user_group=$user->user_group_id;
        $category=category::all();
        $roleindicator=user_permission::leftjoin('indicator','user_permission.indicator_id','=','indicator.id')
        ->where('user_id',$user->id)
        ->get();
        foreach ($category as $key => $value){
            $value->indicator->first(); 
         }
        session()->put('category',$category);
        session()->put('roleindicator',$roleindicator);
        return $item;
      }
      public function getindicator($id)
      {
          $role=category::leftjoin('assessment_results','category.category_id','=','assessment_results.category_id')
          ->where('year_id',session()->get('year_id'))
          ->where('active',1)
          ->orderBy('assessment_results.category_id','asc')
          ->get();
          $permiss = user_permission::where('user_id',$id)
          ->where('year_id',session()->get('year_id'))
          ->get();
          $userid=$id;
          
          
          return view('dashboard.showaddindicator',compact('permiss','role','userid'));
      }
            /////มอบหมายตัวบ่งชี้/////มอบหมายตัวบ่งชี้/////มอบหมายตัวบ่งชี้/////มอบหมายตัวบ่งชี้/////มอบหมายตัวบ่งชี้/////มอบหมายตัวบ่งชี้


            /////profile/////profile/////profile/////profile/////profile/////profile
            public function getprofile($id)
            {
                $data=User::leftjoin('user_group','users.user_group_id','=','user_group.user_group_id')
                ->leftjoin('course','users.user_course','=','course.course_id')
                ->where('id',$id)
                ->get();
                
                return $data;
            }
            public function updateprofile(Request $request)
            {
                $user=auth()->user();
                $data=User::find($user->id);
                $data->user_fullname=$request->user_fullname;
                $data->email=$request->email;
                $data->academic_position=$request->academic_position;
                $data->save();
                return $data;
            }
            public function updatepassword(Request $request)
            {
                $user=auth()->user();
                $data=User::find($user->id);
                $data->password=Hash::make($request->password);
                $data->save();
                return $data;
            }
            /////profile/////profile/////profile/////profile/////profile/////profile


              /////เพิ่มอาจารย์ผู้สอน/////เพิ่มอาจารย์ประจำหลักสูตร/////เพิ่มอาจารย์ประจำหลักสูตร/////เพิ่มอาจารย์ประจำหลักสูตร/////เพิ่มอาจารย์ประจำหลักสูตร/////เพิ่มอาจารย์ประจำหลักสูตร
      public function getcourse_responsible_teacher($id)
      {
          $course = instructor::where('category_id',$id)->get();
          return $course;
      }
      public function addcourse_responsible_teacher(Request $request)
      {
          foreach($request->idall as $value){
              $data['user_id']=$value;
              $data['year_id']=session()->get('year_id');
              $data['course_id']=session()->get('usercourse');
              course_responsible_teacher::insert($data);
          }
          return $data;
      }
      public function deletecourse_responsible_teacher($id)
      {
          $product = course_responsible_teacher::where('user_id',$id)
          ->where('year_id',session()->get('year_id'))
          ->where('course_id',session()->get('usercourse'))
          ->delete();
          
          return $product;
      }
      /////เพิ่มอาจารย์ประจำหลักสูตร/////เพิ่มอาจารย์ประจำหลักสูตร/////เพิ่มอาจารย์ประจำหลักสูตร/////เพิ่มอาจารย์ประจำหลักสูตร/////เพิ่มอาจารย์ประจำหลักสูตร/////เพิ่มอาจารย์ประจำหลักสูตร


      public function addresultindicator1_1(Request $request)
      {
        $check=indicator1_1::where('year_id',session()->get('year_id'))
        ->where('course_id',session()->get('usercourse'))
        ->get();
        if(isset($check)){
            $data=indicator1_1::find($check[0]['id']);
             if($request->name=="result1"){
                $data['result1']=$request->value;
              }
              else if($request->name=="result2"){
                $data['result2']=$request->value;
              }
              else if($request->name=="result3"){
                $data['result3']=$request->value;
             }
              else if($request->name=="result4"){
                $data['result4']=$request->value;
             }
             $data->save();
        }
        else{
            $data=new indicator1_1;
            if($request->name=="result1"){
              $data['result1']=$request->value;
            }
            else if($request->name=="result2"){
              $data['result2']=$request->value;
            }
            else if($request->name=="result3"){
              $data['result3']=$request->value;
           }
            else if($request->name=="result4"){
              $data['result4']=$request->value;
           }
           $data['year_id']=session()->get('year_id');
           $data['course_id']=session()->get('usercourse');
           $data->save();
        }
          
         
          return $data;
      }
}
