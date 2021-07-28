@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1>List of Returned</h1>
                <hr class="mt-0">
                @empty($returned->count())
                    <x-alert message="There are no returned" type="{{ Config::get('constants.alert_types.info') }}"></x-alert>
                @else
                    @each('employee._leasecard', $returned, 'data')
                    @include('layouts._pagination', ['pagination' => $returned])
                @endempty
            </div>
        </div>
    </div>
@endsection
