
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
        @if(Auth::user()->image)
              <img src="{{asset('public/user/' . Auth::user()->image)}}" class="img-circle" alt="User Image">
              @else
              <img src="{{url('/')}}/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
              @endif
        </div>
        <div class="pull-left info">
              @guest
              <p>Alax</p>
              @else
              <p>{{ Auth::user()->user_fullname }}</p>
              @endguest
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        <!-- <li class="active treeview menu-open">
          <a href="">
            <i class=""></i><span>หมวดที่1</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
          <li class="active"><a href="/category/category1"><i class="fa fa-circle-o text-red"></i>หมวดที่1</a></li>
            <li class="active"><a href="/category/indicator1-1"><i class="fa fa-circle-o text-red"></i>ตัวบ่งชี้ที่ 1.1</a></li>
            <li class="active"><a href="/dashboard/addmember"><i class="fa fa-circle-o text-red"></i>เพิ่มสมาชิก</a></li>
          </ul>
        </li>
        <li class="active treeview menu-open">
          <a href="">
            <i class=""></i><span>หมวดที่2</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="active"><a href="/category/indicator4-1/4.1"><i class="fa fa-circle-o text-red"></i>ตัวบ่งชี้ที่ 4.1</a></li>
            <li class="active"><a href="/category/indicator4-2/4.2"><i class="fa fa-circle-o text-red"></i>ตัวบ่งชี้ที่ 4.2</a></li>
            <li class="active"><a href="/category/indicator4-3/4.3"><i class="fa fa-circle-o text-red"></i>ตัวบ่งชี้ที่ 4.3</a></li>
          </ul>
        </li>
        <li class="active treeview menu-open">
          <a href="">
            <i class=""></i><span>หมวดที่3</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="active"><a href="/category/indicator4-1/4.1"><i class="fa fa-circle-o text-red"></i>ข้อมูลนักศึกษา</a></li>
            <li class="active"><a href="/category3/graduatesqty"><i class="fa fa-circle-o text-red"></i>จำนวนผู้สำเร็จการศึกษา</a></li>
            <li class="active"><a href="/category3/Impactfactors"><i class="fa fa-circle-o text-red"></i>ปัจจัยที่มีผลกระทบต่อจำนวนนักศึกษา</a></li>
            <li class="active"><a href="/category3/Impactgraduation"><i class="fa fa-circle-o text-red"></i>ปัจจัยที่มีผลกระทบต่อการสำเร็จการศึกษา</a></li>
            <li class="active"><a href="/category3/indicator2-1"><i class="fa fa-circle-o text-red"></i>คุณภาพบัณฑิตตามกรอบมาตรฐานคุณวุฒิระดับอุดมศึกษาแห่งชาติ</a></li>
            <li class="active"><a href="/category3/assessment/2.1"><i class="fa fa-circle-o text-red"></i>ผลการประเมินตนเอง</a></li>
            <li class="active"><a href="/category3/indicator2-2"><i class="fa fa-circle-o text-red"></i>ผลการดำเนินงาน</a></li>
            <li class="active"><a href="/category3/assessment/2.2"><i class="fa fa-circle-o text-red"></i>ผลการประเมินตนเอง</a></li>
            <li class="active"><a href="/category3/pdca/3.1"><i class="fa fa-circle-o text-red"></i>การรับนักศึกษา</a></li>
            <li class="active"><a href="/category3/assessment/3.1"><i class="fa fa-circle-o text-red"></i>ผลการประเมินตนเอง</a></li>
            <li class="active"><a href="/category3/pdca/3.2"><i class="fa fa-circle-o text-red"></i>การส่งเสริมและพัฒนานักศึกษา</a></li>
            <li class="active"><a href="/category3/assessment/3.2"><i class="fa fa-circle-o text-red"></i>ผลการประเมินตนเอง</a></li>
            <li class="active"><a href="/category3/performance"><i class="fa fa-circle-o text-red"></i>ผลการดำเนินงาน</a></li>
            <li class="active"><a href="/category3/assessment/3.3"><i class="fa fa-circle-o text-red"></i>ผลการประเมินตนเอง3.3</a></li>
          </ul>
        </li>
        <li class="active treeview menu-open">
          <a href="">
            <i class=""></i><span>หมวดที่4</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="active"><a href="/category4/course_summary"><i class="fa fa-circle-o text-red"></i>สรุปผลรายวิชาที่เปิดสอน</a></li>
            <li class="active"><a href="/category4/notcourse_summary"><i class="fa fa-circle-o text-red"></i>รายวิชาที่ไม่ได้เปิดสอน</a></li>
            <li class="active"><a href="/category3/assessment/5.1"><i class="fa fa-circle-o text-red"></i>ผลการประเมินตนเอง5.1</a></li>
            <li class="active"><a href="/category3/pdca/5.2"><i class="fa fa-circle-o text-red"></i>การวางระบบผู้สอน 5.2 pdca</a></li>
            <li class="active"><a href="/category3/assessment/5.2"><i class="fa fa-circle-o text-red"></i>ผลการประเมินตนเอง5.2</a></li>
            <li class="active"><a href="/category3/assessment/5.3"><i class="fa fa-circle-o text-red"></i>ผลการประเมินตนเอง5.3</a></li>
            <li class="active"><a href="/category4/indicator5_4"><i class="fa fa-circle-o text-red"></i>ตัวบ่งชี้ที่ 5.4</a></li>
            <li class="active"><a href="/category3/assessment/5.4"><i class="fa fa-circle-o text-red"></i>ผลการประเมินตนเอง5.4</a></li>
            <li class="active"><a href="/category4/teachingquality"><i class="fa fa-circle-o text-red"></i>คุณภาพการสอน</a></li>
            <li class="active"><a href="/category4/effectiveness"><i class="fa fa-circle-o text-red"></i>ประสิทธิผลของกลยุทธ์การสอน</a></li>
            <li class="active"><a href="/category4/newteacher"><i class="fa fa-circle-o text-red"></i>การปฐมนิเทศอาจารย์ใหม่</a></li>
            <li class="active"><a href="/category4/activity"><i class="fa fa-circle-o text-red"></i>กิจกรรมการพัฒนาวิชาชีพ</a></li>
          </ul>
        </li>
        <li class="active treeview menu-open">
          <a href="">
            <i class=""></i><span>หมวดที่5</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="active"><a href="/category5/course_administration"><i class="fa fa-circle-o text-red"></i>การบริหารหลักสูตร</a></li>
            <li class="active"><a href="/category3/pdca/6.1"><i class="fa fa-circle-o text-red"></i>สิ่งสนับสนุนการเรียนรู้</a></li>
            <li class="active"><a href="/category3/assessment/6.1"><i class="fa fa-circle-o text-red"></i>ผลการประเมินตนเอง6.1</a></li>
          </ul>
        </li>
        <li class="active treeview menu-open">
          <a href="">
            <i class=""></i><span>หมวดที่6</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="active"><a href="/category6/comment_course"><i class="fa fa-circle-o text-red"></i>ข้อคิดเห็น และข้อเสนอ</a></li>
            <li class="active"><a href="/category6/assessment_summary"><i class="fa fa-circle-o text-red"></i>สรุปการประเมินหลักสูตร</a></li>
          </ul>
        </li>
        <li class="active treeview menu-open">
          <a href="">
            <i class=""></i><span>หมวดที่7</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="active"><a href="/category7/strength"><i class="fa fa-circle-o text-red"></i>หมวดที่7</a></li>
          </ul>
        </li> -->
        <li><a href="/"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
        @foreach(session()->get('groupmenu')  as $value)
        <li class="active treeview menu-open">
        @foreach(session()->get('roleper')  as $value1)
        @if($value1['g_id']==$value['g_id'])
          <a href="">
            <i class="{{$value['g_icon']}}"></i><span>{{$value['g_name']}}</span>
            
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          @break
         @endif
         @endforeach
          <ul class="treeview-menu" >
            @foreach($value->menu as $row)
              @foreach(session()->get('roleper')  as $value)
              @if($value['m_id']==$row['m_id'])
                @if($row['m_url']=="/pdca")
                <li  class="active"><a   href="{{$row['m_url']}}/{{$row['m_id']}}" ><i class="fa fa-circle-o text-red"></i>{{$row['m_name']}}</a></li>
                @else
               <li  class="active"><a  href="{{$row['m_url']}}" ><i class="fa fa-circle-o text-red"></i>{{$row['m_name']}}</a></li>
                @endif
              @endif
              @endforeach
            @endforeach
          </ul>
         
        @endforeach
        <li class="active treeview menu-open">
          <a href="">
            <i class=""></i><span>หมวดที่2{{request()->segment(2)}}</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="active"><a href="/pdca"><i class="fa fa-circle-o text-red"></i>การรับและแต่งตั้งอาจารย์ผู้รับผิดชอบหลักสูตร</a></li>
            <li class="active"><a  href="/addindicator4-3"><i class="fa fa-circle-o text-red"></i>ตัวบ่งชี้ที่4.3</a></li>
          </ul>
        </li>
          
        </li>
        <li class="header">LABELS</li>
        <li><a href="{{ route('logout') }}"  onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
        <i class="fa fa-sign-out"></i> <span>ออกจากระบบ</span></a></li>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>