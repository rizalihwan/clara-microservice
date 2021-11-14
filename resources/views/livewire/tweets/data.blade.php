<div>
    <h5 class="mb-0">{{ $tweet->user->name }}</h5>
    <small class="text-secondary">{{ $tweet->created_at->diffForHumans() }}</small>
    <p>{{ $tweet->body }}</p>
</div>
