<?php

namespace App\Imports;

use App\ModelAJ\category3_inforstudent;
use Maatwebsite\Excel\Concerns\ToModel;

class AddstdImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new category3_inforstudent([
            'yearadd'=>$row[0],
            'y1'=>$row[1],
            'y2'=>$row[2],
            'y3'=>$row[3],
            'y4'=>$row[4],
            'y5'=>$row[5],
            'y6'=>$row[6],
            'y7'=>$row[7],
        ]);
    }
}
