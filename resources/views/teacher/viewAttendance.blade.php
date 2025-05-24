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
                            <table style="width:100%;" id="attendance-table" class="table table-striped">
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
