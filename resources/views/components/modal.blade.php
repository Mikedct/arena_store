@props([
    'id' => 'defaultModal',
    'title' => 'Modal Title',
    'maxWidth' => 'md', // sm, md, lg, xl, 2xl
])

<div x-data="{ open: false }" x-cloak>
    {{-- Trigger Button --}}
    <button @click="open = true"
            class="bg-[#5b63b7] hover:bg-[#434a98] text-white px-4 py-2 rounded shadow">
        {{ $trigger ?? 'Buka Modal' }}
    </button>

    {{-- Overlay --}}
    <div x-show="open"
         x-transition.opacity
         class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50"
         x-on:keydown.escape.window="open = false">

        {{-- Modal Box --}}
        <div @click.away="open = false"
             x-transition
             class="bg-white rounded-lg shadow-xl w-full max-w-{{ $maxWidth }} p-6 mx-4">
            
            {{-- Modal Title --}}
            <h2 class="text-xl font-bold text-gray-700 mb-4">
                {{ $title }}
            </h2>

            {{-- Modal Content --}}
            {{ $slot }}

            {{-- Action Buttons --}}
            <div class="mt-4 text-right">
                <button @click="open = false"
                        class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold px-4 py-2 rounded">
                    Tutup
                </button>
            </div>
        </div>
    </div>
</div>
