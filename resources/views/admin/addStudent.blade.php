<x-commons.header />

<x-commons.preloader />

<x-commons.navbar />

<x-commons.sidebar />

<div class="content-wrapper">
    <x-commons.content-header title="Add New Student" />

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        
                        <div class="mt-4 mx-3 mb-3">
                            <a style="border-radius:0px;" class="btn btn-primary" href="/students"><i class="fas fa-plus" ></i> Back</a>
                        </div>

                        <div class="card-body">
                            <form action="/student/add" method="POST">

                                @csrf

                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <input type="text" name="full_name" id="full_name" class="form-control" placeholder="Full name">
                                        @error('full_name')
                                            <small class="text-danger"> {{ $message }} </small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <input type="text" name="username" id="username" class="form-control" placeholder="Username">
                                        @error('username')
                                            <small class="text-danger"> {{ $message }} </small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <input type="email" name="email" id="email" class="form-control" placeholder="Email Address">
                                        @error('email')
                                            <small class="text-danger"> {{ $message }} </small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <input type="text" name="registration_no" id="registration_no" class="form-control" placeholder="Registraion No">
                                        @error('registration_no')
                                            <small class="text-danger"> {{ $message }} </small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <select name="semester" required id="semester" class="form-control">
                                            <option disabled selected>Select semester</option>
                                            <option value="1st">1st</option>
                                            <option value="2nd">2nd</option>
                                            <option value="3rd">3rd</option>
                                            <option value="4th">4th</option>
                                            <option value="5th">5th</option>
                                            <option value="6th">6th</option>
                                            <option value="7th">7th</option>
                                            <option value="8th">8th</option>
                                        </select>
                                        @error('semester')
                                            <small class="text-danger"> {{ $message }} </small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <select name="section" required id="section" class="form-control">
                                            <option disabled selected>Select section</option>
                                            <option value="A">A</option>
                                            <option value="B">B</option>
                                        </select>
                                        @error('section')
                                            <small class="text-danger"> {{ $message }} </small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <input type="password" name="password" id="password" class="form-control" placeholder="Password">
                                        @error('password')
                                            <small class="text-danger"> {{ $message }} </small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <input type="password" name="confirm_password" id="confirm_password" class="form-control" placeholder="Confirm Password">
                                        @error('confirm_password')
                                            <small class="text-danger"> {{ $message }} </small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3" >
                                    <div class="col-md-12">
                                        <button style="border-radius: 0px" class="btn btn-primary border-0">Create</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>


<x-commons.footer />

<script>
    $(function() {
        $('#teachersTable').DataTable();
    })
</script>