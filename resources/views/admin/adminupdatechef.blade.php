<x-app-layout>

</x-app-layout>

<!DOCTYPE html>
<html lang="en">
  <head>
    <base href="/public">

    @include('admin.admincss')
  </head>
  <body>
    <div class="container-scroller">

    @include('admin.navbar')
    <div style="position: relative; top:60px; right:-150px">
        <form action="{{url('/updatechefdb',$data->id)}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div>
                <label for="">Chef Name</label>
                <input style="color: blue" type="text" name="name" value="{{$data->name}}" required>
            </div>
            <div>
                <label for="">Chef Speciality</label>
                <input style="color: blue" type="text" name="speciality" value="{{$data->speciality}}" required>
            </div>            
            <div>
                <label for="">Old Image</label>
                <img height="200" width="200" src="ChefsImage/{{$data->image}}">
            </div>
            <div>
                <label for="">New Image</label>
                <input type="file" name="image" required>
            </div>
            <div>
                <input style="color: black" type="submit" value="Save">
            </div>
        </form>
        <div>
        
    </div>
    
    </div>
    @include('admin.adminscript')
  </body>
</html>