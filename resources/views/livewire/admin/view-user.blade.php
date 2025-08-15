<div class="content">
        <x-commons.content-header title="Users List" />
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">

                        @if (Session::has('success'))
                            <x-extras.success-alert message="{{ Session::get('success') }}" />
                        @endif
                        
                        <div class="mt-4 mx-3 mb-3">
                            <a style="border-radius:0px;" class="btn btn-primary" wire:navigate href="{{ route('admin.user.add') }}"><i class="fas fa-plus" ></i> Add New User</a>
                        </div>

                        <div class="card-body">
                            <table class="table" id="teachersTable" >
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>NAME</th>
                                        <th>USERNAME</th>
                                        <th>EMAIL</th>
                                        <th>Role</th>
                                        <th>ACTION</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                        <tr wire:key="user-{{ $user->id }}" >
                                            <td>{{ $loop->index + 1 }}</td>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->username }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->role }}</td>
                                            <td>
                                                <a class="btn btn-warning" wire:navigate href="{{ route('admin.update.user', $user->id) }}"><i class="fas fa-edit" ></i> </a>
                                                <a wire:click.prevent="confirmDelete({{ $user->id }})" class="btn btn-danger" href="javascript:void(0)"><i class="fas fa-trash" ></i> </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            {{ $users->links() }}

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            Livewire.on('show-delete-confirmation', id => {

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

