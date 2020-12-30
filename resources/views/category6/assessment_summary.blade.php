@extends('layout.admid_layout')

@section('content')
<div class="box box-warning marginl">
<div class="box-header">
            <div class="box-body">
            <b><h4 class="text-center">สรุปการประเมินหลักสูตร</h4></b>
            <br><br><b><h4>การประเมินจากผู้ที่สำเร็จการศึกษา (รายงานตามปีที่สำรวจ)</h4></b>
              <table class="table table-bordered">
                <tbody><tr>
                  <th width="30%" class="text-center" >ข้อวิพากษ์ที่สำคัญจากผลการประเมิน</th>
                  <th width="30%" class="text-center">ข้อคิดเห็นของคณาจารย์ต่อผลการประเมิน</th>
                </tr>
                <tr></tr>
                @foreach($assessmentsummary as $value)
              <tr>
              @if($value['category_assessor']=="การประเมินจากผู้ที่สำเร็จการศึกษา")
                  <td >{{$value['evaluation_results']}}</td>
                  <td >{{$value['comment_faculty']}}</td>
              </tr>
              <tr>
              <td colspan="2"><b>ข้อเสนอการเปลี่ยนแปลงในหลักสูตรจากผลการประเมิน</b><br>{{$value['change_proposal']}}</td>
              </tr>
              @endif
                @endforeach
              </tbody></table>
              <br><br><b><h4>การประเมินจากผู้ที่มีส่วนเกี่ยวข้อง (ผู้ใช้บัณฑิต)</h4></b>
              <table class="table table-bordered">
                <tbody><tr>
                  <th width="30%" class="text-center" >ข้อวิพากษ์ที่สำคัญจากผลการประเมิน</th>
                  <th width="30%" class="text-center">ข้อคิดเห็นของคณาจารย์ต่อผลการประเมิน</th>
                </tr>
                <tr></tr>
                @foreach($assessmentsummary as $value)
              <tr>
              @if($value['category_assessor']=="การประเมินจากผู้ที่มีส่วนเกี่ยวข้อง")
                  <td >{{$value['evaluation_results']}}</td>
                  <td >{{$value['comment_faculty']}}</td>
              </tr>
              <tr>
              <td colspan="2"><b>ข้อเสนอการเปลี่ยนแปลงในหลักสูตรจากผลการประเมิน</b><br>{{$value['change_proposal']}}</td>
              </tr>
              @endif
              </tr>
                @endforeach
              </tbody></table>
</div></div>
              @endsection
