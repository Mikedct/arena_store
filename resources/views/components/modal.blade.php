@props(['id' => 'defaultModal', 'title' => 'Modal Title'])

<div x-data="{ open: false }" x-cloak>
    <!-- Trigger -->
    <button @click="open = true"
        class="bg-[#5b63b7] hover:bg-[#434a98] text-white px-4 py-2 rounded shadow">
        {{ $trigger ?? 'Buka Modal' }}
    </button>

    <!-- Modal -->
    <div x-show="open" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
        <div @click.away="open = false" class="bg-white rounded-lg shadow-xl w-full max-w-md p-6">
            <h2 class="text-xl font-bold text-gray-700 mb-4">{{ $title }}</h2>

            {{ $slot }}

            <div class="mt-4 text-right">
                <button @click="open = false"
                        class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold px-4 py-2 rounded">
                    Tutup
                </button>
            </div>
        </div>
    </div>
</div>
