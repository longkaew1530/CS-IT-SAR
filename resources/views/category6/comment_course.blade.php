@extends('layout.admid_layout')

@section('content')
<div class="box box-warning marginl">
<div class="box-header">
            <div class="box-body">
           <b><h4>ข้อคิดเห็น และข้อเสนอแนะเกี่ยวกับคุณภาพหลักสูตรจากผู้ประเมิน</h4></b>
              <table class="table table-bordered" >
                <tbody><tr>
                  <th width="30%" class="text-center" >ข้อคิดเห็นหรือสาระจากผู้ประเมิน</th>
                  <th width="30%" class="text-center">ความเห็นของผู้รับผิดชอบหลักสูตร</th>
                  <th width="30%" class="text-center" >การนำไปดำเนินการวางแผนหรือปรับปรุงหลักสูตร</th>
                </tr>
                <tr></tr>
                @foreach($coursemanage as $value)
              <tr>
                  <td >{{$value['comment_assessor']}}</td>
                  <td >{{$value['comment_course_responsible_person']}}</td>
                  <td >{{$value['update_course']}}</td>
              </tr>
                @endforeach
              </tbody></table>
</div></div>
              @endsection
