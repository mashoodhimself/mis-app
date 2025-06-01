<x-commons.header />

<x-commons.preloader />

<x-commons.navbar />

<x-commons.sidebar />

<div class="content-wrapper">
    <x-commons.content-header title="Update Student" />

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        
                        <div class="mt-4 mx-3 mb-3">
                            <a style="border-radius:0px;" class="btn btn-primary" href="/students"><i class="fas fa-plus" ></i> Back</a>
                        </div>

                        <div class="card-body">
                            <form action="/student/edit/{{ $student->id }}" method="POST">

                                @csrf

                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <input type="text" name="full_name" id="full_name" class="form-control" value="{{ $student->name }}" placeholder="Full name">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <input type="text" name="username" id="username" class="form-control" value="{{ $student->username }}" placeholder="Username">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <input type="email" name="email" id="email" class="form-control" value="{{ $student->email }}" placeholder="Email Address">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <input type="text" name="registration_no" id="registration_no" class="form-control" value="{{ $student->registration_no }}" placeholder="Registraion No">
                                        @error('registration_no')
                                            <small class="text-danger"> {{ $message }} </small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <select name="semester" required id="semester" class="form-control">
                                            <option disabled selected>Select semester</option>
                                            <option {{ $student->semester === '1st' ? 'selected' : '' }}  value="1st">1st</option>
                                            <option {{ $student->semester === '2nd' ? 'selected' : '' }}  value="2nd">2nd</option>
                                            <option {{ $student->semester === '3rd' ? 'selected' : '' }}  value="3rd">3rd</option>
                                            <option {{ $student->semester === '4th' ? 'selected' : '' }}  value="4th">4th</option>
                                            <option {{ $student->semester === '5th' ? 'selected' : '' }}  value="5th">5th</option>
                                            <option {{ $student->semester === '6th' ? 'selected' : '' }}  value="6th">6th</option>
                                            <option {{ $student->semester === '7th' ? 'selected' : '' }}  value="7th">7th</option>
                                            <option {{ $student->semester === '8th' ? 'selected' : '' }}  value="8th">8th</option>
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
                                            <option {{ $student->section === 'A' ? 'selected' : '' }} value="A">A</option>
                                            <option {{ $student->section === 'B' ? 'selected' : '' }} value="B">B</option>
                                        </select>
                                        @error('section')
                                            <small class="text-danger"> {{ $message }} </small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <input type="password" name="password" id="password" class="form-control" value="{{ $student->password }}" placeholder="Password">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <input type="password" name="confirm_password" id="confirm_password" class="form-control" value="{{ $student->password }}" placeholder="Confirm Password">
                                    </div>
                                </div>
                                <div class="row mb-3" >
                                    <div class="col-md-12">
                                        <button style="border-radius: 0px" class="btn btn-primary border-0">Update</button>
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