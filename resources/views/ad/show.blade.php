@extends('layouts.main')
@section('content')
    <div id="app">
        <test-component></test-component>
    </div>
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
                <tr>
                    <th scope="row">{{ $ad->id }}</th>
                    <td>{{ $ad->brand->title }}</td>
                    <td>{{ $ad->model }}</td>
                    <td>{{ $ad->year }}</td>
                    <td>{{ $ad->price }}</td>
                </tr>
            </tbody>
        </table>


        <div class="mt-4">
            <h4>Images:</h4>

            @foreach($ad->images as $image)
                <img src="{{ asset('storage/' . $image->path) }}" width="200">
            @endforeach
        </div>


        <div><a href=" {{ route('ad.index') }}" class="btn btn-info">back</a></div>
        <div><a href=" {{ route('createOrOpenChat', $ad) }}" class="btn btn-success">Chat</a></div>
        @auth
            @php
                $isFavorite = auth()->user()
                    ->favourites()
                    ->where('ads.id', $ad->id)
                    ->exists();
            @endphp
            @if(!$isFavorite)

                <form action="{{ route('addFav', $ad) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-danger">
                        Add to favorites
                    </button>
                </form>

            @else

                <form action="{{ route('remFav', $ad) }}" method="POST">
                    @csrf
                    @method('DELETE')

                    <button type="submit" class="btn btn-secondary">
                        Remove from favorites
                    </button>
                </form>

            @endif
        @endauth
        <!-- <div><a href=" {{ route('ad.edit', $ad->id) }}" class="btn btn-secondary">edit</a></div>
        <div>
            <form action="{{route('ad.delete', $ad->id)}}" method="post">
                @csrf
                @method('delete')
                <input type="submit" value="delete" class="btn btn-danger">
            </form>
        </div> -->
</div>
@endsection
