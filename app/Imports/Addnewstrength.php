<?php

namespace App\Imports;

use App\category7_newstrength;
use Maatwebsite\Excel\Concerns\ToModel;

class Addnewstrength implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new category7_newstrength([
            'composition'=>$row[0],
            'strength'=>$row[1],
            'should_develop'=>$row[2],
            'year_id'=>session()->get('year_id'),
            'course_id'=>session()->get('usercourse'),
        ]);
    }
}
