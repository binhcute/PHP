<div class="inner" id="change-items">
    <div class="head">
        <span class="title">Giỏ Hàng</span>
        <button class="offcanvas-close">×</button>
    </div>
    @if(Session::has("Cart") != null)
    <div class="body customScroll">
        <ul class="minicart-product-list">
            @foreach(Session::get('Cart')->product as $item)
            <li>
                <a href="product-details.html" class="image"><img src="{{URL::to('/')}}/server/assets/image/product/{{$item['product_info']->product_img}}" alt="Cart product Image"></a>
                <div class="content">
                    <a href="product-details.html" class="title">{{$item['product_info']->product_name}}</a>
                    <span class="quantity-price">{{$item['qty']}} x <span class="amount">{{number_format($item['product_info']->product_price).' '.'VND'}}</span></span>
                    <i class="fa fa-times remove" data-id="{{$item['product_info']->product_id}}"></i>
                </div>
            </li>
            @endforeach
        </ul>
    </div>
    <div class="foot">
        <div class="sub-total">
            <strong>Tổng Tiền :</strong>
            <span class="amount">{{number_format(Session::get('Cart')->totalPrice).' '.'VND'}}</span>
            <input hidden="true" id="total-qty" type="number" value="{{Session::get('Cart')->totalQuantity}}">
        </div>
        <div class="buttons">
            <a href="{{route('cart.index')}}" class="btn btn-dark btn-hover-primary">Xem Giỏ Hàng</a>
            <a href="checkout.html" class="btn btn-outline-dark">checkout</a>
        </div>
    </div>
    @endif

</div>