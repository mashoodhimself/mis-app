<div class="content">
    <x-commons.content-header title="Update User" />
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">

                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    <div class="mt-4 mx-3 mb-3">
                        <a style="border-radius:0px;" class="btn btn-primary" wire:navigate
                            href="{{ route('admin.users') }}"><i class="fas fa-plus"></i> Back</a>
                    </div>

                    <div class="card-body">

                        <form wire:submit.prevent="update">

                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <input type="text" wire:model="name" id="name" class="form-control"
                                        value="{{ $user->name }}" placeholder="Full name">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <input type="text" wire:model="username" id="username" class="form-control"
                                        value="{{ $user->username }}" placeholder="Username">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <input type="email" wire:model="email" id="email" class="form-control"
                                        value="{{ $user->email }}" placeholder="Email Address">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <select wire:model.live="role" id="role" class="form-control">
                                        <option value="teacher">Teacher</option>
                                        <option value="student">Student</option>
                                    </select>
                                </div>
                            </div>
                            @if ($isStudent === true)
                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <input type="text" class="form-control" wire:model="registration_no"
                                            id="registration_no" placeholder="Registration No">
                                        @error('registration_no')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <select wire:model="semester" id="semester" class="form-control">
                                            <option value="1st">1st</option>
                                            <option value="2nd">2nd</option>
                                            <option value="3rd">3rd</option>
                                            <option value="4th">4th</option>
                                            <option value="5th">5th</option>
                                            <option value="6th">6th</option>
                                            <option value="7th">7th</option>
                                            <option value="8th">8th</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <select wire:model="section" id="section" class="form-control">
                                            <option value="A">A</option>
                                            <option value="B">B</option>
                                        </select>
                                    </div>
                                </div>
                            @endif
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <button style="border-radius: 0px" class="btn btn-primary border-0">Update</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
