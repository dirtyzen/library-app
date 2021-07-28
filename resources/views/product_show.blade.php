@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('index') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ $product->category->name }}</li>
                    </ol>
                </nav>
            </div>
            <div class="col-xs-12 col-sm-3">
                <img data-src="{{ $product->image }}" alt="{{ $product->title }}" class="img-fluid img-thumbnail mb-4 lazyload">
                @guest
                    <div class="card border-info">
                        <div class="card-body">
                            <a href="{{ route('register') }}" class="text-info">Register</a>
                            and
                            <a href="{{ route('login') }}" class="text-info">Login</a> for lease!
                        </div>
                    </div>
                @else
                    @isset($lease)
                        <div class="card">
                            <div class="card-body">
                                @if($lease->status == Config::get('constants.statuses.1'))
                                    <p>Your lease request is awaiting employee approval.</p>
                                    <button class="btn btn-outline-danger btn-block" data-toggle="modal" data-target="#leaseModal">Cancel Request</button>
                                @else
                                    @php($deliveryDateInfo = Helpers::returnDate($lease->delivery_date))
                                    <p class="mb-1">
                                        <b>Lease date :</b>
                                        <span data-toggle="tooltip" data-placement="top" title="{{ $deliveryDateInfo->deliveryDateForHuman }}">{{ $deliveryDateInfo->deliveryDate }}</span>
                                    </p>
                                    <p class="mb-2">
                                        <b>Return date :</b>
                                        {{ $deliveryDateInfo->returnDate }}
                                    </p>
                                    @if($deliveryDateInfo->hasExpired)
                                        <p class="mb-0 text-danger small">The return time has passed {{ $deliveryDateInfo->passedDays }} days!</p>
                                    @else
                                        <p class="mb-0 small">
                                            {{ $deliveryDateInfo->remainDays == 0 ? 'You must return it today!' : "You have {$deliveryDateInfo->remainDays} days to return it." }}
                                        </p>
                                    @endif
                                @endif
                            </div>
                        </div>
                    @else
                        <button type="button" class="btn btn-block btn-outline-primary" data-toggle="modal" data-target="#leaseModal">
                            Lease Request
                        </button>
                    @endisset
                @endguest
            </div>
            <div class="col-xs-12 col-sm-9">
                <h1 class="mt-4 mt-sm-0">{{ $product->title }}</h1>
                <table class="table table-sm table-borderless align-middle table-details">
                    <tbody>
                    <tr>
                        <td class="text-nowrap">{{ Helpers::ownerTitle($product) }}</td>
                        <td class="text-nowrap">:</td>
                        <td class="w-100">{{ $product->owner }}</td>
                    </tr>
                    <tr>
                        <td>Publisher</td>
                        <td>:</td>
                        <td>{{ $product->publisher }}</td>
                    </tr>
                    </tbody>
                </table>
                @if($product->category->slug === 'cds')
                    <div class="card">
                        <h5 class="card-header py-2 px-3">Track List</h5>
                        <ul class="list-group list-group-flush">
                            @foreach($product->tracks as $track)
                                <li class="list-group-item py-1 px-3">{{ $track  }}</li>
                            @endforeach
                        </ul>
                    </div>
                @else
                    <div class="card">
                        <h5 class="card-header">Backside Text</h5>
                        <div class="card-body">
                            <p class="card-text">{{ $product->backside_text }}</p>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection

@auth()
@section('modal')
    @if(isset($lease) && $lease->status == Config::get('constants.statuses.1'))
        {{-- lease cancel modal --}}
        <div class="modal fade" id="leaseModal" tabindex="-1" aria-labelledby="leaseModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="{{ route('leaseCancel') }}" onsubmit="return leaseCancel(event);" id="leaseCancelForm">
                        <div class="modal-header">
                            <h5 class="modal-title" id="leaseModalLabel">Cancel Confirm</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <h4 class="mb-0">Are you sure you want to cancel?</h4>
                            <div id="leaseCancelResponse"></div>
                            @csrf
                            <input type="hidden" name="productID" value="{{ $product->id }}" autocomplete="off">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Yes, I'm Sure</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @else
        {{-- lease confirm modal --}}
        <div class="modal fade" id="leaseModal" tabindex="-1" aria-labelledby="leaseModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="{{ route('leaseRequest') }}" onsubmit="return leaseRequest(event);" id="leaseRequestForm">
                        <div class="modal-header">
                            <h5 class="modal-title" id="leaseModalLabel">Request Confirm</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <h4 class="mb-0">Are you sure you want to lease?</h4>
                            <div id="leaseRequestResponse"></div>
                            @csrf
                            <input type="hidden" name="productId" value="{{ $product->id }}" autocomplete="off">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Yes, I'm Sure</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif
@endsection
@endauth
