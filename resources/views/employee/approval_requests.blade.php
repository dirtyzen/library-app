@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1>Approvel Requests</h1>
                <hr class="mt-0">
                @empty($requests->count())
                    <x-alert message="There are no requests pending approval" type="{{ Config::get('constants.alert_types.info') }}"></x-alert>
                @else
                    @each('employee._leasecard', $requests, 'data')
                @endempty
            </div>
        </div>
    </div>
@endsection

@section('modal')
    @if($requests->count())
        <!-- Approve Modal -->
        <div class="modal fade" id="approveModal" tabindex="-1" aria-labelledby="approveModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="{{ route('employeeLeaseApprove') }}" onsubmit="return leaseApprove(event);" id="approveForm">
                        <div class="modal-header">
                            <h5 class="modal-title" id="approveModalLabel">Confirm</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <h4 class="mb-0">Are you sure want to approve?</h4>
                            <div id="approveResponse"></div>
                            @csrf
                            <input type="hidden" name="leaseId" id="leaseId" value="0" autocomplete="off">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Yes, I'm Sure</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Cancel Modal -->
        <div class="modal fade" id="cancelModal" tabindex="-1" aria-labelledby="cancelModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="{{ route('employeeLeaseCancel') }}" onsubmit="return leaseCancel(event);" id="cancelForm">
                        <div class="modal-header">
                            <h5 class="modal-title" id="cancelModalLabel">Confirm</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <h4 class="mb-0">Are you sure want to cancel?</h4>
                            <div id="cancelResponse"></div>
                            @csrf
                            <input type="hidden" name="cancelId" id="cancelId" value="0" autocomplete="off">
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
