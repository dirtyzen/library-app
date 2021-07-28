<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmployeeApprovePostRequest;
use App\Models\Leases;
use App\View\Components\Alert;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

class EmployeProcessController extends Controller
{
    /**
     * @param EmployeeApprovePostRequest $request
     * @return View
     */
    public function leaseApprove(EmployeeApprovePostRequest $request): View
    {
        if ($request->getValidationError()) {
            $alert = new Alert($request->getValidationError(), Config::get('constants.alert_types.warning'), true);
            return $alert->render();
        }

        $lease = $request->getLease();
        $lease->employee_id = $request->user()->id;
        $lease->delivery_date = now();
        $lease->status = Config::get('constants.statuses.2');
        $lease->update();
        $lease->product()->decrement('amount', 1);

        $alert = new Alert('Request approved. Wait for page refreshing!', Config::get('constants.alert_types.success'), true);
        return $alert->render();
    }

    /**
     * @param Request $request
     * @return View
     */
    public function leaseCancel(Request $request): View
    {
        if (Leases::ApprovalRequests()->find($request->cancelId)->delete()) {
            $alert = new Alert('The request was canceled. Wait for page refreshing!', Config::get('constants.alert_types.success'), true);
        } else {
            $alert = new Alert('Approvel request not found!', Config::get('constants.alert_types.danger'), true);
        }
        return $alert->render();
    }
}
