@extends('layouts.app')

@section('content')
<div style="background:#000; color:#f9f871; min-height:100vh; padding:2rem;">
    <h2>Daftar Game</h2>
    <div class="row">
        @foreach($games as $game)
        <div class="col-md-4 mb-3">
            <div class="card" style="background:#1c1c1c; color:#f9f871; border:1px solid #3a3a3a;">
                <div class="card-body">
                    <h5>{{ $game->title }}</h5>
                    <p>Genre: {{ $game->genre }}</p>
                    <p>Platform: {{ $game->platform }}</p>
                    <p>Harga: ${{ number_format($game->price) }}</p>
                    <a href="/user/game/order" class="btn btn-sm" style="background:#f9f871; color:#000;">Pesan</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
