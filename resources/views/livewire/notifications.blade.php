<div>
    @foreach ($notifications as $notification)
        <a href="#" class="dropdown-item">
            <i class="fas fa-envelope mr-2"></i> {{ $notification['message']['message'] }}
            <span class="float-right text-muted text-sm">3 mins</span>
        </a>
    @endforeach

    <div class="dropdown-divider"></div>
</div>
