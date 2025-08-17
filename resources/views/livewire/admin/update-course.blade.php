<div class="content">
    <x-commons.content-header title="Update Course" />
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">

                    @if (Session::has('success'))
                        <x-extras.success-alert message="{{ Session::get('success') }}" />
                    @endif

                    @if (Session::has('error'))
                        <x-extras.error-alert message="{{ Session::get('success') }}" />
                    @endif

                    <div class="mt-4 mx-3 mb-3">
                        <a style="border-radius:0px;" class="btn btn-primary" href="{{ route('admin.courses') }}" wire:navigate><i class="fas fa-plus"></i>
                            Back</a>
                    </div>

                    <div class="card-body">
                        <form wire:submit.prevent="update">
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <label for="">Course Title</label>
                                    <input type="text" wire:model="title" id="title" class="form-control"
                                         placeholder="Course title">
                                    @error('title')
                                        <small class="text-danger" >{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <label for="">Course Code</label>
                                    <input type="text" wire:model="code" id="code" class="form-control"
                                         placeholder="Course Code">
                                    @error('code')
                                        <small class="text-danger" >{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <label for="">Course Credits</label>
                                    <input type="number" wire:model="credit" id="credit" class="form-control"
                                        placeholder="Credit Hr">
                                    @error('credit')
                                        <small class="text-danger" >{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <label for="user_id">Teach By</label>
                                    <select wire:model="user_id" id="user_id" class="form-control">
                                        <option selected value="0">Select Teacher</option>
                                        @foreach (\App\Services\UserService::getAllActiveTeachers() as $teacher)
                                            <option value="{{ $teacher->id }}">{{ $teacher->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
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
