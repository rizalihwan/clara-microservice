@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h3>COVID-19 Information(Global Data)</h3>
                <hr>
                <div>
                    <span>{{ $data['positive']['name'] . ' : ' . $data['positive']['value'] }} âšī¸</span>
                </div>
                <div>
                    <span>{{ $data['healed']['name'] . ' : ' . $data['healed']['value'] }} đ</span>
                </div>
                <div>
                    <span>{{ $data['die']['name'] . ' : ' . $data['die']['value'] }} đ­</span>
                </div>
            </div>
            <div class="col-md-6">
                <h3>COVID-19 Information(Indonesia)</h3>
                <hr>
                <div>
                    <span>Total Positif : {{ $data['indonesia'][0]->positif }} âšī¸</span>
                </div>
                <div>
                    <span>Total Sembuh : {{ $data['indonesia'][0]->sembuh }} đ</span>
                </div>
                <div>
                    <span>Total Meninggal : {{ $data['indonesia'][0]->meninggal }} đ­</span>
                </div>
            </div>
        </div>
    </div>
@endsection
