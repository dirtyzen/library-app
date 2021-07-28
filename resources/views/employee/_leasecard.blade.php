<div class="card mb-3">
    <div class="card-body">
        <table class="table table-borderless table-sm mb-0">
            <tbody>
            <tr>
                <td class="text-nowrap font-weight-bold">Product Name</td>
                <td class="text-nowrap">:</td>
                <td class="w-100">
                    <a href="{{ route('productDetail', [$data->product->category->slug, $data->product->slug, $data->product->id]) }}" target="_blank">
                        {{ $data->product->title }}
                    </a>
                </td>
            </tr>
            <tr>
                <td class="text-nowrap font-weight-bold">Product Category</td>
                <td class="text-nowrap font-weight-bold">:</td>
                <td>{{ $data->product->category->name }}</td>
            </tr>
            <tr>
                <td class="text-nowrap font-weight-bold">Product Amount</td>
                <td class="text-nowrap font-weight-bold">:</td>
                <td>{{ $data->product->amount }}</td>
            </tr>
            <tr>
                <td class="text-nowrap font-weight-bold">Customer Full Name</td>
                <td class="text-nowrap">:</td>
                <td class="w-100">{{ $data->customer->fullName }}</td>
            </tr>
            <tr>
                <td class="text-nowrap font-weight-bold">Customer Phone</td>
                <td class="text-nowrap">:</td>
                <td class="w-100">{{ $data->customer->phone }}</td>
            </tr>
            <tr>
                <td class="text-nowrap font-weight-bold">Customer Email</td>
                <td class="text-nowrap">:</td>
                <td class="w-100">{{ $data->customer->email }}</td>
            </tr>
            <tr>
                <td class="text-nowrap font-weight-bold">Request Date and Time</td>
                <td class="text-nowrap">:</td>
                <td class="w-100">{{ $data->created_at->format('Y-m-d H:i') }}</td>
            </tr>

            {{-- only showing on list of leased page --}}
            @if($data->status === Config::get('constants.statuses.2'))
                @php($deliveryDateInfo = Helpers::returnDate($data->delivery_date, 'Y-m-d H:i'))
                <tr>
                    <td class="text-nowrap font-weight-bold">Delivery Date and Time</td>
                    <td class="text-nowrap">:</td>
                    <td class="w-100">{{ $deliveryDateInfo->deliveryDate }}</td>
                </tr>
                <tr>
                    <td class="text-nowrap font-weight-bold">Return Date and Time</td>
                    <td class="text-nowrap">:</td>
                    <td class="w-100">{{ $deliveryDateInfo->returnDate }}</td>
                </tr>
                <tr>
                    <td class="text-nowrap font-weight-bold">Expire Info</td>
                    <td class="text-nowrap">:</td>
                    <td class="w-100">
                        @if($deliveryDateInfo->hasExpired)
                            Passed {{ $deliveryDateInfo->passedDays }} days
                        @else
                            {{ $deliveryDateInfo->remainDays == 0 ? 'Should return it today' : "Left {$deliveryDateInfo->remainDays} days" }}
                        @endif
                    </td>
                </tr>
                <tr>
                    <td class="text-nowrap font-weight-bold">Approver Employee</td>
                    <td class="text-nowrap">:</td>
                    <td class="w-100">{{ $data->employee->fullName }}</td>
                </tr>
            @endif

            {{-- only showing on list of returned page --}}
            @if($data->status === Config::get('constants.statuses.3'))
                <tr>
                    <td class="text-nowrap font-weight-bold">Delivery Date and Time</td>
                    <td class="text-nowrap">:</td>
                    <td class="w-100">{{ $data->delivery_date->format('Y-m-d H:i') }}</td>
                </tr>
                <tr>
                    <td class="text-nowrap font-weight-bold">Returned Date and Time</td>
                    <td class="text-nowrap">:</td>
                    <td class="w-100">
                        {{ $data->return_date->format('Y-m-d H:i') }}
                        /
                        {{ \Carbon\Carbon::parse($data->delivery_date)->diffInDays($data->return_date, true) }} days
                    </td>
                </tr>
            @endif

            </tbody>
        </table>

        {{-- only showing on approval requests page --}}
        @if($data->status === Config::get('constants.statuses.1'))
            <div class="row mt-2">
                <div class="col-12 d-flex justify-content-between">
                    <button type="button" class=" btn btn-outline-danger" data-toggle="modal" data-target="#cancelModal" onclick="cancelModalSetId({{ $data->id }})">
                        Cancel
                    </button>
                    <button type="button" class="d-flex btn btn-outline-primary" data-toggle="modal" data-target="#approveModal" onclick="approveModalSetId({{ $data->id }})">
                        Approve
                    </button>
                </div>
            </div>
        @endif

    </div>
</div>
