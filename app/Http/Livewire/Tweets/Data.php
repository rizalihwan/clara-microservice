<?php

namespace App\Http\Livewire\Tweets;

use Livewire\Component;

class Data extends Component
{
    public $tweet;

    public function mount($tweet)
    {
        $this->tweet = $tweet;
    }

    public function render()
    {
        return view('livewire.tweets.data');
    }
}
