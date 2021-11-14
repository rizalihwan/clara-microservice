<?php

namespace App\Http\Livewire\Tweets;

use App\Models\Tweet;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $perPage = 5;

    public function loadMore()
    {
        $this->perPage += 5;
    }

    public function render()
    {
        return view('livewire.tweets.index', [
            'tweets' => Tweet::latest()->simplePaginate($this->perPage)
        ]);
    }
}
