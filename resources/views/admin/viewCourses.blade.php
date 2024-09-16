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

                        @if (Session::has('success'))
                            <x-extras.success-alert message="{{ Session::get('success') }}" />
                        @endif
                        
                        <div class="mt-4 mx-3 mb-3">
                            <a style="border-radius:0px;" class="btn btn-primary" href="/course/add"><i class="fas fa-plus" ></i> Add New Course</a>
                        </div>

                        <div class="card-body">


                            <table class="table" id="teachersTable" >
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Course</th>
                                        <th>Code</th>
                                        <th>Credit Hrs</th>
                                        <th>ACTION</th>
                                    </tr>
                                </thead>
                                <tbody>
                                  @foreach ($courses as $course)
                                    <tr>
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>{{ $course->title }}</td>
                                        <td>{{ $course->code }}</td>
                                        <td>{{ $course->credit }}</td>
                                        <td>
                                            <a class="btn btn-warning" href="/course/edit/{{$course->id}}"><i class="fas fa-edit" ></i> </a>
                                            <a onclick="deleteRecord(event, {{ $course->id }})" class="btn btn-danger" href="javascript:void(0)"><i class="fas fa-trash" ></i> </a>
                                        </td>
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

<script>
    $(function() {
        $('#teachersTable').DataTable();
    })

    function deleteRecord(event, id) {
        
        event.preventDefault()

        const userValue = prompt("Please type delete to remove this record!");

        if(userValue === "delete") {
            window.location.href = `/course/delete/${id}`
        }

        return false;

    }

</script>