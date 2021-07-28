<?php

namespace App\Http\Controllers;

use App\Models\Leases;
use App\Models\Products;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class ProductController extends Controller
{
    /**
     * @param string $categorySlug
     * @param string $productSlug
     * @param int $productId
     * @return View
     */
    public function show(string $categorySlug, string $productSlug, int $productId): View
    {
        $product = Products::show($categorySlug, $productSlug, $productId)->firstOrFail();

        if (Auth::check()) {
            $lease = Leases::HasLease($product->id)->first();
        }

        return view('product_show', [
            'product' => $product,
            'lease'   => $lease ?? null
        ]);
    }
}
