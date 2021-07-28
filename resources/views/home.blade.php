@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @each('layouts._productcard', $products, 'product')
            @include('layouts._pagination', ['pagination' => $products])
        </div>
    </div>
@endsection
