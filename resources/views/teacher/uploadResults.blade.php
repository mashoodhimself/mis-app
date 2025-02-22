<x-commons.header />

<x-commons.preloader />

<x-commons.navbar />

<x-commons.sidebar />

<div class="content-wrapper">

    <x-commons.content-header title="Upload Results" />

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">

                        @if (session('success'))
                            <x-extras.success-alert :message="session('success')" />
                        @endif

                        @if (session('error'))
                            <x-extras.error-alert :message="session('error')" />
                        @endif

                        <div class="card-body">

                            <div class="d-flex justify-content-end">
                                <a class="btn btn-secondary" href="/results/view">View Results</a>
                            </div>

                            <form action="/results/upload" method="POST" enctype="multipart/form-data">

                                @csrf

                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <label>Course</label>
                                        <select class="form-control" name="course_id" id="course_id">
                                            <option selected disabled>Select Course</option>
                                            @if (!empty($assignedCourses))
                                                @foreach ($assignedCourses as $course)
                                                    <option value="{{ $course->id }}"> {{ $course->course_name }} </option>
                                                @endforeach
                                            @endif
                                        </select>
                                        @error('course_id')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <label> Upload File </label>
                                        <input type="file" name="results_file" id="results_file" class="form-control">
                                        @error('results_file')
                                            <small class="text-danger"> {{ $message }} </small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3" >
                                    <div class="col-md-12">
                                        <button style="border-radius: 0px" class="btn btn-primary border-0">Upload</button>
                                    </div>
                                </div>

                            </form>

                            <div class="mt-5 text-danger">
                                <strong>Note:</strong> Only excel files is allowed. 
                            </div> 
                        

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>


<x-commons.footer />