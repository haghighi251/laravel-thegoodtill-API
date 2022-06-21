@extends('top')
@section('title','Add sale')
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
<main class="">
    <form method="post" action="">
        <a href="/"><img class="mb-4" src="../../favicon.ico" alt="" width="72" height="57"></a>
        <h1 class="h3 mb-3 fw-normal">Add sale:</h1>
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
            <textarea name="query" class="form-control w100" style="height: 500px;">
            {
    "sale": {
        "id": "f39a3113-371d-4505-97f9-c3d68c0c969d",
        "outlet_id": "aad28387-468f-426c-b0c9-6491f331f12b",
        "outlet_name": "Main Outlet",
        "sale_date_time": "2018-01-30 10:16:21",
        "total_inc_vat": 3.75,
        "vat": 1.45,
        "customer": {
            "id": "ac649b0e-71ab-4396-bf8b-631059d27366",
            "name": "John Doe",
            "email": "johndoe@example.com",
            "phone": "07987654321",
            "external_id": "4ef1a87b-7178-49b6-97f1-2d4df0a8e4c2"
        },
        "sales_items": [
            {
                "product_id": "0abcacba-4d2d-4f50-8b76-b69966c22b7c",
                "product_name": "Single player",
                "product_sku": "golf_single_player",
                "quantity": 1,
                "total_inc_vat": 7.5,
                "vat": 1.25,
                "reward_id": null,
                "points_spent": 0
            },
            {
                "product_id": "98587103-5d72-4d58-837f-adecc1450622",
                "product_name": "Still water",
                "product_sku": "water_still",
                "quantity": 1,
                "total_inc_vat": 1,
                "vat": 0.2,
                "reward_id": null,
                "points_spent": 0
            },
            {
                "product_id": "f380c1e4-2368-4bfa-a60e-34ee35e10dd0",
                "product_name": "Latte",
                "product_sku": "coffee_latte",
                "quantity": 1,
                "total_inc_vat": 0,
                "vat": 0,
                "reward_id": "free_coffee",
                "points_spent": 25
            },
            {
                "product_id": null,
                "product_name": "£5 off",
                "product_sku": null,
                "quantity": 1,
                "total_inc_vat": -5,
                "vat": 0,
                "reward_id": "5_pounds_off",
                "points_spent": 100
            }
        ]
    }
}
            </textarea>
            <label for="floatingInput">Request</label>
        </div>
        @csrf
        <button class="btn btn-lg btn-primary mt-5 w-25" type="submit">Add</button>
        <p class="mt-5 mb-3 text-muted">&copy; 2022</p>
    </form>
</main>
@endsection
