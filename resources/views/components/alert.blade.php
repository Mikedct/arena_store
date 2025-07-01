@props(['type' => 'info', 'message' => ''])

@php
    $color = match($type) {
        'success' => 'green',
        'error' => 'red',
        'warning' => 'yellow',
        default => 'blue',
    };
@endphp

<div class="mb-4 p-4 rounded-lg bg-{{ $color }}-100 border border-{{ $color }}-300 text-{{ $color }}-800 shadow-sm">
    {{ $message }}
</div>
