<x-commons.header />

<x-commons.preloader />

<x-commons.navbar />

<x-commons.sidebar />

<div class="content-wrapper">
    <x-commons.content-header title="Add New Course" />

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        
                        <div class="mt-4 mx-3 mb-3">
                            <a style="border-radius:0px;" class="btn btn-primary" href="/courses"><i class="fas fa-plus" ></i> Back</a>
                        </div>

                        <div class="card-body">
                            <form action="/course/add" method="POST">

                                @csrf

                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <input type="text" name="title" id="title" class="form-control" placeholder="Course title">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <input type="text" name="code" id="code" class="form-control" placeholder="Course Code">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <input type="number" name="credit" id="credit" class="form-control" placeholder="Credit Hr">
                                    </div>
                                </div>
                                <div class="row mb-3" >
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

</div>


<x-commons.footer />

<script>
    $(function() {
        $('#teachersTable').DataTable();
    })
</script>