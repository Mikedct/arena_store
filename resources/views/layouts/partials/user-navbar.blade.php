<nav class="bg-[#5b63b7] text-white px-6 py-3 shadow-md">
    <div class="flex justify-between items-center">
        <h1 class="text-xl font-bold">Game Store</h1>
        <ul class="flex gap-6 text-sm">
            <li><a href="{{ route('user.dashboard') }}" class="hover:underline">Dashboard</a></li>
            <li><a href="{{ route('user.orders') }}" class="hover:underline">Orders</a></li>
            <li><a href="{{ route('user.payment') }}" class="hover:underline">Payment</a></li>
            <li>
                <form method="POST" action="{{ route('user.logout') }}">
                    @csrf
                    <button type="submit" class="hover:underline">Logout</button>
                </form>
            </li>
        </ul>
    </div>
</nav>
