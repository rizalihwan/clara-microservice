@extends('layouts.app')

@section('content')
    <div class="container">
        @foreach ($data as $item)
            <div class="row">
                <h4>Nama Provinsi : {{ $item->attributes->Provinsi }}</h4>
                <p>Positif : {{ $item->attributes->Kasus_Posi }}</p>
                <p>Sembuh : {{ $item->attributes->Kasus_Semb }}</p>
                <p>Meninggal : {{ $item->attributes->Kasus_Meni }}</p>
                <hr>
            </div>
        @endforeach
    </div>
@endsection
