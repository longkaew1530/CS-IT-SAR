@extends('layout.admid_layout')

@section('content')
<div class="box box-warning marginl">
<div class="box-header">
            <div class="box-body">
            <b><h3 class="text-center">สรุปการประเมินหลักสูตร</h3></b>
            <br><br>
            @if($assessmentsummary!="[]")
            @if($checkedit!="")<a href="/getassessment_summary/การประเมินจากผู้ที่สำเร็จการศึกษา" class="btn btn-warning fr"><i class='fa fas fa-edit'></i>แก้ไขข้อมูล</a>@endif
            @else
            @if($checkedit!="")<a href="/addassessment_summary/การประเมินจากผู้ที่สำเร็จการศึกษา" class="btn btn-success fr ml-1"><i class='fa fa-plus'></i> เพิ่มข้อมูล</a>@endif
            @endif
            <b><h4>การประเมินจากผู้ที่สำเร็จการศึกษา (รายงานตามปีที่สำรวจ)</h4></b>
              <table class="table table-bordered">
                <tbody><tr>
                  <th width="30%" class="text-center" >ข้อวิพากษ์ที่สำคัญจากผลการประเมิน</th>
                  <th width="30%" class="text-center">ข้อคิดเห็นของคณาจารย์ต่อผลการประเมิน</th>
                </tr>
                <tr></tr>
                @if($assessmentsummary!="[]")
               @foreach($assessmentsummary as $row)
              <tr>
              
                  <td >{!!$row['evaluation_results']!!}</td>
                  <td >{!!$row['comment_faculty']!!}</td>
              </tr>
              <tr>
              <td colspan="2"><b>ข้อเสนอการเปลี่ยนแปลงในหลักสูตรจากผลการประเมิน</b><br>{!!$row['change_proposal']!!}</td>
              </tr>
              @endforeach
              @else
              <tr>
                  <td >-</td>
                  <td >-</td>
              </tr>
              <tr>
              <td colspan="2"><b>ข้อเสนอการเปลี่ยนแปลงในหลักสูตรจากผลการประเมิน</b><br>-</td>
              </tr>
              @endif
              </tbody></table>


              <br><br>
              @if($assessmentsummary2!="[]")
              @if($checkedit!="")<a href="/getassessment_summary/การประเมินจากผู้ที่มีส่วนเกี่ยวข้อง" class="btn btn-warning fr"><i class='fa fas fa-edit'></i>แก้ไขข้อมูล</a>@endif
            @else
            @if($checkedit!="")<a href="/addassessment_summary/การประเมินจากผู้ที่มีส่วนเกี่ยวข้อง" class="btn btn-success fr ml-1"><i class='fa fa-plus'></i> เพิ่มข้อมูล</a>@endif
            @endif
            <b><h4>การประเมินจากผู้ที่มีส่วนเกี่ยวข้อง (ผู้ใช้บัณฑิต)</h4></b>
              <table class="table table-bordered">
                <tbody><tr>
                  <th width="30%" class="text-center" >ข้อวิพากษ์ที่สำคัญจากผลการประเมิน</th>
                  <th width="30%" class="text-center">ข้อคิดเห็นของคณาจารย์ต่อผลการประเมิน</th>
                </tr>
                <tr></tr>
               @if($assessmentsummary2!="[]")
               @foreach($assessmentsummary2 as $row)
              <tr>
              
                  <td >{!!$row['evaluation_results']!!}</td>
                  <td >{!!$row['comment_faculty']!!}</td>
              </tr>
              <tr>
              <td colspan="2"><b>ข้อเสนอการเปลี่ยนแปลงในหลักสูตรจากผลการประเมิน</b><br>{!!$row['change_proposal']!!}</td>
              </tr>
              @endforeach
              @else
              <tr>
                  <td >-</td>
                  <td >-</td>
              </tr>
              <tr>
              <td colspan="2"><b>ข้อเสนอการเปลี่ยนแปลงในหลักสูตรจากผลการประเมิน</b><br>-</td>
              </tr>
              @endif
              </tbody></table>
</div></div>
              @endsection
