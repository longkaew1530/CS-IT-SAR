
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
        @if(Auth::user()->image)
              <img src="{{asset('public/user/' . Auth::user()->image)}}" class="img-circle" alt="User Image">
              @else
              <img src="{{url('/')}}/images1/profile.png" class="img-circle" alt="User Image">
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
      
        <li class="header">{{session()->get('getyearBegin')}} ถึง {{session()->get('getyearEnd')}}</li>
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
        <!-- <li ><a href="/"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li> -->
        <?php $data2=session()->get('groupmenu')->where('g_id','!=',30); ?> 
        @foreach($data2  as $value)
        @foreach(session()->get('roleper')  as $value1)
        @if($value1['g_id']==$value['g_id'])
        @if(session()->get('putput')==0)
        @if(session()->get('m_menu1')==$value['g_id'])
        <li class="active treeview ">
        @else
        <li class="treeview ">
        @endif
        @else
        <li class="treeview ">
        @endif

          <a href="">
            <i class="{{$value['g_icon']}}"></i><span>{{$value['g_name']}}</span>
            
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          @break
         @endif
         @endforeach
          <ul class="treeview-menu" id="item_id">
            @foreach($value->menu as $row)
              @foreach(session()->get('roleper')  as $value)
              @if($value['m_id']==$row['m_id'])
               <li id="{{$row['m_id']}}" class="{{ (session()->get('m_menu2')==$row['m_id']) ? 'active' : ''}}"><a  href="{{$row['m_url']}}" ><i class="fa fa-circle-o text-red"></i>{!!$row['m_name']!!}</a></li>
              @endif
              @endforeach
            @endforeach
          </ul>
        @endforeach

        
        @if(session()->get('roleindicator')!="")
        @foreach(session()->get('category')  as $value)
        @foreach(session()->get('roleindicator')  as $value1)
        @if($value1['category_id']==$value['category_id'])
          @if(session()->get('putput')==1)
          @if(session()->get('dindicator')==$value['category_id'])
          <li class="active treeview ">
          @else
          <li class="treeview ">
          @endif
          @else
          <li class="treeview ">
          @endif
          <a href="">
            <i class="{{$value['icon']}}"></i><span>@if($value['category_id']!=8)หมวดที่ {{$value['category_id']}}@else {{$value['category_name']}} @endif</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          @break
         @endif
         @endforeach
          <ul class="treeview-menu"  id="myid">
            @foreach($value->indicator as $row)
            @if($row['url']=="/category3/pdca"||$row['url']=="/addimpactfactor"||$row['url']=="/addassessment_summary"||$row['url']=="/addindicator4-3")
                <li id="{{$row['id']}}"  class="{{ (session()->get('dindicator2')==$row['id']) ? 'active' : '' }}"><a   href="{{$row['url']}}/{{$row['id']}}" ><i class="fa fa-circle-o text-red"></i>@if($row['Indicator_id']!="")ตัวบ่งชี้ {!!$row['Indicator_id']!!}@else{!!$row['Indicator_name']!!}@endif</a></li>
                @else
                <li id="{{$row['id']}}"  class="{{ (session()->get('dindicator2')==$row['id']) ? 'active' : ''}}"><a  href="{{$row['url']}}" ><i class="fa fa-circle-o text-red"></i>@if($row['Indicator_id']!="")ตัวบ่งชี้ {!!$row['Indicator_id']!!}@else{!!$row['Indicator_name']!!}@endif</a></li>
                @endif
               
              
            @endforeach
          </ul>
          
        @endforeach
        @endif

        <?php $data3=session()->get('groupmenu')->where('g_id',30); ?>
        @foreach($data3  as $value)
        @foreach(session()->get('roleper')  as $value1)
        @if($value1['g_id']==$value['g_id'])
        @if(session()->get('putput')==0)
        @if(session()->get('m_menu1')==$value['g_id'])
        <li class="active treeview ">
        @else
        <li class="treeview ">
        @endif
        @else
        <li class="treeview ">
        @endif
        
          <a href="">
            <i class="{{$value['g_icon']}}"></i><span>{{$value['g_name']}}</span>
            
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          @break
         @endif
         @endforeach
          <ul class="treeview-menu" id="myid2">
            @foreach($value->menu as $row)
              @foreach(session()->get('roleper')  as $value)
              @if($value['m_id']==$row['m_id'])
               <li id="{{$row['m_id']}}" class="{{ (session()->get('m_menu2')==$row['m_id']) ? 'active' : ''}}"><a  href="{{$row['m_url']}}" ><i class="fa fa-circle-o text-red"></i>{!!$row['m_name']!!}</a></li>
              @endif
              @endforeach
            @endforeach
          </ul>
     
        @endforeach


       
          
       <!-- <li class="active treeview menu-open">
          <a href="">
            <i class=""></i><span>หมวดที่4</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="active"><a href="/addcourse_results"><i class="fa fa-circle-o text-red"></i>สรุปผลรายวิชาที่เปิดสอน</a></li>
            <li class="active"><a href="/addindicator5-4"><i class="fa fa-circle-o text-red"></i>ผลการดำเนินงานตามกรอบมาตรฐานคุณวุติ</a></li>
            <li class="active"><a href="/addacademic_performance"><i class="fa fa-circle-o text-red"></i>การวิเคราะห์รายวิชาที่มีผลการเรียนที่ไม่ปกติ</a></li>
            <li class="active"><a href="/addnot_offered"><i class="fa fa-circle-o text-red"></i>รายวิชาที่ไม่ได้เปิดสอนในปีการศึกษา</a></li>
            <li class="active"><a href="/addincomplete_content"><i class="fa fa-circle-o text-red"></i>รายวิชาที่สอนเนื้อหาไม่ครบในปีการศึกษา</a></li>
            <li class="active"><a href="/addeffectiveness"><i class="fa fa-circle-o text-red"></i>ประสิทธิผลของกลยุทธ์การสอน</a></li>
            <li class="active"><a href="/addteacher_orientation"><i class="fa fa-circle-o text-red"></i>การปฐมนิเทศอาจารย์ใหม่</a></li>
            <li class="active"><a href="/addactivity"><i class="fa fa-circle-o text-red"></i>กิจกรรมการพัฒนาวิชาชีพของอาจารย์</a></li>
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
            <li class="active"><a href="/addcourse_manage"><i class="fa fa-circle-o text-red"></i>การบริหารหลักสูตร</a></li>
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
            <li class="active"><a href="/addcomment_course"><i class="fa fa-circle-o text-red"></i>ข้อคิดเห็น และข้อเสนอแนะ</a></li>
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
            <li class="active"><a href="/addstrength"><i class="fa fa-circle-o text-red"></i>ความก้าวหน้าของการดำเนินงานตามแผนที่เสนอในรายงานของปีที่ผ่านมา</a></li>
            <li class="active"><a href="/adddevelopment_proposal"><i class="fa fa-circle-o text-red"></i>ข้อเสนอในการพัฒนาหลักสูตร</a></li>
            <li class="active"><a href="/addnewstrength"><i class="fa fa-circle-o text-red"></i>แผนปฏิบัติการใหม่</a></li>
          </ul>
        </li>

        <li class="active treeview menu-open">
          <a href="">
            <i class=""></i><span>รายงาน</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="active"><a href="/overview"><i class="fa fa-circle-o text-red"></i>ความคืบหน้าในภาพรวม</a></li>
            <li class="active"><a href="/instructor"><i class="fa fa-circle-o text-red"></i>รายงานอาจารย์ผู้สอน</a></li>
            <li class="active"><a href="/performance_summary"><i class="fa fa-circle-o text-red"></i>รายงานสรุปผลการดำเนินงาน</a></li>
          </ul>
        </li> -->

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
<script>
        $("#myid li").click(function() {
    var token = $('meta[name="csrf-token"]').attr('content');
  
     var idb=this.id;
        console.log(this.id);
        $.ajax({
           type:'GET',
           url:'/updatesessionyear2/'+idb,
           data: {
          _token : token
        },
           success:function(data){
              
           }
        });

    
});
$("#myid2 li").click(function() {
  var token = $('meta[name="csrf-token"]').attr('content');
  
  var idb=this.id;
     console.log(this.id);
     $.ajax({
        type:'GET',
        url:'/updatesessionyear3/'+idb,
        data: {
       _token : token
     },
        success:function(data){
         
        }
     });

    
});
$("#item_id li").click(function() {
    var token = $('meta[name="csrf-token"]').attr('content');
  
     var idb=this.id;
        console.log(this.id);
        $.ajax({
           type:'GET',
           url:'/updatesessionyear3/'+idb,
           data: {
          _token : token
        },
           success:function(data){
              
           }
        });

    
});
</script>