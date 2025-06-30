@extends('layouts.app')

@section('content')
<div style="background:#000; color:#f9f871; min-height:100vh; display:flex; justify-content:center; align-items:center">
    <form style="background:#1c1c1c; padding:2rem; border-radius:10px; width:350px;" method="POST" action="#">
        <h2 style="text-align:center; color:#f9f871;">Register</h2>
        <input type="text" name="username" placeholder="Username" class="form-control mb-2" style="background:#3a3a3a; color:white;">
        <input type="email" name="email" placeholder="Email" class="form-control mb-2" style="background:#3a3a3a; color:white;">
        <input type="password" name="password" placeholder="Password" class="form-control mb-2" style="background:#3a3a3a; color:white;">
        <input type="password" name="confirm_password" placeholder="Confirm Password" class="form-control mb-3" style="background:#3a3a3a; color:white;">
        <button type="submit" class="btn w-100" style="background:#f9f871; color:#000; font-weight:bold;">Register</button>
    </form>
</div>
@endsection
