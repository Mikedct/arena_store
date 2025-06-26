@extends('layouts.app')

@section('title', 'Dashboard Admin')

@section('content')
    <h2 class="mb-4">Dashboard Admin</h2>

    <div class="row">
        <div class="col-md-4">
            <div class="card p-3">
                <h5>Total Game</h5>
                <p class="fw-bold display-6">{{ $totalGames }}</p>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card p-3">
                <h5>HTTP Status</h5>
                <ul class="list-unstyled mb-0">
                    <li>✅ 2xx (Sukses): <strong>{{ $httpStatusCounts->success_2xx }}</strong></li>
                    <li>🔁 3xx (Redirect): <strong>{{ $httpStatusCounts->redirect_3xx }}</strong></li>
                    <li>⚠️ 4xx (Client Error): <strong>{{ $httpStatusCounts->client_error_4xx }}</strong></li>
                    <li>🔥 5xx (Server Error): <strong>{{ $httpStatusCounts->server_error_5xx }}</strong></li>
                </ul>
            </div>
        </div>
    </div>
@endsection
