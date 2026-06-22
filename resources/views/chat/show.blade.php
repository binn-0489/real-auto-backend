@extends('layouts.main')
@section('content')
<div class="container py-4" style="max-width: 800px;">
    <div class="card shadow">
        {{-- Header --}}
        <div class="card-header bg-primary text-white">
            <h5 class="mb-1">{{ $chat->seller->name }}</h5>
            <small>
                <a href="{{ route('ad.show', $chat->lastAd) }}" class="text-white text-decoration-underline">{{ $chat->lastAd?->brand?->title }}</a>
            </small>
        </div>

        {{-- Messages --}}
        <div class="card-body" style="height: 500px; overflow-y: auto;" id="messagesArea">
            @foreach($chat->messages as $message)
                <div class="d-flex justify-content-start mb-3">
                    <div class="bg-white border rounded p-2 shadow-sm" style="max-width: 70%;">
                        <div>{{ $message->message }}</div>
                        <small class="text-muted">
                            {{ $message->user->name }} {{ $message->sent_at }} 
                            @if($message->read)
                                ✓✓
                            @else
                                ✓
                            @endif
                        </small>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- Input --}}
        <div class="card-footer">
            <form action="{{ route('chats.send', $chat) }}" method="POST" class="d-flex gap-2">
                @csrf
                <input type="text" name="message" class="form-control" placeholder="Введите сообщение...">
                <button type="submit" class="btn btn-primary">Отправить</button>
            </form>
        </div>
    </div>
</div>
@endsection
