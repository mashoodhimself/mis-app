<x-commons.header />

<x-commons.preloader />

<x-commons.navbar />

<x-commons.sidebar />

<div class="content-wrapper">

    <x-commons.content-header title="View Attendance" />

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="jumbotron jumbotron-fluid">
                                <div class="container">
                                  <h1 class="display-4">Filter By Course</h1>
                                  <p class="lead">
                                    <form action="/attendance/view" method="POST">
                                        @csrf
                                        <select class="form-control" name="course" id="course">
                                            <option selected disabled value="">Select Course</option>
                                            @if (!empty($courses))
                                                @foreach ($courses as $courseItem)
                                                    <option {{ !empty($course_id) && $course_id === $courseItem->id ? 'selected' : '' }} value="{{ $courseItem->id }}"> {{ $courseItem->title }} </option>
                                                @endforeach
                                            @endif
                                        </select>
                                        <button type="submit" class="mt-2 btn btn-warning" >Filter</button>
                                        <button type="button" class="mt-2 btn btn-danger deleteCourseBtn" >Delete</button>
                                    </form>
                                    <div class="mt-3 text-danger message-box"></div>
                                  </p>
                                </div>
                            </div>
                            <table id="attendance-table" class="table table-striped table-responsive">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>REG #</th>
                                        <th>COURSE</th>
                                        <th>STUDENT NAME</th>
                                        <th>SEMESTER</th>
                                        <th>SECTION</th>
                                        <th>ATTENDANCE</th>
                                        <th>DATE</th>
                                        <th>ACTION</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($attendanceRecords as $attendanceRecord)
                                        <tr>
                                            <td>{{ $attendanceRecord->id }}</td>
                                            <td>{{ $attendanceRecord->registration_no }}</td>
                                            <td>{{ $attendanceRecord->course->title }}</td>
                                            <td>{{ $attendanceRecord->student_name }}</td>
                                            <td>{{ $attendanceRecord->semester }}</td>
                                            <td>{{ $attendanceRecord->section }}</td>
                                            <td>{{ $attendanceRecord->attendance }}</td>
                                            <td>{{ $attendanceRecord->attendance_date }}</td>
                                            <td><a href="/attendance/edit/{{ $attendanceRecord->id }}"><i class="fas fa-edit"></i></a></td>
                                        </tr>
                                    @endforeach
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
        $('#attendance-table').DataTable();

        $('.deleteCourseBtn').on('click', function() {

            let courseId = $('#course').val()

            if(courseId === null) {
                $('.message-box').text('Please select course in-order to delete.')
                return false;
            }

            if(!confirm('Are you sure to delete records ?')) {
                return false;
            }

            let formdata = new FormData();
            formdata.append('courseId', courseId);
            formdata.append('_token', '{{ csrf_token() }}');

            $.ajax({
                url: '/attendance/destroy',
                type: 'POST',
                data: formdata,
                processData: false, 
                contentType: false, 
                success: function(response) {
                    $('.message-box').text(response.message);
                    $('#attendance-table').trigger('update');
                },
                error: function(error) {
                    $('.message-box').text(error);
                }
            });

        });

    })
</script>