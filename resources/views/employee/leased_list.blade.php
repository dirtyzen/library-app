@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1>List of Leased</h1>
                <hr class="mt-0">
                @empty($leased->count())
                    <x-alert message="There are no lease" type="{{ Config::get('constants.alert_types.info') }}"></x-alert>
                @else
                    @each('employee._leasecard', $leased, 'data')
                    @include('layouts._pagination', ['pagination' => $leased])
                @endempty
            </div>
        </div>
    </div>
@endsection
