@extends('layouts.admin_app')
@section('content')
<span>訂單總數: {{ $orderCount }}</span>
<table>
    <thead>
        <tr>
            <td>購買時間</td>
            <td>購買者</td>
            <td>商品清單</td>
            <td>訂單總額</td>
            <td>是否運送</td>
        </tr>
    </thead>
    <tbody>
        @foreach ($orders as $order)
            <tr>
                <td>{{ $order->created_at }}</td>
                <td>{{ $order->user->name }}</td>
                <td>
                    @foreach ($order->orderItems as $orderItem)
                        {{ $orderItem->product->title }} &nbsp;
                    @endforeach
                </td>
                <td>{{ isset($order->orderItems) ? $order->orderItems->sum('price') : 0 }}</td>
                <td>{{ $order->is_shipped }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
<div>
    @for ($i = 1; $i <= $orderPages; $i++)
        <a href="/admin/orders?page={{ $i }}">第{{ $i }}頁</a> &nbsp;
    @endfor
</div>
