<x-commons.header />

<x-commons.preloader />

<x-commons.navbar />

<x-commons.sidebar />

<div class="content-wrapper">

    <x-commons.content-header title="Grade Distribution Graph" />

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">

                        @if (session('success'))
                            <x-extras.success-alert :message="session('success')" />
                        @endif

                        @if (session('error'))
                            <x-extras.error-alert :message="session('error')" />
                        @endif

                        <div class="card-body">

                            <form action="javascript:void(0)" method="POST">

                                @csrf

                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <label>Course</label>
                                        <select class="form-control" name="course_id" id="course_id">
                                            <option selected disabled>Select Course</option>
                                            @if (!empty($courses))
                                                @foreach ($courses as $courseItem)
                                                    <option {{ !empty($course_id) && $course_id === $courseItem->id ? 'selected' : '' }} value="{{ $courseItem->id }}"> {{ $courseItem->title }} </option>
                                                @endforeach
                                            @endif
                                        </select>
                                        @error('course_id')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <button id="view_graph" class="btn btn-primary" > View Graph </button>
                                    </div>
                                </div>

                            </form>

                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <canvas id="gradeDistributionGraphCanvas"></canvas>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<x-commons.footer />

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>

    $(document).ready(function() {
        
        $('#view_graph').click(function(event) {

            event.preventDefault();

            let course_id = $('#course_id').val();

            if (course_id === null) {
                alert('Please select a course');
                return;
            }

            $.ajax({
                url: '/results/graph',
                type: 'POST',
                data: {
                    course_id: course_id,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    
                    let parsedResponse = JSON.parse(response);
                    let ctx = document.getElementById('gradeDistributionGraphCanvas');
                    let myChart = new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: parsedResponse.labels,
                            datasets: [{
                                label: '# of Students',
                                data: parsedResponse.values,
                                borderWidth: 1
                            }]
                        },
                        options: {
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            }
                        }
                    });
                }
            });
        });

    });

</script>

<script>
//     const ctx = document.getElementById('gradeDistributionGraphCanvas');

// new Chart(ctx, {
//   type: 'bar',
//   data: {
//     labels: ['A', 'A-', 'B+', 'B', 'B-', 'C+', 'C', 'C-', 'D+', 'D', 'F'],
//     datasets: [{
//       label: '# of Students',
//       data: [12, 30, 3, 5, 2, 3],
//       borderWidth: 1
//     }]
//   },
//   options: {
//     scales: {
//       y: {
//         beginAtZero: true
//       }
//     }
//   }
// });
</script>