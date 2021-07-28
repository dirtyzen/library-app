<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;

class Leases extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * @var string[]
     */
    protected $fillable = [
        'customer_id',
        'product_id',
        'employee_id',
        'confirm_date',
        'return_date',
        'status',
    ];

    /**
     * @var string[]
     */
    protected $dates = [
        'delivery_date',
        'return_date',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    /**
     * @param Builder $query
     * @param int $productId
     * @return Builder
     */
    public function scopeHasLease(Builder $query, int $productId): Builder
    {
        return $query->where('customer_id', '=', Auth::id())
            ->where('product_id', '=', $productId)
            ->where('status', '!=', Config::get('constants.statuses.3'));
    }

    /**
     * @param Builder $query
     * @return Builder
     */
    public function scopeApprovalRequests(Builder $query): Builder
    {
        return $query->where('status', '=', Config::get('constants.statuses.1'))
            ->orderBy('id', 'ASC');
    }

    /**
     * @param Builder $query
     * @return Builder
     */
    public function scopeAtTheCustomer(Builder $query): Builder
    {
        return $query->where('status', '=', Config::get('constants.statuses.2'))
            ->orderBy('delivery_date', 'ASC');
    }

    /**
     * @param Builder $query
     * @return Builder
     */
    public function scopeReturned(Builder $query): Builder
    {
        return $query->where('status', '=', Config::get('constants.statuses.3'))
            ->orderBy('delivery_date', 'DESC');
    }

    /**
     * @return BelongsTo
     */
    public function customer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'customer_id');
    }

    /**
     * @return BelongsTo
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Products::class, 'product_id');
    }

    /**
     * @return BelongsTo
     */
    public function employee(): BelongsTo
    {
        return $this->belongsTo(User::class, 'employee_id');
    }
}
