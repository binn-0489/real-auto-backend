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
