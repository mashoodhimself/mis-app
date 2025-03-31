<x-commons.header />

<x-commons.preloader />

<x-commons.navbar />

<x-commons.sidebar />

<div class="content-wrapper">

    <x-commons.content-header title="Edit Feed" />

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

                            <form action="/feed/edit" method="POST" enctype="multipart/form-data">

                                @csrf

                                <input type="hidden" name="feed_id" value="{{ $feed->id }}" />

                                <div class="row">
                                    <div class="col-md-12 mb-3">
                                        <input type="text" name="feed_title" class="form-control" value="{{ $feed->title ?? "" }}" />
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <textarea name="feed_desc" rows="12" cols="20"  class="form-control">{{ $feed->description ?? "" }}</textarea>
                                    </div>
                                </div>

                                <div class="row mb-3" >
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

</div>


<x-commons.footer />