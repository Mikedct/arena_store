@extends('layouts.app')

@section('title', 'Daftar Game')

@section('content')
<h2 class="mb-4">Daftar Game</h2>

<div class="row">
    @foreach ($game as $game)
        <div class="col-md-4 mb-4">
            <div class="card h-100">
                <img src="{{ $game->image }}" class="card-img-top" alt="{{ $game->title }}" style="height: 200px; object-fit: cover;">
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title">{{ $game->title }}</h5>
                    <p class="card-text text-muted">{{ $game->genre }} | {{ $game->platform }}</p>
                    <p class="card-text">{{ Str::limit($game->description, 80) }}</p>
                    <div class="mt-auto">
                        <p class="text-white fw-bold">Rp{{ number_format($game->price, 0, ',', '.') }}</p>
                        <a href="{{ url('/game/' . $game->gameID) }}" class="btn btn-primary btn-sm">Lihat Detail</a>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>
@endsection
