<x-commons.header />

<x-commons.preloader />

<x-commons.navbar />

<x-commons.sidebar />

<div class="content-wrapper">
    <x-commons.content-header title="Student Attendance" />

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="mt-4 mx-3 mb-3">                            
                            <form action="" method="POST">
                                @csrf
                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <label for="">Select Course</label>
                                        <select required name="course_id" id="course_id" class="form-control">
                                            <option selected disabled value="0">Select Course</option>
                                            @foreach ($assignedCourses as $course)
                                                <option {{ isset($course_id) && $course_id === $course->id ? 'selected' : '' }} value="{{ $course->id }}">{{ $course->course_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <button style="border-radius: 0px" class="btn btn-primary border-0">Filter</button>
                                    </div>
                                </div>
                            </form>

                        </div>

                        <div class="card-body">

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
                                    @if (!empty($attendance))
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
                                    @endif
                                </tbody>
                            </table>
                           
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
        // $('#teachersTable').DataTable();
    })
</script>