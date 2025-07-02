@extends('layouts.app')

@section('title', 'Histori Pembayaran')

@section('content')
<div class="container mx-auto py-10 px-4">
    <h1 class="text-3xl font-bold mb-6 text-center text-[#5b63b7]">Histori Pembayaran</h1>

    @if(session('success'))
        <div class="bg-green-100 text-green-800 px-4 py-2 mb-4 rounded">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="bg-red-100 text-red-800 px-4 py-2 mb-4 rounded">
            {{ $errors->first() }}
        </div>
    @endif

    @if(count($orders) > 0)
        <table class="w-full table-auto border-collapse border border-gray-300">
            <thead class="bg-gray-100">
                <tr>
                    <th class="border p-2">#</th>
                    <th class="border p-2">Game</th>
                    <th class="border p-2">Order ID</th>
                    <th class="border p-2">Tanggal Order</th>
                    <th class="border p-2">Total Harga</th>
                    <th class="border p-2">Status Pembayaran</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $index => $order)
                    <tr>
                        <td class="border p-2 text-center">{{ $index + 1 }}</td>
                        <td class="border p-2">{{ $order['title'] }}</td>
                        <td class="border p-2 text-center">{{ $order['orderID'] }}</td>
                        <td class="border p-2 text-center">{{ $order['orderDate'] }}</td>
                        <td class="border p-2 text-right">${{ number_format($order['totalPrice'], 0, ',', '.') }}</td>
                        <td class="border p-2 text-center">
                            @if($order['paymentID'])
                                <span class="text-green-600 font-semibold">Lunas</span>
                            @else
                                <span class="text-red-600 font-semibold">Belum Bayar</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p class="text-center text-gray-500 mt-8">Belum ada histori pembayaran.</p>
    @endif
</div>
@endsection
