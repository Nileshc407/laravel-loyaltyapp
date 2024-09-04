<html>
<head>
    <title>enrollment</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <!-- <meta name="csrf-token" content="{{ csrf_token() }}">-->
</head>
<body>

    <div class="container-sm" style="background-color:white;">
        <a href="{{url('/')}}/home">Home</a>&nbsp;
        <a href="{{url('/')}}/enrollment">Enrollment</a>&nbsp;
        <a href="{{url('/')}}/logout">Sign Out</a>
       <h6>Enrollment</h6>
        <form method="post" enctype="multipart/form-data" action="{{url('/')}}/enrollment">
          @csrf
            <div class="row align-items-start">
                @if (session()->has('message'))    
                    <div class="alert alert-primary" role="alert">
                    {{session()->get('message')}}
                    </div>
                @endif
                <div class="col">
                    <div class="mb-3">
                        <label for="" class="form-label">Name</label>
                        <input type="text" class="form-control" name="name" id="name" placeholder="Enter name" value="{{old('name')}}">
                        <span class="text-danger">
                            @error('name')
                            {{$message}}
                            @enderror

                        </span>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Email</label>
                        <input type="text" class="form-control" name="email" id="email" placeholder="Enter email address" value="{{old('email')}}">
                        <span class="text-danger">
                            @error('email')
                            {{$message}}
                            @enderror
                        </span>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Phone</label>
                        <input type="text" class="form-control" name="phone" id="phone" placeholder="Enter phone number" value="{{old('phone')}}">
                        <span class="text-danger">
                            @error('phone')
                            {{$message}}
                            @enderror
                        </span>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Country</label>
                       <select class="form-control" name="country" id="country">
                        <option value="">select country</option>
                        @foreach ($country as $row)
                        {
                            <option value="{{$row->id}}">{{$row->name}}</option>
                        }
                        
                        @endforeach
                       </select>
                       <span class="text-danger">
                            @error('country')
                            {{$message}}
                            @enderror
                        </span>
                    </div>
                    <div class="mb-3">
                    <label for="" class="form-label">State</label>
                    <select class="form-control" name ="state" id="stateDropdown">
                        <option value="">select state</option>
                    </select>
                    <span class="text-danger">
                        @error('state')
                        {{$message}}
                        @enderror
                    </span>
                    </div>
                    <div class="mb-3">
                    <label for="" class="form-label">City</label>
                    <select class="form-control" name ="city" id="cityDropdown">
                        <option value="">select city</option>
                    </select>
                    <span class="text-danger">
                        @error('city')
                        {{$message}}
                        @enderror
                    </span>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Address</label>
                        <textarea class="form-control" id="address" name="address" rows="3"></textarea>
                    </div>
                    
                </div>
                <div class="col">
                    <div class="mb-3">
                        <label for="" class="form-label">User Type</label>
                        <select class="form-control" name="userType" id="userType">
                            <option value="">Select User Type</option>
                            <option value="1">Member</option>
                            <option value="2">Staff</option>
                        </select>
                        <span class="text-danger">
                            @error('userType')
                            {{$message}}
                            @enderror
                        </span>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Gender</label><br>
                        <input type="radio" name="gender" value="M"> Male
                        <input type="radio" name="gender" value="F"> Female
                        <input type="radio" name="gender" value="O"> Other
                        <span class="text-danger">
                            @error('gender')
                            {{$message}}
                            @enderror
                        </span>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Profession</label>
                        <input type="text" class="form-control" name="profession" id="profession" placeholder="Enter profession" value="{{old('profession')}}">
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Hobbies</label><br>
                        <input type="checkbox" value="swiming" name="hobbies[]"> Swiming
                        <input type="checkbox" value="driving" name="hobbies[]"> Driving
                        <input type="checkbox" value="reading" name="hobbies[]"> Reading
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">image</label>
                        <input type="file" class="form-control" name="image" id="image" placeholder="select file">
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Remarks</label>
                        <input type="text" class="form-control" name="remark" id="remark" placeholder="Enter remark" value="{{old('remark')}}">
                    </div>
                    <br><br>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
                    
            </div>
        </form>

        <form action="">
            <div class="mb-3">
                <input type="text" class="form-control" name="search" id="search" placeholder="Search by name or email" value="{{$search}}">
            </div>
            <div class="mb-3">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
            <div class="mb-3">
                <a href="{{url('/enrollment')}}">
                <button type="button" class="btn btn-primary">Reset</button>
                </a>
            </div>
        </form>

        <table class="table">
            <thead>
                <tr>
                    <th>Action</th>
                    <th>User Type</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Profession</th>
                    <th>Country</th>
                    <th>State</th>
                    <th>City</th>
                </tr>
            </thead>
            <tbody> 
            @foreach ($result as $row)
                <tr>
                    <td><a href="{{route('enrollment.edit',['id'=>$row->id])}}">Edit</a> | <a href="{{route('enrollment.delete',['id'=>$row->id])}}">Delete</a></td>
                    <td> @if($row['user_id']==2)
                     Staff
                    @elseif($row['user_id']==1)
                     Member
                    @endif</td>
                    <td>{{$row['name']}}</td>
                    <td>{{$row['email']}}</td>
                    <td>{{$row['phone']}}</td>
                    <td>{{$row['profession']}}</td>
                    <td> {{$row['country']['name']}}</td>
                    <td> {{$row['state']['name']}}</td>
                    <td> {{$row['city']['name']}}</td>
                </tr>
             @endforeach
           
            </tbody>
        </table>
        <div class="row">
            {{$result->links()}}
        </div>      
    </div>
</body>
</html>

<style>
    body {
    background-image: url('/images/CustomerLogin.jpg');
}
</style>
<script>
    document.getElementById('country').addEventListener('change', function() 
    {
        const countryId = this.value;
    
        if(countryId) 
        {  
            fetch('/state?country_id=' + countryId)
            .then(response=>response.json())
            .then(data=>{
                const stateDropdown = document.getElementById('stateDropdown');

                stateDropdown.innerHTML = '<option value=""> Select a state</option>';

                data.forEach(data=>{
                    const option = document.createElement('option');
                    option.value = data.id;
                    option.text = data.name;
                    stateDropdown.appendChild(option);
                });
            }).catch(error=> console.error('Error in fetching state:',error));
            
        } 
        else 
        {
            // Reset state dropdown if no country selected
            document.getElementById('stateDropdown').innerHTML = '<option value="">Select a state</option>';
        }
    });

    document.getElementById('stateDropdown').addEventListener('change',function () {
       const stateId =this.value;

       if(stateId)
       {
            fetch(`/city?state_id=` + stateId)
            .then(response=>response.json())
            .then(data=>{
                
                const cityDropdown = document.getElementById('cityDropdown');

                cityDropdown.innerHTML = '<option value="">Select a city</option>';

                data.forEach(data=>{
                    const option =document.createElement('option');
                    option.value = data.id;
                    option.text = data.name;
                    cityDropdown.appendChild(option);
                });
            }).catch(error=> console.error('error in fething city : ',error));

       }
       else
       {
            document.getElementById('cityDropdown').innerHTML = '<option value="">Select a city</option>';
       }
    });
</script>