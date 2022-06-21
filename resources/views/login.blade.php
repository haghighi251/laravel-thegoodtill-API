@extends('top')
@section('title','Login page')
@section('head')
<style>
    .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
    }

    @media (min-width: 768px) {
        .bd-placeholder-img-lg {
            font-size: 3.5rem;
        }
    }
</style>
<!-- Custom styles for this template -->
<link href="/assets/css/signin.css" rel="stylesheet">
@endsection
@section('content')
<main class="form-signin">
    <form method="post" action="">
        <a href="/"><img class="mb-4" src="favicon.ico" alt="" width="72" height="57"></a>
        <h1 class="h3 mb-3 fw-normal">Please sign in</h1>
        @if (count($errors) > 0)
        <div class = "alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        @if(Session::has('error'))
        <div class="alert alert-danger">
            {{ Session::get('error') }}
        </div>
        @endif

        <div class="form-floating">
            <input type="text" name="subdomain" class="form-control" id="floatingInput" placeholder="GOODTILL_SUBDOMAIN">
            <label for="floatingInput">Subdomain</label>
        </div>
        <div class="form-floating">
            <input type="text" name="username" class="form-control" id="floatingInput" placeholder="GOODTILL_USERNAME">
            <label for="floatingInput">UserName</label>
        </div>
        <div class="form-floating">
            <input type="password" name="password" class="form-control" id="floatingInput" placeholder="GOODTILL_PASSWORD">
            <label for="floatingInput">Password</label>
        </div>
        @csrf
        <button class="w-100 btn btn-lg btn-primary" type="submit">Sign in</button>
        <p class="mt-5 mb-3 text-muted">&copy; 2022</p>
    </form>
</main>
@endsection
