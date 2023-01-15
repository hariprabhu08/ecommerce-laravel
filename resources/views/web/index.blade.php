@extends('layouts.app')

@section('content')
<style>
    .special-text {
        text-align: center;
        background-color: greenyellow;
    }
</style>
<h2 style="margin-top: 40px">商品列表</h2>
<img src="https://s3.getstickerpack.com/storage/uploads/sticker-pack/gunter-adventure-times/sticker_10.png" width="20%" alt="">
<table>
    <thead>
        <tr>
            <td>標題</td>
            <td>內容</td>
            <td>價格</td>
            <td></td>
        </tr>
    </thead>
    <tbody>
        @foreach ($products as $product)
        <tr>
            @if ($product->id == 1)
                <td class="special-text">{{ $product->title }}</td>
            @else
                <td>{{ $product->title }}</td>
            @endif
            <td>{{ $product->content }}</td>
            <td style="{{ $product->price < 200 ? 'color: red; font-size: 22px;' : ''}}">{{ $product->price }}</td>
            <td><input class="check_product" type="button" value="確認商品數量" data-id="{{ $product->id }}"></td>
        </tr>
        @endforeach
    </tbody>
</table>
<script 
    src="https://code.jquery.com/jquery-3.6.3.min.js" 
    integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" 
    crossorigin="anonymous">
</script>
<script>
    $('.check_product').on('click', function(){
        $.ajax({
            method: 'POST',
            url: '/products/check-product',
            data: {id: $(this).data('id')}
        })
        .done(function(response){
            if (response) {
                alert('商品數量充足')
            } else {
                alert('商品數量不足')
            }
        })
    })
</script>
@endsection