<?php

namespace App\Imports;

use App\category7_strength;
use Maatwebsite\Excel\Concerns\ToModel;

class Addstrength implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new category7_strength([
            'composition'=>$row[0],
            'strength'=>$row[1],
            'should_develop'=>$row[2],
            'development_approach'=>$row[3],
            'year_id'=>session()->get('year_id'),
            'course_id'=>session()->get('usercourse'),
        ]);
    }
}
