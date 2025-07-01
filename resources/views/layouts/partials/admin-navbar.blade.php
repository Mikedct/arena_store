<nav class="bg-[#5b63b7] text-white px-6 py-3 shadow-md">
    <div class="flex justify-between items-center">
        <h1 class="text-xl font-bold">Admin Panel</h1>
        <ul class="flex gap-6 text-sm">
            <li><a href="{{ route('admin.dashboard') }}" class="hover:underline">Dashboard</a></li>
            <li><a href="{{ route('admin.games') }}" class="hover:underline">Games</a></li>
            <li><a href="{{ route('admin.orders') }}" class="hover:underline">Orders</a></li>
            <li><a href="{{ route('admin.payment') }}" class="hover:underline">Payment</a></li>
            <li><a href="{{ route('admin.review.overview') }}" class="hover:underline">Review</a></li>
        </ul>
    </div>
</nav>
