<x-commons.header />

<x-commons.preloader />

<x-commons.navbar />

<x-commons.sidebar />

<div class="content-wrapper">

    <x-commons.content-header title="View Marks" />

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <table id="marks-table" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>COURSE</th>
                                        <th>REG #</th>
                                        <th>STUDENT NAME</th>
                                        <th>SESSIONAL MARKS</th>
                                        <th>MIDTERM MARKS</th>
                                        <th>CREATED AT</th>
                                        <th>ACTION</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (!empty($marks))
                                        @foreach ($marks as $marksItem)
                                            <tr>
                                                <td>{{ $marksItem->id }}</td>
                                                <td>{{ $marksItem->course->title }}</td>
                                                <td>{{ $marksItem->registration_no }}</td>
                                                <td>{{ App\Services\UserService::getStudentNameOnRegistrationNo($marksItem->registration_no) }}</td>
                                                <td>{{ $marksItem->final_sessional_marks }}</td>
                                                <td>{{ $marksItem->mid_term_marks }}</td>
                                                <td>{{ date('d M Y', strtotime($marksItem->created_at)) }}</td>
                                                <td>
                                                    <button data-markId="{{ $marksItem->id }}" type="button" class="btn btn-secondary btn-sm viewMarksModal"> <i class="fas fa-eye" ></i> </button>
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

    <x-modals.marksDetailViewModal />

</div>


<x-commons.footer />

<script>
    $(function() {
        $('#marks-table').DataTable();

        $('.viewMarksModal').on('click', function() {
            let markId = $(this).data('markid');

            let formdata = new FormData();
            formdata.append('markId', markId);
            formdata.append('_token', '{{ csrf_token() }}');

            $.ajax({
                url: '/marks/detail',
                type: 'POST',
                data: formdata,
                processData: false,  // Important for FormData
                contentType: false,  // Important for FormData
                success: function(response) {
                    let marksObject = JSON.parse(response);
                    Object.entries(marksObject).forEach(([key, value]) => {
                        if (key === 'quizes_marks') {
                            let quizRow = '';
                            value.forEach((quiz, index) => {
                                quizRow += `<td>${quiz}</td>`;
                            });
                            $('#quiz-table tbody').html(`<tr>${quizRow}</tr>`);
                        } else if (key === 'assignment_marks') {
                            let assignmentRow = '';
                            value.forEach((assignment, index) => {
                                assignmentRow += `<td>${assignment}</td>`;
                            });
                            $('#assignment-table tbody').html(`<tr>${assignmentRow}</tr>`);
                        } else if (key === 'class_marks') {
                            let classPerformanceRow = '';
                            value.forEach((classPerformance, index) => {
                                classPerformanceRow += `<td>${classPerformance}</td>`;
                            });
                            $('#class-performance tbody').html(`<tr>${classPerformanceRow}</tr>`);
                        }
                    
                });
            },
            complete: function() {
                $('#marksDetailViewModal').modal('show');
            }
        });

    });

    });
</script>