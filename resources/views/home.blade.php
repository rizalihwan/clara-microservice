@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h3>COVID-19 Information(Global Data)</h3>
                <hr>
                <div>
                    <span>{{ $data['positive']['name'] . ' : ' . $data['positive']['value'] }} ☹️</span>
                </div>
                <div>
                    <span>{{ $data['healed']['name'] . ' : ' . $data['healed']['value'] }} 😊</span>
                </div>
                <div>
                    <span>{{ $data['die']['name'] . ' : ' . $data['die']['value'] }} 😭</span>
                </div>
            </div>
            <div class="col-md-6">
                <h3>COVID-19 Information(Indonesia)</h3>
                <hr>
                <div>
                    <span>Total Positif : {{ $data['indonesia'][0]->positif }} ☹️</span>
                </div>
                <div>
                    <span>Total Sembuh : {{ $data['indonesia'][0]->sembuh }} 😊</span>
                </div>
                <div>
                    <span>Total Meninggal : {{ $data['indonesia'][0]->meninggal }} 😭</span>
                </div>
            </div>
        </div>
    </div>
@endsection
