<x-commons.header />

<x-commons.preloader />

<x-commons.navbar />
 
<!-- Main Sidebar Container -->

<x-commons.sidebar />

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    
    <!-- Content Header (Page header) -->
    <x-commons.content-header title="Annoucements" />
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
           
            <div class="row">
                <div class="col-md-12">

                    @foreach ($feeds as $feed)
                        <div class="container">
                            <div class="card shadow-sm">
                                <div class="card-body">
                                    <h4 class="card-title font-weight-bold text-primary">{{ $feed->title }}</h4>
                                    <p class="card-text text-muted">{{ $feed->description }}</p>
                                    <hr>
                                    <div class="mb-0 text-right text-secondary d-flex justify-content-between">
                                        @if(auth()->user()->role === 'admin')
                                            <div class="actionButtons">
                                                <a class="text-secondary" href="/feed/edit/{{ $feed->id }}"><i class="fas fa-edit"></i></a>
                                                <a onclick="if(confirm('Are you sure to delete this feed ?')){document.getElementById('feed-{{ $feed->id }}').submit();}" class="text-danger" href="javascript:void(0)"><i class="fas fa-trash"></i></a>
                                            </div>
                                        @endif
                                        <small>Posted by <strong>{{ $feed->user->name }}</strong></small>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <form id="feed-{{ $feed->id }}" method="POST" action="/feed/destroy/{{ $feed->id }}">
                            @csrf
                            @method('DELETE')
                        </form>

                    @endforeach

                </div>
            </div>

            <!-- /.row (main row) -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->


<x-commons.footer />