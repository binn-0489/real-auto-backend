@extends('layouts.main')
@section('content')
    <div>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Brand</th>
                <th scope="col">Model</th>
                <th scope="col">Year</th>
                <th scope="col">Price</th>
            </tr>
            </thead>
            <tbody>
            @foreach($ads as $ad)
                <tr>

                    <th scope="row">{{ $ad->id }}</th>
                    <td><a href="{{ route('ad.show', $ad->id) }}" target="_blank"> {{ $ad->brand->title }}</a></td>
                    <td>{{ $ad->model }}</td>
                    <td>{{ $ad->year }}</td>
                    <td>{{ $ad->price }}</td>

                </tr>
            @endforeach
            </tbody>
        </table>
        <div>
            {{ $ads->links() }}
        </div>
    </div>
@endsection
