<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>USER Login Form</title>
    <script>
        var msg = '{{Session::get('status')}}';
        var exist = '{{Session::has('status')}}';
        if(exist){
            alert(msg);
        }
    </script>
</head>
<body>
<div class="container">


    <h1>User Register</h1>
    <form id="myForm" class="needs-validation"  action="register" method="post">
        @csrf
        <div class="form-group">
            <label for="name"> Name:</label>
            <input type="text" class="form-control" id="name" name="name" >
            @error('name')
            <div class="text-danger">{{$message}}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="email"> Email :</label>
            <input type="text" class="form-control" id="email" name="email">
            @error('email')
            <div class="text-danger">{{$message}}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="password"> Password :</label>
            <input type="text" class="form-control" id="password" name="password">
            @error('password')
            <div class="text-danger">{{$message}}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-warning">Submit</button>
    </form>
</div>

</body>
</html>
