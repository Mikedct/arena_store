@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<h2>Hai, Selamat Datang di Game Store!</h2>
<p>Silakan pilih menu untuk mulai bermain atau belanja game favoritmu.</p>

<a href="{{ url('/games') }}" class="btn btn-primary">Lihat Game</a>
@endsection
