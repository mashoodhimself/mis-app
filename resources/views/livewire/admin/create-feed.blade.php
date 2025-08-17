<div class="content">
    <x-commons.content-header title="Create Annoucement" />
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

                        <form wire:submit.prevent="save">

                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <input type="text" wire:model="feed_title" class="form-control"
                                        placeholder="Enter title here." />
                                    @error('feed_title')
                                        <small class="text-danger" >{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <textarea wire:model="feed_desc" id="feed_desc" rows="12" cols="20" class="form-control"
                                        placeholder="Enter description here.."></textarea>
                                    @error('feed_desc')
                                        <small class="text-danger" >{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <input type="file" class="form-control" wire:model="feed_file">
                                    @error('feed_file')
                                        <small class="text-danger" >{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <button style="border-radius: 0px" class="btn btn-primary border-0">Create</button>
                                </div>
                            </div>


                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

