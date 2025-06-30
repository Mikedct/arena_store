@extends('layouts.app')

@section('content')
<div style="background:#000; color:#f9f871; min-height:100vh; padding:2rem;">
    <h2>Selamat Datang di Dashboard</h2>
    <p>Ini adalah halaman utama setelah login sebagai user.</p>
    <div class="row mt-4">
        <div class="col-md-4">
            <a href="/user/games" class="card p-3" style="background:#1c1c1c; color:#f9f871; border:1px solid #3a3a3a; text-decoration:none;">
                🎮 Lihat Game
            </a>
        </div>
        <div class="col-md-4">
            <a href="/user/orders" class="card p-3" style="background:#1c1c1c; color:#f9f871; border:1px solid #3a3a3a; text-decoration:none;">
                📦 Pesanan Saya
            </a>
        </div>
        <div class="col-md-4">
            <a href="/user/reviews" class="card p-3" style="background:#1c1c1c; color:#f9f871; border:1px solid #3a3a3a; text-decoration:none;">
                📝 Ulasan
            </a>
        </div>
    </div>
</div>
@endsection
