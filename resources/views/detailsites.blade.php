@extends('layouts.app')

@push('style')
    <style>
        .input-text-border {
            background: transparent;
            border: 0 0 2px 0;
            border-bottom: 2px solid blue;
            border-radius: 5px;
            padding: 30px;
        }

        .green-text {
            color: rgb(167, 228, 76);
        }

    </style>
@endpush
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="surah">*Nama Surah</label>
                    <marquee scrollamount="10" name="surah" class="form-control input-text-border text-center green-text"
                        id="surah">{{ $data['name'] . ' (' . $data['id_name'] . ') ' }}</marquee>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="surah">*Tafsir</label>
                    <textarea name="tafsir" class="form-control input-text-border" id="surah" cols="30" rows="10" readonly>{{ $data['tafsir'] }}</textarea>
                </div>
            </div>
        </div>
    </div>
@endsection
