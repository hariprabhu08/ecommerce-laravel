<style>
    .special-text {
        text-align: center;
        background-color: greenyellow;
    }
</style>
<div>
    <a href="/">商品列表</a>
    <a href="/contact-us">聯絡我們</a>
</div>
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
            <td></td>
        </tr>
        @endforeach
    </tbody>
</table>