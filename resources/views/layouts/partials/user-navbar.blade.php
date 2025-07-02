<nav class="bg-[#5b63b7] text-white px-6 py-3 shadow-md">
    <div class="flex justify-between items-center flex-wrap">
        <h1 class="text-xl font-bold mb-2 md:mb-0">🎮 Game Store</h1>
        <ul class="flex flex-wrap gap-4 text-sm items-center">
            <li>
                <a href="{{ route('user.dashboard') }}"
                    class="{{ request()->routeIs('user.dashboard') ? 'underline font-semibold' : 'hover:underline' }}">
                    Dashboard
                </a>
            </li>
            <li>
                <a href="{{ route('user.payment.history') }}"
                    class="{{ request()->routeIs('payment.history') ? 'underline font-semibold' : 'hover:underline' }}">
                    Payment History
                </a>
            </li>
        
            @if (Session::has('user'))
                @php $user = Session::get('user'); @endphp
                <li>
                    <a href="{{ route('user.show', ['id' => $user['userID']]) }}" class="hover:underline font-medium">
                        👤 {{ $user['username'] }}
                    </a>
                </li>
            @endif

            <li>
                <form id="logout-form" method="POST" action="{{ route('user.logout') }}" style="display: none;">
                    @csrf
                </form>

                <a href="#" class="hover:underline text-sm"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    Logout
                </a>
            </li>
        </ul>
    </div>
</nav>