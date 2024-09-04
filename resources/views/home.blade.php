<html>
<head>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <title>home</title>
</head>
<body>
    <div class="container" style="background-color:white;">
        <a href="{{url('/')}}/home">Home</a>&nbsp;
        <a href="{{url('/')}}/enrollment">Enrollment</a>&nbsp;
        <a href="{{url('/')}}/logout">Sign Out</a><br><br>
        <h5>{{"Hello,"}} {{ucwords(session()->get('user_name'))}}</h5><br>
        <img src="{{asset('uploads/profilePic/'.session()->get('profile_pic'))}}" style="max-width: 10%; height: auto;"><br><br>   
    </div>
</body>
</html>

<style>
    body {
    background-image: url('/images/CustomerLogin.jpg');
}
</style>