@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" name="title" class="form-control" readonly id="title" value="{{ $data->title }}">
                </div>
            </div>
        </div>
    </div>
@endsection
