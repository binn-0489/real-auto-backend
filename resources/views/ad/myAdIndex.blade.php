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
                <th scope="col"></th>
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
                    <td>
                        <div><a href=" {{ route('ad.edit', $ad->id) }}" class="btn btn-secondary">edit</a></div>
                        <div>
                            <form action="{{route('ad.delete', $ad->id)}}" method="post">
                                @csrf
                                @method('delete')
                                <input type="submit" value="delete" class="btn btn-danger">
                            </form>
                        </div>
                    </td>

                    <div class="mt-4">
                        @foreach($ad->images as $image)
                            @if($image->is_main)
                                <img src="{{ asset('storage/' . $image->path) }}" width="100">
                                @break;
                            @endif
                        @endforeach
                    </div>
                </tr>

            @endforeach
            </tbody>
        </table>
        <div>
            {{ $ads->links() }}
        </div>
    </div>
@endsection
