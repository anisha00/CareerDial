<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>USER Login Form</title>
</head>

<script>
    var msg = '{{Session::get('status')}}';
    var exist = '{{Session::has('status')}}';
    if(exist){
        alert(msg);
    }
</script>
<body>
<div class="container">


    <h1>User Login</h1>
    <form id="myForm" class="needs-validation"  action="login" method="post">
        @csrf
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

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>

</body>
</html>
