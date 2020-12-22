@extends('layout.admid_layout')

@section('content')
<div class="box box-warning marginl">
<div class="box-header">
<b><li>คุณภาพบัณฑิตตามกรอบมาตรฐานคุณวุฒิระดับอุดมศึกษาแห่งชาติ (ตัวบ่งชี้ที่ 2.1) </li></b>
            <div class="box-body">
              <table class="table table-bordered ">
                <tbody><tr>
                  <th width="80%" class="text-center">ข้อมูลพื้นฐาน</th>
                  <th width="10%" class="text-center">จำนวน</th>
                  @foreach($factor as $value)
                </tr>
                <td>1. จำนวนบัณฑิตที่สำเร็จการศึกษาในหลักสูตรนี้ทั้งหมด</td>
                <td>{{$value['qtyall']}}</td>
                <tr>
                </tr>
                <td>1. จำนวนบัณฑิตที่สำเร็จการศึกษาในหลักสูตรนี้ทั้งหมด</td>
                <td>{{$value['qtyrate']}}</td>
                <tr>
                </tr>
                <td>1. จำนวนบัณฑิตที่สำเร็จการศึกษาในหลักสูตรนี้ทั้งหมด</td>
                <td>{{$value['persen']}}</td>
                <tr>
                </tr>
                <td>1. จำนวนบัณฑิตที่สำเร็จการศึกษาในหลักสูตรนี้ทั้งหมด</td>
                <td>{{$value['sumscore']}}</td>
                <tr>
                </tr>
                <td>1. จำนวนบัณฑิตที่สำเร็จการศึกษาในหลักสูตรนี้ทั้งหมด</td>
                <td>{{$value['resultscore']}}</td>
                <tr>
                </tr>
                @endforeach
              </tbody></table></div></div>
   <style>
   .b{
     background-color:black;
   }
   </style>           
              
              
              @endsection
