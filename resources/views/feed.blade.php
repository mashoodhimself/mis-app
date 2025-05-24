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
                                    <p class="mb-0 text-right text-secondary">
                                        <small>Posted by <strong>{{ $feed->user->name }}</strong></small>
                                    </p>
                                </div>
                            </div>
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