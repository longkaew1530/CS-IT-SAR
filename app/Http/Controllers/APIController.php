<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\User;
use App\rolepermission;
use App\user_permission;
use App\Menu;
use App\Groupmenu;
use Response;
use Excel;
use App\defaulindicator;
use App\branch;
use App\instructor;
use App\course_detail;
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
        return redirect('/addmember');
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
        return $item;
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
        $data['g_name']=$request->group1;
        $data['g_icon']=$request->icon1;
        Groupmenu::insert($data);
        return $data;
    }
    public function updategroupmenu(Request $request)
    {
        $gid=$request->input('g_id');
        $data = Groupmenu::find($gid);
        $data->g_name = $request->input('g_name');
        $data->g_icon = $request->input('g_icon');
        $data->save();
        return $data;
    }
    public function deletegroupmenu($id)
    {   $check=rolepermission::where('g_id',$id)->get();
        $checkuser=Menu::where('g_id',$id)->get();
        if($check=="[]"&&$checkuser=="[]"){
            $product = Groupmenu::find($id);
             $product->delete();
            return $product;
        }
        else{
            return "ไม่สามารถลบข้อมูลได้เนื่องจากข้อมูลสัมพันธ์กัน";
        }

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
        return $data;
    }
    public function updatemenu(Request $request)
    {
        $gid=$request->input('m_id1');
        $data = Menu::find($gid);
        $data->m_name = $request->input('m_name1');
        $data->m_url = $request->input('m_url1');
        $data->g_id = $request->input('g_id1');
        $data->save();
        return $data;
    }
    public function deletemenu($id)
    {    $check=role_permission::where('m_id',$id)->get();
        if($check=="[]"){
            $product = Menu::find($id);
            $product->delete();
            return $product;
        }
        else{
            return "ไม่สามารถลบข้อมูลได้เนื่องจากข้อมูลสัมพันธ์กัน";
        }
        
        
        return redirect('/Menu');
    }
    /////menu/////menu/////menu/////menu/////menu/////menu

     /////หลักสูตร/////หลักสูตร/////หลักสูตร/////หลักสูตร/////หลักสูตร/////หลักสูตร
     public function getcourse($id)
     {
         $course = Course::where('course_id',$id)->get();
         return $course;
     }
     public function getcoursedetail($id)
     {
         $course = course_detail::where('course_id',$id)->get();
         $li = '';   
        foreach ($course as $key=>$enrollment) {
        $li .= '<tr id="row'.$key.'"><td width="110%"><input type="text" id="name1" name="name[]" placeholder="ชื่อ-สกุล" class="form-control name_list" value="'.$enrollment->name.'"/></td><td><button type="button" name="remove" id="'.$key.'" class="btn btn-danger ml-1 btn_remove2">X</button></td></tr>
                <tr id="row2'.$key.'"><td><textarea type="text" id="background1"  name="background[]" placeholder="วุฒิการศึกษา" class="form-control name_list">'.$enrollment->background.'</textarea><br></td></tr>';
        }
    
        return response()->json(['success'=> $li]);
     }
     public function addcourse(Request $request)
     {
         $getdata=$request->all();
         $data['course_name']=$request->course_name;
         $data['faculty_id']=$request->faculty_id ;
         $data['course_code']=$request->course_code;
         $data['update_course']=$request->update_course;
         $data['place']=$request->place;
         $data['initials']=$request->initials;
         Course::insert($data);
        //  $getid=Course::latest('course_id')->first();
        //  foreach($getdata['name'] as $key=>$value){
        //     $insert[$key]['course_id'] = $getid->course_id;
        //     $insert[$key]['name'] = $value;
        //     $insert[$key]['background'] = $getdata['background'][$key];
        //  }
        //  course_detail::insert($insert);
         return $data;
     }
     public function updatecourse(Request $request)
     {
        $getdata=$request->all();
         $course_id=$request->input('course_id');
         $data = Course::find($course_id);
         $data->course_name = $request->input('course_name');
         $data->faculty_id = $request->input('faculty_id');
         $data->course_code = $request->input('course_code');
         $data->update_course = $request->input('update_course');
         $data->place = $request->input('place');
         $data->initials = $request->input('initials');
         $data->save();
         $checkdata=course_detail::where('course_id',$data->course_id);
         if($checkdata!=""){
             $checkdata->delete();
         }
         foreach($getdata['name'] as $key=>$value){
             if($getdata['background'][$key]==""){
                 continue;
             }
            $insert[$key]['course_id'] = $data->course_id;
            $insert[$key]['name'] = $value;
            $insert[$key]['background'] = $getdata['background'][$key];
         }
         course_detail::insert($insert);
         return redirect('/course');
     }
     public function deletecourse($id)
     {
        $check=branch::where('course_id',$id)->get();
        $checkuser=User::where('user_course',$id)->get();
        if($check=="[]"&&$checkuser=="[]"){
            $product = Course::find($id);
             $product->delete();
            return $product;
        }
        else{
            return "ไม่สามารถลบข้อมูลได้เนื่องจากข้อมูลสัมพันธ์กัน";
        }

     }
     public function addcoursetname(Request $request)
     {
         $getdata=$request->all();
         foreach($getdata['name'] as $key=>$value){
            $insert[$key]['course_id'] = $request->course_id;
            $insert[$key]['name'] = $value;
            $insert[$key]['background'] = $getdata['background'][$key];
         }
         course_detail::insert($insert);
         return $insert;
     }
     public function updatecoursetname(Request $request)
     {
        $getdata=$request->all();
         $course_id=$request->input('course_id');
         $checkdata=course_detail::where('course_id',$request->course_id);
         if($checkdata!=""){
             $checkdata->delete();
         }
         foreach($getdata['name'] as $key=>$value){
             if($getdata['background'][$key]==""){
                 continue;
             }
            $insert[$key]['course_id'] = $request->course_id;
            $insert[$key]['name'] = $value;
            $insert[$key]['background'] = $getdata['background'][$key];
         }
         course_detail::insert($insert);
         return $insert;
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
         return $data;
     }
     public function updatefaculty(Request $request)
     {
         $course_id=$request->input('faculty_id');
         $data = Faculty::find($course_id);
         $data->faculty_name = $request->input('faculty_name');
         $data->save();
         return $data;
     }
     public function deletefaculty($id)
     {
        $check=Course::where('faculty_id',$id)->get();
        $checkuser=User::where('user_faculty',$id)->get();
        if($check=="[]"&&$checkuser=="[]"){
            $product = Faculty::find($id);
            $product->delete();
            return $product;
        }
        else{
            return "ไม่สามารถลบข้อมูลได้เนื่องจากข้อมูลสัมพันธ์กัน";
        }
         
         
         
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
         return $data;
     }
     public function updateusergroup(Request $request)
     {
         $course_id=$request->input('user_group_id');
         $data = groupuser::find($course_id);
         $data->user_group_name = $request->input('user_group_name');
         $data->save();
         return $data;
     }
     public function deleteusergroup($id)
     {
        $checkuser=User::where('user_group_id',$id)->get();
        if($checkuser=="[]"){
            $product = groupuser::find($id);
            $product->delete();
            return $product;
        }
        else{
            return "ไม่สามารถลบข้อมูลได้เนื่องจากข้อมูลสัมพันธ์กัน";
        }
         return redirect('/usergroup');
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
         $getbranch=branch::all();
         $categoryall=category::all();

            foreach($getbranch as $row2){
                 $checkdata2=Course::where('course_id',$row2['course_id'])->get();
                foreach($getall as $value){
                        $data=new indicator;
                        $data['Indicator_id']=$value['Indicator_id'];
                        $data['Indicator_name']=$value['Indicator_name'];
                        $data['category_id']=$value['category_id'];
                        $data['composition_id']=$value['composition_id'];
                        $data['url']=$value['url'];
                        $data['active']=1;
                        $data['year_id']=$queryyaer->year_id;
                        $data['course_id']=$checkdata2[0]['course_id'];
                        $data['branch_id']=$row2['branch_id'];
                        $data->save(); 
                }
            }

        foreach($getbranch as $row2){
            $checkdata2=Course::where('course_id',$row2['course_id'])->get();
            foreach($categoryall as $value){
                    $data1=new assessment_results;
                    $data1['category_id']=$value['category_id'];
                    $data1['active']=1;
                    $data1['year_id']=$queryyaer->year_id;
                    $data1['course_id']=$checkdata2[0]['course_id'];
                    $data1['branch_id']=$row2['branch_id'];
                    $data1->save();  
            }
         }
         return $data1;
     }
     /////ปีถัดไป/////ปีถัดไป/////ปีถัดไป/////ปีถัดไป/////ปีถัดไป/////ปีถัดไป

     /////ปีก่อนหน้า/////ปีก่อนหน้า/////ปีก่อนหน้า/////ปีก่อนหน้า/////ปีก่อนหน้า/////ปีก่อนหน้า
     public function backyear(Request $request)
     {
        $queryyaer= new Year;
        $queryyaer->year_name=$request->year;
        $queryyaer->active=1;
        $queryyaer->save();
        $getall=defaulindicator::all();
        $getcourse=Course::all();
        $getbranch=branch::all();
        $categoryall=category::all();
        if($getbranch!="[]")
        {
        foreach($getbranch as $row2){
            $checkdata2=$getcourse->where('course_id',$row2['course_id']);
           foreach($getall as $value){
                   $data=new indicator;
                   $data['Indicator_id']=$value['Indicator_id'];
                   $data['Indicator_name']=$value['Indicator_name'];
                   $data['category_id']=$value['category_id'];
                   $data['composition_id']=$value['composition_id'];
                   $data['url']=$value['url'];
                   $data['active']=1;
                   $data['year_id']=$queryyaer->year_id;
                   $data['course_id']=$checkdata2[0]['course_id'];
                   $data['branch_id']=$row2['branch_id'];
                   $data->save(); 
           }
       }
    }
    if($getbranch!="[]")
    {
   foreach($getbranch as $row2){
           $checkdata2=$getcourse->where('course_id',$row2['course_id']);
       foreach($categoryall as $value){
               $data1=new assessment_results;
               $data1['category_id']=$value['category_id'];
               $data1['active']=1;
               $data1['year_id']=$queryyaer->year_id;
               $data1['course_id']=$checkdata2[0]['course_id'];
               $data1['branch_id']=$row2['branch_id'];
               $data1->save();  
       }
    }
    return $data1;
}
    return $queryyaer;
        
     }
     public function backyear2(Request $request)
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
         if($request->image!=""){

        
        request()->validate([
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
       ]);  }
       $data = ['user_fullname' => $request->user_fullname,
         'email' => $request->email,
          'username' => $request->username,
          'password' => Hash::make($request->password),
          'user_faculty' => $request->user_faculty,
          'user_branch' => $request->branch,
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
        else{

        }
        
        User::insert($data);  
    
        return $data;
     }
     public function uploadimage(Request $request)
     {
        $user=auth()->user();
         if($request->image!=""){
        request()->validate([
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
       ]); }
        if ($files = $request->file('image')) {
            
           //delete old file
           \File::delete('public/user/'.$request->hidden_image);
         
           //insert new file
           $destinationPath = 'public/user/'; // upload path
           $profileImage = date('YmdHis') . "." . $files->getClientOriginalExtension();
           $files->move($destinationPath, $profileImage);
           $data=User::find($user->id);
           $data->image= "$profileImage";
           $data->save();
        }
        else{
            
        }
        
    
        return $data;
     }
     public function updateuser(Request $request)
     {
        $user_id=$request->input('userid');
        $data = User::find($user_id);
        if($files = $request->file('image')){

        
         request()->validate([
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
       ]); 
    }
       $data->user_fullname = $request->input('user_fullname');
       $data->email = $request->input('email');
       $data->username = $request->input('username');
       if($request->input('password')){
        $data->password = Hash::make($request->input('password'));
       }
       $data->user_faculty = $request->input('user_faculty');
       $data->user_course = $request->input('user_course');
       $data->user_branch = $request->input('branch');
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
        return $data; 
     }
     public function deleteuser($id)
     {
         $checkuser=course_teacher::where('user_id',$id)->get();
         $checkuser2=course_responsible_teacher::where('user_id',$id)->get();
         $checkuser3=instructor::where('user_id',$id)->get();
        if($checkuser=="[]"&&$checkuser2=="[]"&&$checkuser3=="[]"){
            $product = User::find($id);
            $product->delete();
            return $product;
        }
        else{
            return "ไม่สามารถลบข้อมูลได้เนื่องจากข้อมูลสัมพันธ์กัน";
        } 
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
          $data['icon']="fa fa-list-ul";
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
        $check=assessment_results::where('category_id',$id)->get();
        $checkuser=indicator::where('category_id',$id)->get();
        if($checkuser=="[]"&&$check=="[]"){
            $product = category::find($id);
            $product->delete();
            return $product;
        }
        else{
            return "ไม่สามารถลบข้อมูลได้เนื่องจากข้อมูลสัมพันธ์กัน";
        }
      }
      /////หมวด/////หมวด/////หมวด/////หมวด/////หมวด/////หมวด

      /////สาขา/////สาขา/////สาขา/////สาขา/////สาขา/////สาขา
      public function getbranch($id)
      {
          $course = branch::where('branch_id',$id)->get();
          return $course;
      }
      public function addbranch(Request $request)
      {
          $data=new branch;
          $data->name=$request->name;
          $data->course_id=$request->course_id;
          $data->save();
          $getcourse=Course::where('course_id',$request->course_id)
          ->get();
          $getall=defaulindicator::all();
          $categoryall=Category::all();
          $getyear=Year::all();
            foreach($getyear as $row2){
                foreach($getall as $value){
                        $data2=new indicator;
                        $data2['Indicator_id']=$value['Indicator_id'];
                        $data2['Indicator_name']=$value['Indicator_name'];
                        $data2['category_id']=$value['category_id'];
                        $data2['composition_id']=$value['composition_id'];
                        $data2['url']=$value['url'];
                        $data2['active']=1;
                        $data2['year_id']=$row2['year_id'];
                        $data2['course_id']=$getcourse[0]['course_id'];
                        $data2['branch_id']=$data->branch_id;
                        $data2->save(); 
                } 
            }

        foreach($getyear as $row2){
            foreach($categoryall as $value){
                    $data1=new assessment_results;
                    $data1['category_id']=$value['category_id'];
                    $data1['active']=1;
                    $data1['year_id']=$row2['year_id'];
                    $data1['course_id']=$getcourse[0]['course_id'];
                    $data1['branch_id']=$data->branch_id;
                    $data1->save();  
            }
         }
    
          return $data;
      }
      public function updatebranch(Request $request)
      {
          $data = branch::find($request->id);
          $data->name=$request->name;
          $data->course_id=$request->course_id;
          $data->save();
          return $data;
      }
      public function deletebranch($id)
      {
        $checkuser=User::where('user_branch',$id)->get();
        if($checkuser=="[]"){
            $product = branch::find($id);
            $product->delete();
            return $product;
        }
        else{
            return "ไม่สามารถลบข้อมูลได้เนื่องจากข้อมูลสัมพันธ์กัน";
        }
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
            $data['branch_id']=session()->get('branch_id');
            course_teacher::insert($data);
        }
        return $data;
    }
    public function deletetccourse($id)
    {
        $product = course_teacher::where('user_id',$id)
        ->where('year_id',session()->get('year_id'))
        ->where('course_id',session()->get('usercourse'))
        ->where('branch_id',session()->get('branch_id'))
        ->delete();
        
        return true;
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
              $data['branch_id']=session()->get('branch_id');
              instructor::insert($data);
          }
          return $data;
      }
      public function deleteinstructor($id)
      {
          $product = instructor::where('user_id',$id)
          ->where('year_id',session()->get('year_id'))
          ->where('course_id',session()->get('usercourse'))
          ->where('branch_id',session()->get('branch_id'))
          ->delete();
          
          return true;
      }
      /////เพิ่มอาจารย์ประจำหลักสูตร/////เพิ่มอาจารย์ประจำหลักสูตร/////เพิ่มอาจารย์ประจำหลักสูตร/////เพิ่มอาจารย์ประจำหลักสูตร/////เพิ่มอาจารย์ประจำหลักสูตร/////เพิ่มอาจารย์ประจำหลักสูตร

      /////มอบหมายตัวบ่งชี้/////มอบหมายตัวบ่งชี้/////มอบหมายตัวบ่งชี้/////มอบหมายตัวบ่งชี้/////มอบหมายตัวบ่งชี้/////มอบหมายตัวบ่งชี้
      public function addindicator(Request $request)
      {
          $data=$request->all();
          $userid=$request->id;
          $deleterolepermission = user_permission::where('year_id',session()->get('year_id'))
          ->where('user_id',$userid);
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
        ->where('user_permission.user_id',$user->id)
        ->where('user_permission.year_id',session()->get('year_id'))
        ->where('indicator.year_id',session()->get('year_id'))
        ->get();
        foreach ($category as $key => $value){
            $value->indicator->first(); 
         }
        session()->put('category',$category);
        session()->put('roleindicator',$roleindicator);
        if(isset($item)){
            return $item;
        }
        else{
            return $deleterolepermission;
        }
      }
      public function getindicator($id)
      {
          $role=category::leftjoin('assessment_results','category.category_id','=','assessment_results.category_id')
          ->where('year_id',session()->get('year_id'))
          ->where('course_id',session()->get('usercourse'))
          ->where('branch_id',session()->get('branch_id'))
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
              $data['branch_id']=session()->get('branch_id');
              course_responsible_teacher::insert($data);
          }
          return $data;
      }
      public function deletecourse_responsible_teacher($id)
      {
          $product = course_responsible_teacher::where('user_id',$id)
          ->where('year_id',session()->get('year_id'))
          ->where('course_id',session()->get('usercourse'))
          ->where('branch_id',session()->get('branch_id'));

          $product->delete();
          return true;
      }
      /////เพิ่มอาจารย์ประจำหลักสูตร/////เพิ่มอาจารย์ประจำหลักสูตร/////เพิ่มอาจารย์ประจำหลักสูตร/////เพิ่มอาจารย์ประจำหลักสูตร/////เพิ่มอาจารย์ประจำหลักสูตร/////เพิ่มอาจารย์ประจำหลักสูตร


      public function addresultindicator1_1(Request $request)
      {
        $check=indicator1_1::where('year_id',session()->get('year_id'))
        ->where('course_id',session()->get('usercourse'))
        ->where('branch_id',session()->get('branch_id'))
        ->get();
        if($check!="[]"){
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
             else if($request->name=="result5"){
                $data['result5']=$request->value;
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
           else if($request->name=="result5"){
            $data['result5']=$request->value;

         }
           $data['year_id']=session()->get('year_id');
           $data['course_id']=session()->get('usercourse');
           $data['branch_id']=session()->get('branch_id');
           $data->save();
        }
          
         
          return $data;
      }
      public function getcourse_username($id)
      {
          $course = course::where('course_id',$id)->get();
          $getuser=User::where('user_course',$id)->get();
          $username="";
          $getcount=0;
          $getcount=User::where('user_course',$id)->orderBy('id', 'DESC')->first();
          $getusername="a0";
          if($getcount!=""){
            $getusername=$getcount['username'];
          }
          
          $filteredNumbers = array_filter(preg_split("/\D+/",$getusername));
          $firstOccurence = reset($filteredNumbers);
          $conventusername=strval($firstOccurence+1);
          $username=$course[0]['initials'].$conventusername;
          return $username;
      }
      public function getcourse_username2()
      {
          $course = course::first();
        //   $getuser=User::where('user_course',$id)->get();
          $username="";
          $getcount=0;
          $getcount=User::where('user_course',$course['course_id'])->orderBy('id', 'DESC')->first();
          $getusername="a0";
          if($getcount!=""){
            $getusername=$getcount['username'];
          }
          
          $filteredNumbers = array_filter(preg_split("/\D+/",$getusername));
          $firstOccurence = reset($filteredNumbers);
          $conventusername=strval($firstOccurence+1);
          $username=$course['initials'].$conventusername;
          return $username;
      }
      public function updatesessionyear($id)
      {
        session()->put('branch_id',$id);  
        session()->put('checkbranch',1);  
        return session()->get('branch_id');
      }
      public function updatesessionyear2($id)
      {
        $get=indicator::where('id',$id)->get();
        session()->put('dindicator',$get[0]['category_id']);  
        session()->put('dindicator2',$get[0]['id']); 
        session()->put('putput',1); 
        return session()->get('dindicator');
      }
      public function updatesessionyear3($id)
      {
        $get=Menu::where('m_id',$id)->get();
        session()->put('m_menu1',$get[0]['g_id']);  
        session()->put('m_menu2',$get[0]['m_id']); 
        session()->put('putput',0); 
        return session()->get('dindicator');
      }
      public function updatebackyear($id)
      {
        session()->put('year_id',$id);  
   
        return session()->get('year_id');
      }
      public function getDownload(){

        Excel::store(new InvoicesExport(2018), 'invoices.xlsx');
     }
}
