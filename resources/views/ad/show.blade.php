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
                <tr>
                    <th scope="row">{{ $ad->id }}</th>
                    <td>{{ $ad->brand->title }}</td>
                    <td>{{ $ad->model }}</td>
                    <td>{{ $ad->year }}</td>
                    <td>{{ $ad->price }}</td>
                </tr>
            </tbody>
        </table>
        <div><a href=" {{ route('ad.index') }}" class="btn btn-info">back</a></div>
        <div><a href=" {{ route('ad.edit', $ad->id) }}" class="btn btn-secondary">edit</a></div>
        <div>
            <form action="{{route('ad.delete', $ad->id)}}" method="post">
                @csrf
                @method('delete')
                <input type="submit" value="delete" class="btn btn-danger">
            </form>
        </div>
    </div>
@endsection
