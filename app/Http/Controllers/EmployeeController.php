<?php

namespace App\Http\Controllers;

use App\Models\Leases;
use Illuminate\View\View;

class EmployeeController extends Controller
{
    /**
     * @return View
     */
    public function approvalRequests(): View
    {
        return view('employee.approval_requests', [
            'requests' => Leases::approvalRequests()->get()
        ]);
    }

    /**
     * @return View
     */
    public function leasedList(): View
    {
        return view('employee.leased_list', [
            'leased' => Leases::atTheCustomer()->paginate(5)
        ]);
    }

    /**
     * @return View
     */
    public function returnedList(): View
    {
        return view('employee.returned_list', [
            'returned' => Leases::returned()->paginate(5)
        ]);
    }
}
