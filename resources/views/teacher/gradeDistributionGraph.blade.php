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

            let course_id = "{{ $course_id }}";

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

</script>
