<x-commons.header />

<x-commons.preloader />

<x-commons.navbar />

<!-- Main Sidebar Container -->

<x-commons.sidebar />

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    
    <!-- Content Header (Page header) -->
    <x-commons.content-header />
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
           
            <div class="row mb-5">
                <div class="col-md-12">
                    <a href="/feed/add" class="btn btn-success" >Add Feed</a>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">

                    @foreach ($feeds as $feed)
                        <div class="card">
                            
                            <div class="row">
                                <div class="col-md-12">
                                    <h3> {{ $feed->title }} </h3>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    {{ $feed->description }}
                                </div>
                            </div>

                            @if ($feed->user_id === auth()->user()->id)
                                <div class="row">
                                    <div class="col-md-12">
                                        <a href="/feed/edit/{{ $feed->id }}"><i class="fas fa-edit"></i></a>
                                        <a href="/feed/destroy/{{ $feed->id }}"><i class="fas fa-trash"></i></a>
                                    </div>
                                </div>
                            @endif
                
                        </div>
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