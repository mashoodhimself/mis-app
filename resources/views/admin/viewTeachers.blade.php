<x-commons.header />

<x-commons.preloader />

<x-commons.navbar />

<x-commons.sidebar />

<div class="content-wrapper">
    <x-commons.content-header title="Users List" />
    <livewire:admin.view-user />
</div>


<x-commons.footer />

<script>
    $(function() {
        $('#teachersTable').DataTable();
    })

    function removeRecord(event, id) {

        event.preventDefault()
        const userValue = prompt("Please write delete to permanaently delete this record.");
        if(userValue === "delete") {
            window.location.href = `/teacher/delete/${id}`
        }

        return false;

    }

</script>