<x-commons.header />

<x-commons.preloader />

<x-commons.navbar />

<x-commons.sidebar />

<div class="content-wrapper">

    <x-commons.content-header title="Upload Marks" />

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


                            <form action="/marks/upload" method="POST" enctype="multipart/form-data">

                                @csrf

                                <input type="hidden" name="course_id" value="{{ $course_id }}" readonly>

                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <label> Upload File </label>
                                        <input type="file" name="marks_file" id="marks_file" class="form-control">
                                        @error('marks_file')
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