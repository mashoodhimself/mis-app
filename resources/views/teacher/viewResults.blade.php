<x-commons.header />

<x-commons.preloader />

<x-commons.navbar />

<x-commons.sidebar />

<div class="content-wrapper">

    <x-commons.content-header title="View Results" />

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
                                    <form action="/results/view" method="POST">
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

                            <table style="width:100%;" id="marks-table" class="table table-striped table-responsive">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>COURSE</th>
                                        <th>REG #</th>
                                        <th>STUDENT</th>
                                        <th>SESSIONAL</th>
                                        <th>MIDTERM</th>
                                        <th>FINAL</th>
                                        <th>FINAL SCORE</th>
                                        <th>NORMALIZED</th>
                                        <th>GRADE</th>
                                        <th>GPA</th>
                                        <th>CREATED AT</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (!empty($results))
                                        @foreach ($results as $resultItem)
                                            <tr>
                                                <td>{{ $resultItem->id }}</td>
                                                <td>{{ $resultItem->course->title }}</td>
                                                <td>{{ $resultItem->registration_no }}</td>
                                                <td>{{ App\Services\UserService::getStudentNameOnRegistrationNo($resultItem->registration_no) }}</td>
                                                <td>{{ $resultItem->sessional_marks }}</td>
                                                <td>{{ $resultItem->midterm_marks }}</td>
                                                <td>{{ $resultItem->final_marks }}</td>
                                                <td>{{ $resultItem->final_score }}</td>
                                                <td>{{ $resultItem->normalized_score }}</td>
                                                <td>{{ $resultItem->grade }}</td>
                                                <td>{{ $resultItem->gpa }}</td>
                                                <td>{{ date('d M Y', strtotime($resultItem->created_at)) }}</td>
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

    <x-modals.marksDetailViewModal />

</div>


<x-commons.footer />

<script>
    $(function() {
        $('#marks-table').DataTable();

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
                url: '/results/destroy',
                type: 'POST',
                data: formdata,
                processData: false, 
                contentType: false, 
                success: function(response) {
                    $('.message-box').text(response.message);
                    $('#marks-table').trigger('update');
                },
                error: function(error) {
                    $('.message-box').text(error);
                }
            });

    });

    });
</script>