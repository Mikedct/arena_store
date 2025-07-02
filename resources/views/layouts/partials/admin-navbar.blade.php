<nav class="bg-[#5b63b7] text-white px-6 py-3 shadow-md">
    <div class="flex justify-between items-center flex-wrap">
        <h1 class="text-xl font-bold mb-2 md:mb-0">Admin Panel</h1>
        <ul class="flex flex-wrap gap-4 text-sm">
            <li>
                <a href="{{ route('admin.dashboard') }}"
                   class="{{ request()->routeIs('admin.dashboard') ? 'underline font-semibold' : 'hover:underline' }}">
                   Dashboard
                </a>
            </li>
            <li>
                <a href="{{ route('admin.orders') }}"
                   class="{{ request()->routeIs('admin.orders') ? 'underline font-semibold' : 'hover:underline' }}">
                   Orders
                </a>
            </li>
            <li>
                <a href="{{ route('admin.payment') }}"
                   class="{{ request()->routeIs('admin.payment') ? 'underline font-semibold' : 'hover:underline' }}">
                   Payment
                </a>
            </li>
            <li>
                <a href="{{ route('admin.review.overview') }}"
                   class="{{ request()->routeIs('admin.review.overview') ? 'underline font-semibold' : 'hover:underline' }}">
                   Review
                </a>
            </li>
            <li>
                <form method="POST" action="{{ route('admin.logout') }}">
                    @csrf
                    <button type="submit" class="hover:underline text-sm">Logout</button>
                </form>
            </li>
            
        </ul>
    </div>
</nav>
