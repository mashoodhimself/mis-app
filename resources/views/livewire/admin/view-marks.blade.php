<div x-data="{ open: false }" x-on:open-mark-modal.window="open = true" x-on:close-mark-modal.window="open = false"
    class="content">
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

                @if (isset($marks) && $marks->isNotEmpty())
                    <div class="card">
                        <table id="student-attendance" class="table table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Registration No</th>
                                    <th>Total Marks</th>
                                    <th>Sessional Marks</th>
                                    <th>MidTerm Marks</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($marks as $mark)
                                    <tr wire:key="mark-{{ $mark->id }}">
                                        <td>{{ $mark->id }}</td>
                                        <td>{{ $mark->registration_no }}</td>
                                        <td>{{ $mark->total_marks }}</td>
                                        <td>{{ $mark->final_sessional_marks }}</td>
                                        <td>{{ $mark->mid_term_marks }}</td>
                                        <td><button wire:click="showMarkDetail({{ $mark->id }})"
                                                class="btn btn-sm btn-primary">Details</button></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <!-- Alpine Modal -->
                            <div x-show="open" x-transition
                                class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center"
                                style="display: none;">
                                <div class="bg-white rounded-lg shadow-lg w-1/2">
                                    <!-- Header -->
                                    <div class="flex justify-between items-center border-b p-4">
                                        <h5 class="font-semibold">Mark Details</h5>
                                    </div>

                                    <!-- Body -->
                                    <div class="p-4">

                                        @if (is_array($quizMarks) && !empty($quizMarks))
                                            <div>
                                                <strong> Quizes </strong>
                                                <table class="table table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th>Quiz 01</th>
                                                            <th>Quiz 02</th>
                                                            <th>Quiz 03</th>
                                                            <th>Quiz 04</th>
                                                            <th>Quiz 05</th>
                                                            <th>Quiz 06</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>{{ $quizMarks[0] }}</td>
                                                            <td>{{ $quizMarks[1] }}</td>
                                                            <td>{{ $quizMarks[2] }}</td>
                                                            <td>{{ $quizMarks[3] }}</td>
                                                            <td>{{ $quizMarks[4] }}</td>
                                                            <td>{{ $quizMarks[5] }}</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        @endif

                                        @if (is_array($assignmentMarks) && !empty($assignmentMarks))
                                            <div class="mt-3">
                                                <strong> Assignments </strong>
                                                <table class="table table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th>Assignment 01</th>
                                                            <th>Assignment 02</th>
                                                            <th>Assignment 03</th>
                                                            <th>Assignment 04</th>
                                                            <th>Assignment 05</th>
                                                            <th>Assignment 06</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>{{ $assignmentMarks[0] }}</td>
                                                            <td>{{ $assignmentMarks[1] }}</td>
                                                            <td>{{ $assignmentMarks[2] }}</td>
                                                            <td>{{ $assignmentMarks[3] }}</td>
                                                            <td>{{ $assignmentMarks[4] }}</td>
                                                            <td>{{ $assignmentMarks[5] }}</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        @endif

                                        @if (is_array($classMarks) && !empty($classMarks))
                                            <div class="mt-3">
                                                <strong> Class Marks </strong>
                                                <table class="table table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th>Class 01</th>
                                                            <th>Class 02</th>
                                                            <th>Class 03</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>{{ $classMarks[0] }}</td>
                                                            <td>{{ $classMarks[1] }}</td>
                                                            <td>{{ $classMarks[2] }}</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        @endif


                                    </div>

                                    <!-- Footer -->
                                    <div class="flex justify-end border-t p-4">
                                        <button class="btn btn-secondary" @click="open = false">Close</button>
                                    </div>
                                </div>
                            </div>

                @endif
            </div>
        </div>
    </div>

</div>
