@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="surah">Nama Surah</label>
                    <input type="text" name="surah" class="form-control" readonly id="surah" value="{{ $data['name'] . ' (' . $data['id_name'] . ') ' }}">
                </div>
            </div>
        </div>
    </div>
@endsection
