@extends('top')
@section('title','The root of the shop')
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
<link href="/assets/css/starter-template.css" rel="stylesheet">
@endsection
@section('content')
<header class="d-flex align-items-center pb-3 mb-5 border-bottom">
    <a href="/" class="d-flex align-items-center text-dark text-decoration-none">
        <img src="favicon.ico" width="40" height="32" />
        &nbsp;&nbsp;<span class="fs-4">Thegoodtill API samples</span>
    </a>
</header>
<main>
    <h1>Get started with Thegoodtill</h1>
    <p class="fs-5 col-md-8">Quickly and easily get started with Thegoodtill API is using from this laravel sample application. You just need to make some changes and push the application on the server. If you want to test it on your localhost, You must add SSL on your localhost. For getting more information and seeing the other functions of Thegoodtill API's, Please click on the link below.</p>

    <div class="mb-5">
        <a href="https://apidoc.thegoodtill.com/" class="btn btn-primary btn-lg px-4">View API documentation</a>
    </div>

    <hr class="col-3 col-md-2 mb-5">

    <div class="row g-5">
        <div class="col-md-6">
            <h2>Starter project and login</h2>
            <p>For the first step, You must login into your account on Thegoodtill. For doing this, please click on the link below:</p>
            <ul class="icon-list">
                <li><a href="/login" rel="noopener" >Login</a></li>
            </ul>
        </div>

        <div class="col-md-6">
            <h2>Guides</h2>
            <p>After login, You can use from the other parts of ThirdPartyLoyalty on Thegoodtill. To use each of parts, Please just click on the links below:</p>
            <ul class="icon-list">
                <li><a href="/customers/search">Search customers</a></li>
                <li><a href="/customers/search">Get customer</a></li>
                <li><a href="/customer/add/new">Create customer</a></li>
                <li><a href="/sale/add/">Complete sale</a></li>
            </ul>
        </div>
    </div>
</main>
@endsection
