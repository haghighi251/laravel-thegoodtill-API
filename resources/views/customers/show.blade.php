@extends('top')
@section('title','Show search result')
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
            <th>view</th>
        </tr>
        @forelse ($users as $user)
        <tr>
            <td>{{$loop->index + 1}}</td>
            <td>{{ $user['name'] }}</td>
            <td>{{ $user['customer_group'] }}</td>
            <td>{{ $user['address'] }}</td>
            <td>{{ $user['email'] }}</td>
            <td>{{ $user['mobile'] }}</td>
            <td><a href="/customer/{{ $user['id'] }}">View more detail.</a></td>
        </tr>
        @empty
        <tr>
            <td colspan="7">No users.</td>
        </tr>
        @endforelse
    </table>
</main>
@endsection
