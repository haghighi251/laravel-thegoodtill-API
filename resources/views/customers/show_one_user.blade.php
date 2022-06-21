@extends('top')
@section('title','Show user')
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
<main >
    <a href="/"><img class="mb-4" src="../favicon.ico" alt="" width="72" height="57"></a>
    <h1 class="h3 mb-3 fw-normal">User information:</h1>
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
    <table class="table table-hover">
        <tr>
            <th>#</th>
            <th>name</th>
            <th>customer group</th>
            <th>address</th>
            <th>email</th>
            <th>mobile</th>
            <th>group</th>
            <th>account code</th>
            <th>extra notes</th>
            <th>created at</th>
        </tr>
        @if(count($user) > 0)
        <tr>
            <td>#</td>
            <td>{{ $user['name'] }}</td>
            <td>{{ $user['customer_group'] }}</td>
            <td>{{ $user['address'] }}</td>
            <td>{{ $user['email'] }}</td>
            <td>{{ $user['mobile'] }}</td>
            <td>{{ $user['customer_group'] }}</td>
            <td>{{ $user['account_code'] }}</td>
            <td>{{ $user['extra_notes'] }}</td>
            <td>{{ $user['created_at']}}</td>
        </tr>
        @else
        <tr>
            <td colspan="10"><strong>No user.</strong></td>
        </tr>
        @endif
    </table>
</main>
@endsection
