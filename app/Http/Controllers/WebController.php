<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\User;

class WebController extends Controller
{
    public $notifications = [];
    public function __construct()
    {
        $user = User::find(2);
        $this->notifications = $user->notifications ?? [];
    }

    public function index()
    {
        $products = Product::all();
        return view('web.index', ['products' => $products,
                                'notifications' => $this->notifications]);
    }

    public function contactUs()
    {
        return view('web.contact_us', ['notifications' => $this->notifications]);
    }
}
