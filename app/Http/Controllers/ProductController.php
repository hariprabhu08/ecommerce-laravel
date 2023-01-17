<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;
use App\Models\Product;
use App\Http\Services\ShortUrlService;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $data = DB::table('products')->get();
        $data = json_decode(Redis::get('products'));
        return response($data);
    }

    public function checkProduct(Request $request)
    {
        $id = $request->all()['id'];
        $product = Product::find($id);
        if ($product->quantity > 0) {
            return response(true);
        } else {
            return response(false);
        }
    }

    public function sharedUrl($id)
    {
        $service = new ShortUrlService();
        $url = $service->makeShortUrl("http://localhost:3000/products/$id");
        return response(['url' => $url]);
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
        $data = $this->getData();
        $newData = $request->all();
        $data->push(collect($newData));
        return response($data);
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
    public function update(Request $request, $id)
    {
        $form = $request->all();
        $data = $this->getData();
        $selectedData = $data->where('id', $id)->first();
        $selectedData = $selectedData->merge($form);
        return response($selectedData);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = $this->getData();
        $data = $data->filter(function ($product) use($id) {
            return $product['id'] != $id;
        });
        return response($data->values());
    }

    public function getData() {
        return collect([
            collect([
                'id' => 0,
                'title' => 'test product 1',
                'content' => 'test content 1',
                'price' => 50
            ]),
            collect([
                'id' => 1,
                'title' => 'test product 2',
                'content' => 'test content 2',
                'price' => 30
            ]),
        ]);
    }
}
