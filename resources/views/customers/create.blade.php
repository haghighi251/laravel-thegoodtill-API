@extends('top')
@section('title','Create new customer')
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
        <a href="/"><img class="mb-4" src="../../favicon.ico" alt="" width="72" height="57"></a>
        <h1 class="h3 mb-3 fw-normal">Add new customer:</h1>
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
        @if(Session::has('status'))
        <div class="alert alert-success">
            {{ Session::get('status') }}
        </div>
        @endif
        <div class="form-floating">
            <input type="text" name="name" class="form-control" id="floatingInput" placeholder="Name">
            <label for="floatingInput">Name</label>
        </div>
        <div class="form-floating">
            <input type="text" name="email" class="form-control" id="floatingInput" placeholder="Email">
            <label for="floatingInput">Email</label>
        </div>
        <div class="form-floating">
            <input type="text" name="phone" class="form-control" id="floatingInput" placeholder="Phone">
            <label for="floatingInput">Phone</label>
        </div>
        @csrf
        <button class="w-100 btn btn-lg btn-primary mt-5" type="submit">Add new customer</button>
        <p class="mt-5 mb-3 text-muted">&copy; 2022</p>
    </form>
</main>
@endsection
