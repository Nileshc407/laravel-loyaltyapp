<html>
<head>
    <title>edit enrollment</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
    <div class="container-sm" style="background-color:white;">
        <a href="{{url('/')}}/home">Home</a>&nbsp;
        <a href="{{url('/')}}/enrollment">Enrollment</a>&nbsp;
        <a href="{{url('/')}}/logout">Sign Out</a>
       <h6>Edit Enrollment</h6>
        <form method="post" action="{{url('/')}}/update_enrollment/{{$enrollment->id}}" enctype="multipart/form-data">
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
                        <input type="text" class="form-control" name="name" id="name" placeholder="Enter name" value="{{$enrollment->name}}">
                        <span class="text-danger">
                            @error('name')
                            {{$message}}
                            @enderror

                        </span>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Email</label>
                        <input type="text" class="form-control" name="email" id="email" placeholder="Enter email address" value="{{$enrollment->email}}">
                        <span class="text-danger">
                            @error('email')
                            {{$message}}
                            @enderror
                        </span>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Phone</label>
                        <input type="text" class="form-control" name="phone" id="phone" placeholder="Enter phone number" value="{{$enrollment->phone}}">
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
                            <option value="{{$row->id}}" {{ $enrollment->country_id == $row->id ? 'selected' : ''}}>{{$row->name}}</option>
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
                        @foreach ($state as $row)
                        {
                            <option value="{{$row->id}}" {{ $enrollment->state_id == $row->id ? 'selected' : ''}}>{{$row->name}}</option>
                        }
                        @endforeach
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
                        @foreach ($city as $row)
                        {
                            <option value="{{$row->id}}" {{ $enrollment->city_id == $row->id ? 'selected' : ''}}>{{$row->name}}</option>
                        }
                        @endforeach
                    </select>
                    <span class="text-danger">
                        @error('city')
                        {{$message}}
                        @enderror
                    </span>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Address</label>
                        <textarea class="form-control" id="address" name="address" rows="3">{{$enrollment->address}}</textarea>
                    </div>
                </div>
                <div class="col">
                    <div class="mb-3">
                        <label for="" class="form-label">User Type</label>
                        <select class="form-control" name="userType" id="userType">
                            <option value="{{$enrollment->user_id}}">@if ($enrollment->user_id == 1)
                            Member
                            @else
                            Staff
                            @endif
                            </option>
                           
                        </select>
                        <span class="text-danger">
                            @error('userType')
                            {{$message}}
                            @enderror
                        </span>
                    </div>
                  
                    <div class="mb-3">
                        <label for="" class="form-label">Gender</label><br>
                        <input type="radio" name="gender" value="M" {{ $enrollment->gender == "M" ? 'checked' : ''}}>Male
                        <input type="radio" name="gender" value="F" {{ $enrollment->gender == "F" ? 'checked' : ''}}>Female
                        <input type="radio" name="gender" value="O" {{ $enrollment->gender == "O" ? 'checked' : ''}}>Other
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Profession</label>
                        <input type="text" class="form-control" name="profession" id="profession" placeholder="Enter profession" value="{{$enrollment->profession}}">
                    </div>
                   
                    <div class="mb-3">
                        <label for="" class="form-label">image</label>
                        <input type="file" class="form-control" name="image" id="image" placeholder="select file">
                    </div>
                    @if ($enrollment->profile_pic != Null)
                        <img src="{{asset('uploads/profilePic/'.$enrollment->profile_pic)}}" style="max-width: 10%; height: auto;" id="Profile_img">
                    @endif <br><br>
                    <div class="mb-3">
                        <label for="" class="form-label">Remarks</label>
                        <input type="text" class="form-control" name="remark" id="remark" placeholder="Enter remark" value="{{$enrollment->remark}}">
                    </div><br><br>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
                    
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
                <td>{{$row->name}}</td>
                <td>{{$row->email}}</td>
                <td>{{$row->phone}}</td>
                <td>{{$row->profession}}</td>
                <td> {{$row['country']['name']}}</td>
                <td> {{$row['state']['name']}}</td>
                <td> {{$row['city']['name']}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{$result->links()}}
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

                const cityDropdown = document.getElementById('cityDropdown');

                stateDropdown.innerHTML = '<option value=""> Select a state</option>';

                cityDropdown.innerHTML = '<option value=""> Select a city</option>';

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

            document.getElementById('cityDropdown').innerHTML = '<option value="">Select a city</option>';
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