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
                            <table id="attendance-table" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>REG #</th>
                                        <th>STUDENT NAME</th>
                                        <th>SEMESTER</th>
                                        <th>SECTION</th>
                                        <th>COURSE</th>
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
                                            <td>{{ $attendanceRecord->student_name }}</td>
                                            <td>{{ $attendanceRecord->semester }}</td>
                                            <td>{{ $attendanceRecord->section }}</td>
                                            <td>{{ $attendanceRecord->course_id }}</td>
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
    })
</script>