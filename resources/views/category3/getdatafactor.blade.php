
                              @foreach($factor as $row)
                              <a href="/getfactor/{{$row['id']}}" class="btn btn-warning fr"><i class='fa fas fa-edit'></i> แก้ไขข้อมูล</a>
                              <b>{!!$row['category_factor']!!}</b><br><br>
                              {!!$row['factor']!!}
                              @endforeach 
