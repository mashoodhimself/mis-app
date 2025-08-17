<div class="content">
    <x-commons.content-header title="Student Marks" />
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
                                            <option value="{{ $course->id }}">{{ $course->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-1" style="padding-top:31px;">
                                    <button style="border-radius: 0px" class="btn btn-primary border-0">Filter</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                @if (isset($results) && $results->isNotEmpty())
                    <div class="card">
                        <table id="student-attendance" class="table table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Registration No</th>
                                    <th>Sessional Marks</th>
                                    <th>MidTerm Marks</th>
                                    <th>Final Marks</th>
                                    <th>Final Score</th>
                                    <th>Normalized Score</th>
                                    <th>Grade</th>
                                    <th>GPA</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($results as $result)
                                    <tr wire:key="mark-{{ $result->id }}">
                                        <td>{{ $result->id }}</td>
                                        <td>{{ $result->registration_no }}</td>
                                        <td>{{ $result->sessional_marks }}</td>
                                        <td>{{ $result->midterm_marks }}</td>
                                        <td>{{ $result->final_marks }}</td>
                                        <td>{{ $result->final_score }}</td>
                                        <td>{{ $result->normalized_score }}</td>
                                        <td>{{ $result->grade }}</td>
                                        <td>{{ $result->gpa }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                @endif
            </div>
        </div>
    </div>

</div>
