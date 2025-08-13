<x-commons.header />

{{-- <x-commons.preloader /> --}}

<x-commons.navbar />

<x-commons.sidebar />

    <main class="content-wrapper">
        <x-commons.content-header title="Add New Teacher" />
        {{ $slot }}
    </main>

<x-commons.footer />
