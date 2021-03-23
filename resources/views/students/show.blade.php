
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Bootstrap Example</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>

<div class="container">
    <div class="row">
        <div class="col-lg-10">
            <h2>Student's Detail</h2>
        </div>
        <div class="col-lg-2">
            <a href="{{route('students.index')}}" class="btn btn-info">Back</a>
        </div>
    </div>
</div>

<table class="table table-hover table-bordered mt-5 container">
    <thead>
    <tr>
        <th>Id</th>
        <th>Name</th>
        <th>Address</th>
        <th>Phone</th>
        <th>Gender</th>
        <th>Hobby</th>
    </tr>
    </thead>
    <tbody>

        <tr>
            <td>{{$student->id}}</td>
            <td>{{$student->name}}</td>
            <td>{{$student->address}}</td>
            <td>{{$student->phone}}</td>
            <td>{{$student->gender}}</td>
            <td>{{$student->hobby}}</td>

        </tr>
    </tbody>
</table>


</body>
</html>
