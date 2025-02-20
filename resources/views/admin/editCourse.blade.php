<x-commons.header />

<x-commons.preloader />

<x-commons.navbar />

<x-commons.sidebar />

<div class="content-wrapper">
    <x-commons.content-header title="Update Course" />

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        
                        <div class="mt-4 mx-3 mb-3">
                            <a style="border-radius:0px;" class="btn btn-primary" href="/courses"><i class="fas fa-plus" ></i> Back</a>
                        </div>

                        <div class="card-body">
                            <form action="/course/edit/{{ $course->id }}" method="POST">

                                @csrf

                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <label for="">Course Title</label>
                                        <input type="text" name="title" id="title" class="form-control" value="{{ $course->title }}" placeholder="Course title">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <label for="">Course Code</label>
                                        <input type="text" name="code" id="code" class="form-control" value="{{ $course->code }}" placeholder="Course Code">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <label for="">Course Credits</label>
                                        <input type="number" name="credit" id="credit" class="form-control" value="{{ $course->credit }}" placeholder="Credit Hr">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <label for="">Teach By</label>
                                        <select name="teacher_id" id="teacher_id" class="form-control">
                                            <option selected value="0">Select Teacher</option>
                                            @foreach (\App\Services\UserService::getAllActiveTeachers() as $teacher)
                                                <option {{ $teacher->id === $user_id ? 'selected' : '' }} value="{{ $teacher->id }}">{{ $teacher->name }}</option>
                                            @endforeach
                                        </select>
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