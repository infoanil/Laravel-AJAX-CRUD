
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Bootstrap Example</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
            integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css"
          integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <link href="//cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css" rel="stylesheet">
    <script src="//cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>

</head>
<body>

<div class="container mt-5">
    <div class="row">
        <div class="col-lg-10">
            <h2>Students List</h2>
        </div>
        <div class="col-lg-2">
            <a href="{{route('students.create')}}" class="btn btn-outline-info"><i class="fas fa-user-plus"></i> </a>
        </div>
    </div>
</div>

@if($msg = Session::get("success"))
<div class="alert alert-success container">
    {{$msg}}
</div>
@endif

    <table class="table table-hover mt-5 myTable">
        <thead>
        <tr>
            <th>Id</th>
            <th>Name</th>
            <th>Address</th>
            <th>Phone</th>
            <th>Gender</th>
            <th>Hobbies</th>
            <th width="250px">Action</th>
        </tr>
        </thead>
        <tbody>


            @foreach($students as $student)
                <tr id="record{{$student->id}}">
            <td>{{$i++}}</td>
            <td>{{$student->name}}</td>
            <td>{{$student->address}}</td>
            <td>{{$student->phone}}</td>
            <td>{{$student->gender}}</td>
            <td>{{$student->hobby}}</td>
                <td>
{{--                    <form action="{{route("students.destroy",$student->id)}}" method="post">--}}
{{--                        @csrf--}}
                        <a href="{{route("students.show",$student->id)}}" class="btn btn-outline-success"><i class="fas fa-eye"></i></a>
                        <a href="{{route("students.edit",$student->id)}}" class="btn btn-outline-info"><i class="fas fa-user-edit"></i></a>
{{--                        @method("delete")--}}
                        <a data-id="{{$student->id}}"  class="btn btn-outline-danger DeleteButton"><i class="fas fa-trash"></i></a>
{{--                    </form>--}}
                </td>
                </tr>
            @endforeach

        </tbody>
    </table>
{{--<div class="container">--}}
{{--    {{$students->links()}}--}}
{{--</div>--}}


<script>
    let url = "{{route("students.index")}}";

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).ready(function (){
            $('.myTable').DataTable();
        $(".DeleteButton").click(function (){
            var id = $(this).data("id");
            // alert(id);
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type : "delete",
                        url  : url+"/"+id,
                        cache:false,
                        success:function (data){
                            var dataResult = JSON.parse(data);
                            $("#record"+id).remove();
                            console.log(dataResult);
                        },
                        error:function (){
                            console.log("Error");
                        }
                    });

                    Swal.fire(
                        'Deleted!',
                        'Your file has been deleted.',
                        'success'
                    )
                }
            })
        });
    });
</script>

</body>
</html>

