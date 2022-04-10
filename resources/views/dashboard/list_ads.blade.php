@extends('layout.master')

@section('content')


            <div class="form-container">
                <div class="exper_info ">
                    <h3 class="d-inline"> Ads </h3> <a  class="add add_exp " href="/add_experience"> add</a>
                         
                                </div><table class="table table-image">
                                  <thead>
                                    <tr>
                                      {{-- <th scope="col">Number</th> --}}
                                      
                                      <th scope="col">Ad</th>
                                      <th scope="col">Company</th>
                                      <th scope="col">status</th>
                                      <th scope="col">actions</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    @foreach ($data as $item)
                               
                                    <tr>
                                      {{-- <th scope="row">2</th> --}}
                                      <td class="w-25">
                                          <img src="images/{{$item["image"]}}" class="rounded" style="width:140px;height:60px">
                                      </td>
                                     
                                      <td>{{$item["company"]}}</td>
                                      <td>
                                        @if ($item["is_active"]==1)
                                        <span style ="background-color: #e8fadf ;
                                        color: #71dd37;padding: 5px 8px; border-radius: 4px;
                                        padding-bottom: 9px;"class=" ">active</span>
                                        @else
                                        <span class=" " style="color: #ea2b33;
                                        background-color: #ffeced;padding: 5px 8px; border-radius: 4px;
                                        padding-bottom: 9px;">unactive</span>
                                        @endif
                                         </td>
                                       <td> 
                                       
                                         <a href="update_ad/{{$item["id"]}}" class=" edit btn "><i class="fas fa-edit"></i></a>
                                         @if ($item["is_active"]==1)
                                         <a href="activate_ad/{{$item["id"]}}/{{$item["is_active"]}}" class="btn  text-danger" ><i class="fas fa-trash-alt"></i></a>
                                            
                                         @else
                                         <a href="activate_ad/{{$item["id"]}}/{{$item["is_active"]}}" class="btn  " style="color: #71dd37" >activate</a>
                                             
                                         @endif
                                       </td>
                                    </tr>
                                    @endforeach
                                  </tbody>
                            </table>
                    </div>
           </div>




</div>


















    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  
</body>
</html>

@endsection