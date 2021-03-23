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
            <h2>Edit Student's Data</h2>
        </div>
        <div class="col-lg-2">
            <a href="{{route('students.index')}}" class="btn btn-outline-info"><i class="fas fa-backward"></i></a>
        </div>
    </div>
</div>

<div class="container mt-5">

    <div class="form-group">
        <label for="name">Name:</label>
        <input type="text" class="form-control" id="name" placeholder="Enter name" name="name" value="{{$student->name}}">
        @error("name")
        <div class="alert alert-danger">{{$message}}</div>
        @enderror
    </div>
    <div class="form-group">
        <label for="address">Address:</label>
        <input type="text" class="form-control" id="address" placeholder="Enter address" name="address" value="{{$student->address}}">

    </div>
    <div class="form-group">
        <label for="phone">Phone:</label>
        <input type="text" class="form-control" id="phone" placeholder="Enter phone" name="phone" value="{{$student->phone}}">
        @error("phone")
        <div class="alert alert-danger">{{$message}}</div>
        @enderror
    </div>

    <label>Choose Your Gender:</label>
    <div class="form-check">
        <label class="form-check-label">
            <input type="radio" class="form-check-input gender" name="gender" value="male"
            @if($student->gender == "male") checked @endif>Male
        </label>
    </div>
    <div class="form-check">
        <label class="form-check-label">
            <input type="radio" class="form-check-input gender" name="gender" value="female"
                   @if($student->gender == "female") checked @endif>Female
        </label>
        @error("gender")
        <div class="alert alert-danger">{{$message}}</div>
        @enderror
    </div><br>
    <label>Update Your hobby:</label>
    <div class="form-check">
        <label class="form-check-label">
            <input type="checkbox" name="hobby[]" class="form-check-input hobby" value="reading" @if(in_array("reading", explode(',',$student->hobby))) checked @endif>Reading
        </label>
    </div>
    <div class="form-check">
        <label class="form-check-label">
            <input type="checkbox" name="hobby[]" class="form-check-input hobby" value="playing" @if(in_array("playing", explode(',',$student->hobby))) checked @endif>Playing
        </label>
    </div>
    <div class="form-check">
        <label class="form-check-label">
            <input type="checkbox" name="hobby[]" class="form-check-input hobby" value="Coding" @if(in_array("Coding", explode(',',$student->hobby))) checked @endif>Coding
        </label>
    </div>

    <button type="submit" class="btn btn-outline-primary form-control updateButton mt-2" data-id = "{{$student->id}}">Update</button>

</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script>
    let url = "{{route("students.update",$student->id)}}";
    let index_url = "{{route("students.index")}}";

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).on('click',".updateButton",function (){

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

            type : "PUT",
            url  : url,
            data : {
                name    : name,
                address : address,
                phone   : phone,
                gender  : gender,
                hobby   : hobby,
            },
            success : function (data){

                window.location = index_url;
                alert(data);
            },
            error : function (){
                console.log("error");
            },
        });
    });





</script>


</body>
</html>
