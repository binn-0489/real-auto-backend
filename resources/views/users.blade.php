@extends('layouts.main')
@section('content')
    <div>
        @foreach($users as $user)
            <div>{{$user->name}}</div>
        @endforeach
    </div>
@endsection
