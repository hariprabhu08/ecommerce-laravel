<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\UpdateCartItem;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;

use Illuminate\Http\Request;

class CartItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $messages = [
            'required' => ':attribute 是必要的',
            'between' => ':attribute 的輸入 :input 不在 :min 和 :max 之間'
        ];
        $validator = Validator::make($request->all(), [
            'cart_id' => 'required|integer',
            'product_id' => 'required|integer',
            'quantity' => 'required|integer|between:1,10'
        ], $messages);
        if ($validator->fails()) {
            return response($validator->errors(), 400);
        }
        $validatedData = $validator->validate();

        $product = Product::find($validatedData['product_id']);
        if (!$product->checkQuantity($validatedData['quantity'])) {
            return response($product->title.'\'s Quantity Not Enough', 400);
        }

        $cart = Cart::find($validatedData['cart_id']);
        $result = $cart->cartItems()->create(['product_id' => $product->id,
                                            'quantity' => $validatedData['quantity']]);
        return response()->json($result);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCartItem $request, $id)
    {
        $form = $request->validated();
        $item = CartItem::find($id);

        $product = Product::find($item->product_id);
        if (!$product->checkQuantity($form['quantity'])) {
            return response($product->title.'\'s Quantity Not Enough', 400);
        }

        $item->fill(['quantity' => $form['quantity']]);
        $item->save();
        return response()->json(true);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        CartItem::find($id)->delete();
        return response()->json(true);
    }
}
