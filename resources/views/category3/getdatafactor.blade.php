
                              @foreach($factor as $row)
                              @if($checkedit!="")<a href="/getfactor/{{$row['id']}}" class="btn btn-warning fr"><i class='fa fas fa-edit'></i> แก้ไขข้อมูล</a>@endif
                              <b>{!!$row['category_factor']!!}</b><br><br>
                              {!!$row['factor']!!}
                              @endforeach 
