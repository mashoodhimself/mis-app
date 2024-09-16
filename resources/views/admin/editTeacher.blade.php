<x-commons.header />

<x-commons.preloader />

<x-commons.navbar />

<x-commons.sidebar />

<div class="content-wrapper">
    <x-commons.content-header title="Edit Teacher" />

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        
                        <div class="mt-4 mx-3 mb-3">
                            <a style="border-radius:0px;" class="btn btn-primary" href="/teachers"><i class="fas fa-plus" ></i> Back</a>
                        </div>

                        <div class="card-body">

                            <form action="/teacher/edit/{{ $teacher->id }}" method="POST">

                                @csrf

                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <input type="text" name="full_name" id="full_name" class="form-control" value="{{ $teacher->name }}" placeholder="Full name">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <input type="text" name="username" id="username" class="form-control" value="{{ $teacher->username }}" placeholder="Username">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <input type="email" name="email" id="email" class="form-control" value="{{ $teacher->email }}" placeholder="Email Address">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <input type="password" name="password" id="password" class="form-control" value="{{ $teacher->username }}" placeholder="Password">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <input type="password" name="confirm_password" id="confirm_password" class="form-control" value="{{ $teacher->username }}" placeholder="Confirm Password">
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