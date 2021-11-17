@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h3>
                List Surah
            </h3>
        </div>
        <div class="row">
            <div class="col-md-6">
                <table class="table table-light">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $item)
                            <tr>
                                <th>{{ $item['id'] }}</th>
                                <td>{{ $item['name'] . ' (' . $item['id_name'] . ') ' }}</td>
                                <td>
                                    <a href="{{ route('sites.detail', $item['id']) }}"
                                        class="btn btn-sm btn-info mb-1">Detail Surah</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{-- {{ $data->links() }} --}}
            </div>
        </div>
    </div>
@endsection
