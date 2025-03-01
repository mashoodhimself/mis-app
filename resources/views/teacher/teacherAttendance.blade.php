<x-commons.header />

<x-commons.preloader />

<x-commons.navbar />

<x-commons.sidebar />

<div class="content-wrapper">

    <x-commons.content-header title="Punch Attendance" />

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

                            <div class="row mt-5">
                                <div class="col-md-12 text-center fa-2x current-date-slot">
                                    {{ $formattedCurrentDate }}
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-md-12 text-center">
                                    <button class="btn btn-success" {{ $isPunchedIn ? "disabled" : "" }}  id="punch_in_btn">Punch In</button>
                                    <button class="btn btn-danger"  {{ $isPunchedIn && !$isPunchedOut ? "" : "disabled" }} id="punch_out_btn">Punch Out</button>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12 text-success text-center mt-3">
                                    {{ $isPunchedIn ? "You have already marked your attendance for today." : "" }}
                                </div>
                            </div>

                            <div class="row mt-4">
                                <div class="col-md-12 mt-5">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Date</th>
                                                <th>Punch In</th>
                                                <th>Punch Out</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            @if (count($attendanceRecords) == 0)
                                                <tr>
                                                    <td colspan="5" class="text-center">No attendance records found.</td>
                                                </tr>
                                            @else
                                                @foreach ($attendanceRecords as $attendanceRecord)
                                                    <tr>
                                                        <td>{{ $loop->index + 1 }}</td>
                                                        <td>{{ date('d M Y', strtotime($attendanceRecord->attendance_date)) }}</td>
                                                        <td>{{ date('h:i A', strtotime($attendanceRecord->punch_in)) }}</td>
                                                        <td>{{ date('h:i A', strtotime($attendanceRecord->punch_out)) }}</td>
                                                        <td>{{ $attendanceRecord->status ?: "-" }}</td>
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
        </div>
    </div>

</div>


<x-commons.footer />

<script>
    $(document).ready(function() {

        setInterval(() => {
            $('.current-date-slot').text(getCurrentDateWithTime());
        }, 60000);

        function getCurrentDateWithTime() {

            const options = {
                year: 'numeric',
                month: 'long',
                day: 'numeric',
                hour: '2-digit',
                minute: '2-digit',
                hour12: true
            };

            return new Date().toLocaleString('en-US', options);
        }

        $('#punch_in_btn').on('click', function() {

            let currentDate = getCurrentDateWithTime();
            let formdata = new FormData();
            formdata.append('current_date', currentDate);
            formdata.append('punch_mode', 'punch_in');
            formdata.append('_token', '{{ csrf_token() }}');

            sendAjaxRequest("/attendance/teacher", formdata, function(response) {
                if (response.status == true) {
                    location.reload();
                } else {
                    console.log(response)
                }
            });

        });

        $('#punch_out_btn').on('click', function() {

            let currentDate = getCurrentDateWithTime();
            let formdata = new FormData();
            formdata.append('current_date', currentDate);
            formdata.append('punch_mode', 'punch_out');
            formdata.append('_token', '{{ csrf_token() }}');

            sendAjaxRequest("/attendance/teacher", formdata, function(response) {
                if (response.status == true) {
                    location.reload();
                } else {
                    console.log(response)
                }
            });

        });

        function sendAjaxRequest(url, data, callback) {
            $.ajax({
                url: url,
                type: 'POST',
                data: data,
                processData: false,
                contentType: false,
                success: function(response) {
                    callback(response);
                },
                error: function(error) {
                    console.log(error);
                }
            });
        }


    });
</script>