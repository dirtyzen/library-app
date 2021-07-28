<?php

namespace App\Http\Controllers;

use App\Http\Requests\LeasePostRequest;
use App\Models\Leases;
use App\View\Components\Alert;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

class LeaseController extends Controller
{
    /**
     * @param LeasePostRequest $request
     * @return View
     */
    public function lease(LeasePostRequest $request): View
    {
        if ($request->getValidationError()) {
            $alert = new Alert($request->getValidationError(), Config::get('constants.alert_types.warning'), true);
            return $alert->render();
        }

        Leases::create([
            'customer_id' => $request->user()->id,
            'product_id'  => $request->productId,
            'status'      => Config::get('constants.statuses.1')
        ]);

        $alert = new Alert('Request has been submitted. Wait for page refreshing!', Config::get('constants.alert_types.success'), true);
        return $alert->render();
    }

    /**
     * @param Request $request
     * @return View
     */
    public function cancel(Request $request): View
    {
        $delete = Leases::where('customer_id', '=', auth()->id())
            ->where('product_id', '=', $request->productId)
            ->where('status', '=', Config::get('constants.statuses.1'))
            ->delete();

        if ($delete) {
            $alert = new Alert('The request was canceled. Wait for page refreshing!', Config::get('constants.alert_types.success'), true);
        } else {
            $alert = new Alert('You cannot cancel this request!', Config::get('constants.alert_types.danger'), true);
        }

        return $alert->render();
    }
}
