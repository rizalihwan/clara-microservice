<div>
    <div class="card">
        <div class="card-header">
            Timeline
        </div>
        <div class="media">
            <div class="media-body">
                @foreach ($tweets as $tweet)
                    <div class="card-body">
                        <livewire:tweets.data :key="$tweet->id" :tweet="$tweet">
                    </div>
                    <hr class="my-2">
                @endforeach
            </div>
        </div>
        @if ($tweets->hasMorePages())
            <button type="submit" class="btn btn-primary" wire:click='loadMore'>Load More...</button>
        @endif
    </div>
</div>
