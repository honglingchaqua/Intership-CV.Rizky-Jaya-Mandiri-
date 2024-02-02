@extends('layouts.login-layout')
@section('container')
<img src="/img/logo.png" alt="Rizky Jaya Mandiri" class="mx-auto d-block img-fluid">
    <main class="form-signin w-100 m-auto">
        <form action="/login" method="POST">
            @csrf
            <div class="form-floating">
                <input type="email" name="email" class="form-control" id="email" placeholder="name@example.com" required
                    pattern="\S(.*\S)?" autofocus>
                <label for="email">Email address</label>
            </div>
            <div class="form-floating">
                <input type="password" name="password" class="form-control" id="password" placeholder="Password" required
                    pattern="\S(.*\S)?">
                <label for="password">Password</label>
            </div>
            <p class="text-danger mt-0 mb-2 text-center">{{ Session::get('loginError') }}</p>
            <button class="w-100 btn btn-lg btn-primary" type="submit">Sign in</button>
        </form>
    </main>
@endsection
