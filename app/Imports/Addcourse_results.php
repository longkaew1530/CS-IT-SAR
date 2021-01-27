<?php

namespace App\Imports;

use App\category4_course_results;
use Maatwebsite\Excel\Concerns\ToModel;

class Addcourse_results implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new category4_course_results([
            'course_name'=>$row[0],
            'term_year'=>$row[1],
            'a'=>$row[2],
            'BB'=>$row[3],
            'b'=>$row[4],
            'CC'=>$row[5],
            'c'=>$row[6],
            'DD'=>$row[7],
            'd'=>$row[8],
            'f'=>$row[9],
            'register'=>$row[10],
            'pass_exam'=>$row[11],
            'year_id'=>session()->get('year_id'),
            'course_id'=>session()->get('usercourse'),
        ]);
    }
}
