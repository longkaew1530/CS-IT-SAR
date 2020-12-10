<?php

namespace App\Http\Controllers;
use App\User;
use App\PDCA;
use App\DocPDCA;
use App\Groupmenu;
use App\Course;
use App\Year;
use App\Tps;
use App\course_responsible_teacher;
use App\Educational_background;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        // $user=auth()->user();
        // $userrole=$user->role;
        // $role=Role::findByName($userrole);
        // dd($role);

        // $user = auth()->user();
        // $permissions = $user->getAllPermissions();
        // foreach($permissions as $value)
        // {
        //     dd($value->id);
        // }
        
       
        return view('dashboard/year');
    }
    public function index2()
    {
        
        $Getall=User::all();
        return view('dashboard.addmember',compact('Getall'));
    }
    public function index3()
    {
        
        return view('dashboard/index3');
    }
    public function index4()
    {
        
        return view('dashboard/permission');
    }
    public function index5()
    {
        
        return view('dashboard/Groupmenu');
    }
    public function index6()
    {
        
        return view('dashboard/Menu');
    }
    public function index7()
    {
        $Getall=PDCA::all();
        // $role=GroupMenu::all();
        
        
        //  foreach ($role as $key => $value){
        //     $value->menu->first(); 
        //  }
        return view('dashboard.permission');
        dd($role);
    }
    public function index8()
    {
        
        return view('dashboard/course');
    }
    public function index9()
    {
        
        return view('dashboard/board');
    }
    public function index10()
    {
      
        return view('dashboard/category');
    }
    public function index11()
    {
        
        return view('dashboard/Indicator');
    }
    public function index12()
    {
        
        return view('dashboard/usercategory');
    }
  
}
