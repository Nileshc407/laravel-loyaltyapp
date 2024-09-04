<html>
<head>
    <title>login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
<form method="post" action="{{url('/')}}/login">
    @csrf
    <div class="container-sm" style="background-color:white;"><br>
    <h5>{{"Sign with your email address and password"}}</h5><br>
        <div class="row align-items-start">
            <div class="col">
                <div class="mb-3">
                    <lable for="" class="form-label"> Email Address</lable><br>
                    <input type="text" class="form-control" name="userEmail" id="userEmail" class="form-control" placeholder="Email Address" value="{{old('userEmail')}}">
                    <span class="text-danger">
                        @error('userEmail')
                            {{$message}}
                        @enderror
                    </span>
                </div>
                <div class="mb-3">
                    <lable for="" class="form-label"> Password</lable><br>
                    <input type="password" class="form-control" name="userPassword" id="userPassword" class="form-control" placeholder="Password">
                    <span class="text-danger">
                        @error('userPassword')
                            {{$message}}
                        @enderror
                    </span>
                </div>
                <span class="text-danger">
                  {{session()->get('message')}}
                </span>
                <div class="mb-3">
                    <button type="submit" class="btn btn-primary">Login</button>
                </div>
        </div>
    </div>
    </div>
</form>
</body>
</html>

<style>
    body {
    background-image: url('/images/CustomerLogin.jpg');
}
</style>