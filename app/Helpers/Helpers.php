<?php


namespace App\Helpers;


use App\Models\Products;
use Carbon\Carbon;
use Illuminate\Support\Facades\Config;

class Helpers
{

    /**
     * @param Products $products
     * @return string
     */
    public static function ownerTitle(Products $products): string
    {
        $titleList = Config::get('constants.owner_title_list');
        return $titleList[$products->category->id];
    }

    public static function returnDate(string $delivery_date, string $format = 'Y-m-d')
    {
        $maxDay = Config::get('constants.max_lease_day');
        $deliveryDate = Carbon::parse($delivery_date);
        $deliveryDateForHuman = $deliveryDate->diffForHumans();
        $returnDate = Carbon::parse($delivery_date)->addDays($maxDay);
        $totalDays = Carbon::parse($delivery_date)->diffInDays(now(), true);
        $hasExpired = $totalDays > $maxDay;
        $remainDays = $hasExpired ? 0 : $returnDate->diffInDays(now(), true);
        $passedDays = $hasExpired ? ($totalDays - $maxDay) : 0;

        return (object)[
            'deliveryDate'         => $deliveryDate->format($format),
            'deliveryDateForHuman' => $deliveryDateForHuman,
            'returnDate'           => $returnDate->format($format),
            'totalDays'            => $totalDays,
            'hasExpired'           => $hasExpired,
            'remainDays'           => $remainDays,
            'passedDays'           => $passedDays,
        ];

    }

}
