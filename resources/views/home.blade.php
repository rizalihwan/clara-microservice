@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                @livewire('tweets.index')
            </div>
        </div>
    </div>
@endsection
