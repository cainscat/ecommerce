<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Auth;

class OrderItemModel extends Model
{
    protected $table = 'orders_item';

    public function getProduct()
    {
        return $this->belongsTo(ProductModel::class, 'product_id');
    }

    static public function getReview($product_id, $order_id)
    {
        return ProductReviewModel::getReview($product_id, $order_id, Auth::user()->id);
    }

}
