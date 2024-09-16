<x-commons.header />

<x-commons.preloader />

<x-commons.navbar />

<x-commons.sidebar />

<div class="content-wrapper">
    <x-commons.content-header title="Teachers List" />

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">

                        @if (Session::has('success'))
                            <x-extras.success-alert message="{{ Session::get('success') }}" />
                        @endif
                        
                        <div class="mt-4 mx-3 mb-3">
                            <a style="border-radius:0px;" class="btn btn-primary" href="/teacher/add"><i class="fas fa-plus" ></i> Add New Teacher</a>
                        </div>

                        <div class="card-body">
                            <table class="table" id="teachersTable" >
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>NAME</th>
                                        <th>USERNAME</th>
                                        <th>EMAIL</th>
                                        <th>ACTION</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($teachers as $teacher)
                                        <tr>
                                            <td>{{ $loop->index + 1 }}</td>
                                            <td>{{ $teacher->name }}</td>
                                            <td>{{ $teacher->username }}</td>
                                            <td>{{ $teacher->email }}</td>
                                            <td>
                                                <a class="btn btn-warning" href="/teacher/edit/{{ $teacher->id }}"><i class="fas fa-edit" ></i> </a>
                                                <a onclick="removeRecord(event, {{ $teacher->id }})" class="btn btn-danger" href="javascript:void(0)"><i class="fas fa-trash" ></i> </a>
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

    function removeRecord(event, id) {

        event.preventDefault()
        const userValue = prompt("Please write delete to permanaently delete this record.");
        if(userValue === "delete") {
            window.location.href = `/teacher/delete/${id}`
        }

        return false;

    }

</script>