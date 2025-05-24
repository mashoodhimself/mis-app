<x-commons.header />

<x-commons.preloader />

<x-commons.navbar />

<x-commons.sidebar />

<div class="content-wrapper">

    <x-commons.content-header title="Courses List" />

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <table class="table table-striped" >
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Title</th>
                                    <th>Code</th>
                                    <th>Credit</th>
                                    <th>Upload</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($courses->teacherCourses->isNotEmpty())
                                    @foreach ($courses->teacherCourses as $assignedCourse)

                                        @php
                                            $attendanceCount = \App\Models\Attendance::where('course_id', $assignedCourse->course->id)->count();
                                            $marksCount = \App\Models\Mark::where('course_id', $assignedCourse->course->id)->count();
                                            $resultsCount = \App\Models\Result::where('course_id', $assignedCourse->course->id)->count();
                                        @endphp

                                        <tr>
                                            <td>{{ $assignedCourse->course->id }}</td>
                                            <td>{{ $assignedCourse->course->title }}</td>
                                            <td>{{ $assignedCourse->course->code }}</td>
                                            <td>{{ $assignedCourse->course->credit }}</td>
                                            <td>

                                                @if ($attendanceCount)
                                                    <a class="trash-btn" data-ref="attendance-{{ $assignedCourse->course->id }}" title="Delete Attendance" href="javascript:void(0)"><i class="fas fa-user text-danger"></i></a> |
                                                @else
                                                    <a title="Upload Attendance" href="/attendance/upload/{{ $assignedCourse->course->id }}"><i class="fas fa-user"></i></a> |
                                                @endif

                                                @if ($marksCount)
                                                    <a class="trash-btn" data-ref="marks-{{ $assignedCourse->course->id }}" title="Delete Marks" href="javascript:void(0)"><i class="fas fa-marker text-danger"></i></a> |
                                                @else
                                                    <a title="Upload Marks" href="/marks/upload/{{ $assignedCourse->course->id }}"><i class="fas fa-marker"></i></a> |
                                                @endif

                                                @if ($resultsCount)
                                                    <a class="trash-btn" data-ref="results-{{ $assignedCourse->course->id }}" title="Delete Results" href="javascript:void(0)"><i class="fas fa-poll text-danger"></i></a>
                                                @else
                                                    <a title="Upload Results" href="/results/upload/{{ $assignedCourse->course->id }}"><i class="fas fa-poll"></i></a>
                                                @endif

                                            </td>
                                            <td>
                                                <div class="dropdown">
                                                    <button class="btn btn-sm btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">View</button>
                                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                        
                                                        @if ($attendanceCount)
                                                            <a class="dropdown-item" href="/attendance/view/{{ $assignedCourse->course->id }}">Attendance</a>
                                                        @endif

                                                        @if ($marksCount)
                                                            <a class="dropdown-item" href="/marks/view/{{ $assignedCourse->course->id }}">Marks</a>
                                                        @endif

                                                        @if ($resultsCount)
                                                            <a class="dropdown-item" href="/results/view/{{ $assignedCourse->course->id }}">Results</a>
                                                            <a class="dropdown-item" href="/results/graph/{{ $assignedCourse->course->id }}">Distribution Graph</a>
                                                        @endif

                                                        @if (!$attendanceCount && !$marksCount && !$resultsCount)
                                                            <a class="dropdown-item" href="javascript:void(0)">No Records View</a>
                                                        @endif
                                                        
                                                    </div>
                                                </div>
                                            </td>
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


<x-commons.footer />

<script>
    $(function() {

        $('.trash-btn').on('click', function(event) {

            let [ mode, courseId ] = ($(this).data('ref')).split('-'); 

            if(!confirm(`Are you sure to delete this course ${mode}`)) {
                return false;
            }
            
            let urls = {
                'attendance': '/attendance/destroy',
                'marks': '/marks/destroy',
                'results': '/results/destroy',
            }

            let formdata = new FormData();
            formdata.append('courseId', courseId);
            formdata.append('_token', '{{ csrf_token() }}');

            $.ajax({
                url: urls[mode],
                type: 'POST',
                data: formdata,
                processData: false, 
                contentType: false, 
                success: function(response) {
                    window.location.href = "/teacher/course";
                },
                error: function(error) {
                    $('.message-box').text(error);
                }
            });

        });

    })
</script>