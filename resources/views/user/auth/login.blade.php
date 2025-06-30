@extends('layouts.app')

@section('content')
<div style="background:#000; color:#f9f871; min-height:100vh; display:flex; justify-content:center; align-items:center">
    <form style="background:#1c1c1c; padding:2rem; border-radius:10px; width:300px;" method="POST" action="#">
        <h2 style="text-align:center; color:#f9f871;">Login</h2>
        <div class="form-group mb-3">
            <label>Username</label>
            <input type="text" name="username" class="form-control" style="background:#3a3a3a; color:white;">
        </div>
        <div class="form-group mb-3">
            <label>Password</label>
            <input type="password" name="password" class="form-control" style="background:#3a3a3a; color:white;">
        </div>
        <button type="submit" class="btn w-100" style="background:#f9f871; color:#000; font-weight:bold;">Login</button>
    </form>
</div>
@endsection
