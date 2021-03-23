<!DOCTYPE html>
<html lang="en">
<head>
    <title>Bootstrap Example</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css"
          integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">


</head>
<body>

<div class="container mt-5">
    <div class="row">
        <div class="col-lg-10">
            <h2>Create Student's Data</h2>
        </div>
        <div class="col-lg-2">
            <a href="{{route('students.index')}}" class="btn btn-outline-info"><i class="fas fa-backward"></i></a>
        </div>
    </div>
</div>

    <div class="container mt-5">

        <div class="form-group">
            <label for="name">name:</label>
            <input type="text" class="form-control" id="name" placeholder="Enter name" name="name">
            @error("name")
            <div class="alert alert-danger">{{$message}}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="address">Address:</label>
            <input type="text" class="form-control" id="address" placeholder="Enter address" name="address">
        </div>
        <div class="form-group">
            <label for="phone">Phone:</label>
            <input type="text" class="form-control" id="phone" placeholder="Enter phone" name="phone">
            @error("phone")
            <div class="alert alert-danger">{{$message}}</div>
            @enderror
        </div>
        <label>Choose Your Gender:</label>
        <div class="form-check">
            <label class="form-check-label">
                <input type="radio" class="form-check-input gender" name="gender" value="male" >Male
            </label>
        </div>
        <div class="form-check">
            <label class="form-check-label">
                <input type="radio" class="form-check-input gender" name="gender" value="female">Female
            </label>
            @error("gender")
            <div class="alert alert-danger">{{$message}}</div>
            @enderror
        </div><br>

        <label>Choose Your hobby:</label>
        <div class="form-check">
            <label class="form-check-label">
                <input type="checkbox" name="hobby[]" class="form-check-input hobby" value="reading" id>Reading
            </label>
        </div>
        <div class="form-check">
            <label class="form-check-label">
                <input type="checkbox" name="hobby[]" class="form-check-input hobby" value="playing">Playing
            </label>
        </div>
        <div class="form-check">
            <label class="form-check-label">
                <input type="checkbox" name="hobby[]" class="form-check-input hobby" value="Coding">Coding
            </label>
        </div>

        <button type="submit" class="btn btn-primary insertButton mt-2">Insert</button>
    </div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script>
let url = "{{route("students.index")}}";

$.ajaxSetup({
headers: {
'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
}
});

$(document).ready(function (){
$(".insertButton").click(function (){

    var name = $("#name").val();
    var address = $("#address").val();
    var phone = $("#phone").val();
    var gender = $(".gender:checked").val();
    var hobby = [];
    $(".hobby").each(function (){

        if (this.checked){
            hobby.push($(this).val());
        }
    });
    // console.log(hobby);

    $.ajax({

        type : "POST",
        url  : url,
        data : {
            name : name,
            address : address,
            phone : phone,
            gender : gender,
            hobby : hobby,
        },
        success : function (){
            console.log("data sent");
            window.location = url;
        },
        error : function (){
            console.log("error");
        },
    });

});
});
</script>
</body>
</html>
