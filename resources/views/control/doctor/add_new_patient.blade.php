@extends('control.layout._app')

@section('content')
    <div class="card">

        <div class="card-body">

            @include('auth.error')
            @include('auth.message')
            <!-- Multi Columns Form -->
            <form class="row g-3" action="{{url('_doctor/add_new_patient')}}" method="POST">
                @csrf
                <h5 style="text-align:center;" class="card-title alert alert-info">Basic Information</h5>
                {{-- <label for="inputPassword5" class="form-label">#Patient-ID<sup style="color:red;">*</sup></label>
                <input type="text" class="form-control" id="inputPassword5" disabled> --}}
                <div class="col-md-12">
                    <label for="searchInput" class="form-label">Search User<sup style="color:red;">*</sup></label>
                    <input type="text" id="searchInput" class="form-control" placeholder="Search by email...">
                    <div id="searchResults" class="form-control"></div>
                </div>
                
                <div class="col-md-6">
                    <label for="inputPassword5" class="form-label">Name<sup style="color:red;">*</sup></label>
                    <input type="text" class="form-control" id="inputPassword5" name="name">
                </div>
                <div class="col-md-6">
                    <label for="inputEmail5" class="form-label">Email<sup style="color:red;">*</sup></label>
                    <input type="number" id="selectedID" name="id" value="" hidden>
                    <input type="email" class="form-control" id="selectedEmail" name="email" value="" readonly>
                </div>
                <div class="col-md-4">
                    <label for="inputPassword5" class="form-label">Gender<sup style="color:red;">*</sup></label>
                    <select id="inputState" class="form-select" name="gender">
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                    </select>
                </div>
                <div class="col-md-8">
                    <label for="inputAddress5" class="form-label">Address<sup style="color:red;">*</sup></label>
                    <input type="text" class="form-control" id="inputAddres5s" name="address" value="">
                </div>
                <div class="col-md-6">
                    <label for="inputCity" class="form-label">Age<sup style="color:red;">*</sup></label>
                    <input type="number" class="form-control" id="inputCity" name="age">
                </div>
                <div class="col-md-6">
                    <label for="inputCity" class="form-label">Contact Number<sup style="color:red;">*</sup></label>
                    <input type="text" class="form-control" id="inputCity" name="phone">
                </div>
                {{-- <div class="col-md-12">
                    <label for="inputNumber" class="col-sm-2 col-form-label">Photo</label>
                    <input class="form-control" type="file" id="formFile" name="photo_path">
                </div> --}}
                <hr />

                <h5 style="text-align:center;" class="card-title alert alert-info mt-2">Medical Information</h5>
                <div class="col-md-6">
                    <label for="inputPassword5" class="form-label">Height<sup style="color:red;">*</sup></label>
                    <input type="text" class="form-control" id="inputPassword5" placeholder="Enter Height In Centimeter" name="height">
                </div>
                <div class="col-md-6">
                    <label for="inputPassword5" class="form-label">Blood Group<sup style="color:red;">*</sup></label>
                    <select id="inputState" class="form-select" name="blood_group">
                        <option value="A+">A+</option>
                        <option value="A-">A-</option>
                        <option value="B+">B+</option>
                        <option value="B-">B-</option>
                        <option value="O+">O+</option>
                        <option value="O-">O-</option>
                        <option value="AB+">AB+</option>
                        <option value="AB-">AB-</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="inputPassword5" class="form-label">Pulse<sup style="color:red;">*</sup></label>
                    <input type="text" class="form-control" id="inputPassword5" placeholder="Enter Pulse" name="pulse">
                </div>
                <div class="col-md-6">
                    <label for="inputPassword5" class="form-label">Blood Pressure<sup style="color:red;">*</sup></label>
                    <input type="text" class="form-control" id="inputPassword5" placeholder="Enter Blood Pressure" name="blood_pressure">
                </div>
                <div class="col-md-12">
                    <label for="inputPassword5" class="form-label">Allergy<sup style="color:red;">*</sup></label>
                    <input type="text" class="form-control" id="inputPassword5" placeholder="Enter Allergy Symptoms" name="allergy">
                </div>
                <div class="col-md-6">
                    <label for="inputPassword5" class="form-label">Weight<sup style="color:red;">*</sup></label>
                    <input type="number" class="form-control" id="inputPassword5" placeholder="Enter Weight" name="weight">
                </div>
                <div class="col-md-6">
                    <label for="inputPassword5" class="form-label">Respiration<sup style="color:red;">*</sup></label>
                    <input type="text" class="form-control" id="inputPassword5" placeholder="Enter Respiration" name="respiration">
                </div>
                <div class="col-md-12">
                    <label for="inputPassword5" class="form-label">Diet<sup style="color:red;">*</sup></label>
                    <select id="inputState" class="form-select" name="diet">
                        <option value="vegetarian">Vegetarian</option>
                        <option value="non-vegetarian">Non-Vegetarian</option>
                        <option value="vegan">Vegan</option>
                    </select>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Add Patient</button>                  
                </div>
                <!-- End Multi Columns Form -->
            </form>
        </div>


    </div>

    <script>
        //For add_new_patient
        const searchInput = document.getElementById('searchInput');

        // Define the event listener function
        function searchInputListener() {
            let searchValue = this.value;

            // Clear previous search results
            document.getElementById('searchResults').innerHTML = '';

            // Perform AJAX request to search for users
            fetch(`/_doctor/search_users?email=${searchValue}`)
                .then(response => response.json())
                .then(data => {
                    // Keep track of already displayed emails
                    let displayedEmails = [];

                    // Display search results
                    data.forEach(user => {
                        // Check if the email is already displayed
                        if (!displayedEmails.includes(user.email)) {
                            let userElement = document.createElement('div');
                            userElement.textContent = user.name + ' - ' + user.email;
                            userElement.classList.add('user-item', 'form-control', 'border-dark',
                                'text-success');
                            userElement.addEventListener('click', function() {
                                // Assign the email to the input element
                                document.getElementById('selectedEmail').value = user.email;
                                document.getElementById('selectedID').value = user.id;
                                document.getElementById('searchResults').style.display = 'none';
                                document.getElementById('searchInput').value = '';
                            });
                            document.getElementById('searchResults').appendChild(userElement);

                            // Add the email to the displayedEmails array
                            displayedEmails.push(user.email);
                        }
                    });

                    // Show search results
                    document.getElementById('searchResults').style.display = 'block';
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        }

        // Add event listener to search input
        searchInput.addEventListener('input', searchInputListener);
    </script>
@endsection
