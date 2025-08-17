<div class="content">
        <x-commons.content-header title="Courses List" />
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">

                        @if (Session::has('success'))
                            <x-extras.success-alert message="{{ Session::get('success') }}" />
                        @endif

                        <div class="mt-4 mx-3 mb-3">
                            <a style="border-radius:0px;" class="btn btn-primary" href="{{ route('admin.course.add') }}" wire:navigate ><i class="fas fa-plus" ></i> Add New Course</a>
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
                                    <tr wire:key="course-{{ $course->id }}" >
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>{{ $course->title }}</td>
                                        <td>{{ $course->code }}</td>
                                        <td>{{ $course->credit }}</td>
                                        <td>
                                            <a class="btn btn-warning" href="{{ route('admin.course.update', $course->id) }}" wire:navigate><i class="fas fa-edit" ></i> </a>
                                            <a wire:click="confirmDelete({{ $course->id }})" class="btn btn-danger" href="javascript:void(0)"><i class="fas fa-trash" ></i> </a>
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

    @push('scripts')

        <script>
            Livewire.on('delete-course-confirmation', id => {
                Swal.fire({
                    title: 'Are you sure?',
                    text: "This action cannot be undone!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        Livewire.dispatch('confirmDelete', id);
                    }
                });
            });
        </script>

    @endpush