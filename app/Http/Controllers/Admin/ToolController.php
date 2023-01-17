<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use App\Http\Controllers\Controller;
use App\Models\Product;

class ToolController extends Controller
{
    

    public function createProductRedis()
    {
        Redis::set('products', json_encode(Product::all()));
    }
}
