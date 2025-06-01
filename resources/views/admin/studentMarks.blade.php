<x-commons.header />

<x-commons.preloader />

<x-commons.navbar />

<x-commons.sidebar />

<div class="content-wrapper">
    <x-commons.content-header title="Student Marks" />

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="mt-4 mx-3 mb-3">                            
                            <form action="/student/marks" method="POST">
                                @csrf
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="">Select Course</label>
                                        <select required name="course_id" id="course_id" class="form-control">
                                            <option selected disabled value="0">Select Course</option>
                                            @foreach ($assignedCourses as $course)
                                                <option {{ isset($course_id) && $course_id === $course->id ? 'selected' : '' }} value="{{ $course->id }}">{{ $course->course_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-5">
                                        <label for="">Date</label>
                                        <input type="date" name="attendance_date" id="attendance_date" class="form-control" />
                                    </div>
                                    <div class="col-md-1" style="padding-top:31px;">
                                        <button style="border-radius: 0px" class="btn btn-primary border-0">Filter</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    @if (isset($marks) && $marks->isNotEmpty())
                        <div class="card">
                            <table id="student-attendance" class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Student Name</th>
                                            <th>Registration #</th>
                                            <th>Semester</th>
                                            <th>Section</th>
                                            <th>Attendance</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                            @foreach ($attendance as $attendanceItem)
                                                <tr>
                                                    <td>{{ $attendanceItem->id }}</td>
                                                    <td>{{ $attendanceItem->student_name }}</td>
                                                    <td>{{ $attendanceItem->registration_no }}</td>
                                                    <td>{{ $attendanceItem->semester }}</td>
                                                    <td>{{ $attendanceItem->section }}</td>
                                                    <td>{{ $attendanceItem->attendance }}</td>
                                                </tr>
                                            @endforeach
                                        
                                    </tbody>
                                </table>
                            </div>
                        @endif
                </div>
            </div>
        </div>
    </div>

</div>


<x-commons.footer />
