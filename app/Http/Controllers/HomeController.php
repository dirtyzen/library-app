<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\View\View;


class HomeController extends Controller
{
    /**
     * @return View
     */
    public function index(): View
    {
        return view('home', [
            'products' => Products::idDescOrder()->paginate(20)
        ]);
    }
}
