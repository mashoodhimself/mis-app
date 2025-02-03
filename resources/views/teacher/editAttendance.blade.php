<x-commons.header />

<x-commons.preloader />

<x-commons.navbar />

<x-commons.sidebar />

<div class="content-wrapper">

    <x-commons.content-header title="Update Attendance" />

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

                        <div class="mt-4 mx-3 mb-3">
                            <a style="border-radius:0px;" class="btn btn-primary" href="/attendance/view"><i class="fas fa-plus" ></i> Back</a>
                        </div>

                        <div class="card-body">
                            <form action="/attendance/edit/{{ $attendanceRecord->id }}" method="POST">

                                @csrf
                                
                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <label>Registration #</label>
                                        <input disabled type="text" name="registration_no" id="registration_no" class="form-control" value="{{ $attendanceRecord->registration_no }}">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <label>Student Name</label>
                                        <input disabled type="text" value="{{ $attendanceRecord->student_name }}" name="student_name" id="student_name" class="form-control">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <label>Semester</label>
                                        <input disabled type="text" value="{{ $attendanceRecord->semester }}" name="semester" id="semester" class="form-control">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <label>Section</label>
                                        <input disabled type="text" value="{{ $attendanceRecord->section }}" name="section" id="section" class="form-control">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <label>Course</label>
                                        <input disabled type="text" value="{{ $attendanceRecord->course_id }}" name="section" id="section" class="form-control">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <label>Date</label>
                                        <input disabled type="text" value="{{ $attendanceRecord->attendance_date }}" name="attendance_date" id="attendance_date" class="form-control">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <label>Attendance</label>
                                        <select class="form-control" name="attendance" id="attendance">
                                            <option value="P" {{ $attendanceRecord->attendance == 'P' ? 'selected' : '' }}>Present</option>
                                            <option value="A" {{ $attendanceRecord->attendance == 'A' ? 'selected' : '' }}>Absent</option>
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