
<div class="content">
    <x-commons.content-header title="Student Attendance" />
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="mt-4 mx-3 mb-3">
                        <form wire:submit.prevent="filter">
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="course_id">Select Course</label>
                                    <select required wire:model="course_id" id="course_id" class="form-control">
                                        <option selected disabled value="0">Select Course</option>
                                        @foreach ($assignedCourses as $course)
                                            <option wire:key="course-{{ $course->id }}" value="{{ $course->id }}">{{ $course->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-5">
                                    <label for="">Date</label>
                                    <input type="date" wire:model="attendance_date" id="attendance_date"
                                        class="form-control" />
                                </div>
                                <div class="col-md-1" style="padding-top:31px;">
                                    <button style="border-radius: 0px" class="btn btn-primary border-0">Filter</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                @if (isset($attendance) && $attendance->isNotEmpty())
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
