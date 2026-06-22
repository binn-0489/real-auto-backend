@extends('layouts.main')
@section('content')
    <div>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Ad</th>
            </tr>
            </thead>
            <tbody>
            @foreach($chats as $chat)
                <tr>
                    <th scope="row">{{ $chat->id }}</th>
                    <td><a href="{{ route('chats.show', $chat->id) }}" target="_blank"> {{ $chat->seller->name }}</a></td>
                    <td scope="row">{{ $chat->seller->name }}</td> <!--условие если auth = seller то тут buyer-->
                    <td scope="row">{{ $chat->lastAd->brand->title }}</td>
                    
                </tr>

            @endforeach
            </tbody>
        </table>
    </div>
@endsection
