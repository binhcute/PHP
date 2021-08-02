<div class="container" id="list-cart">
    <table class="cart-wishlist-table table">
        <thead>
            <tr>
                <th class="avatar">Hình Ảnh</th>
                <th class="name">Tên Sản Phẩm</th>
                <th class="price">Giá</th>
                <th class="quantity">Số Lượng</th>
                <th class="subtotal">Tổng Tiền</th>
                <th class="subtotal">Lưu</th>
                <th class="remove">Xóa</th>
            </tr>
        </thead>
        <tbody>

            @if(Session::has("Cart") != null)
            @foreach(Session::get('Cart')->product as $item)
            <tr>
                <td><img src="{{URL::to('/')}}/server/assets/image/product/{{$item['product_info']->product_img}}" class="img-thumbnail" width="90" height="100"></td>
                <td class="name" name="name">{{$item['product_info']->product_name}}</td>
                <td class="price" name="price">{{number_format($item['product_info']->product_price).' '.'VND'}}</td>
                <td class="quantity">
                    <div class="product-quantity">
                        <a class="qty-btn minus" href="javascript:"><i class="ti-minus"></i></a>
                        <input type="text" class="quantity-input text-center" name="quantity" value="{{$item['qty']}}">
                        <a class="qty-btn plus" href="javascript:"><i class="ti-plus"></i></a>
                    </div>

                </td>
                <td class="subtotal"><span>{{number_format($item['price']).' '.'VND'}}</span></td>
                </td>
                <td><a onclick="SaveItemListCart({{$item['product_info']->product_id}});"><i class="fas fa-cart-arrow-down"></i></a></td>
                <td><a onclick="DeleteItemListCart({{$item['product_info']->product_id}});"><i class="fas fa-trash-alt"></i></a></td>
                @endforeach
                @endif
            </tr>
        </tbody>
    </table>
    <div class="row justify-content-between mb-n3">
        <div class="col-auto mb-3">
        </div>
        <div class="col-auto">
            <a data-toggle="modal" data-target="#myModal" class="btn btn-light btn-hover-dark mr-3 mb-3" href="#">Đặt Hàng Ngay</a>
        </div>
    </div>
    <br>
    <div class="row learts-mb-n30">
        <div class="col-lg-6 order-lg-2 learts-mb-30">
            <div class="order-review">
                <table class="table">
                    <thead>
                        <tr>
                            <th class="name">Sản Phẩm</th>
                            <th class="total">Thành Tiền</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(Session::has("Cart") != null)
                        @foreach(Session::get('Cart')->product as $item)
                        <tr>
                            <td class="name">{{$item['product_info']->product_name}}&nbsp; <strong class="quantity">×&nbsp;{{$item['qty']}}</strong></td>
                            <td class="total"><span>{{number_format($item['price']).' '.'VND'}}</span></td>
                        </tr>
                        @endforeach
                        @endif
                    </tbody>
                    <tfoot>
                        <tr class="total">
                            <th>Tổng Cộng</th>
                            <td><strong><span>{{number_format(Session::get('Cart')->totalPrice).' '.'VND'}}</span></strong></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
        <div class="col-lg-6 order-lg-1 learts-mb-30">
            <div class="order-payment">
                <div class="payment-method">
                    <div class="accordion" id="paymentMethod">
                        <div class="card active">
                            <div class="card-header">
                                <button data-toggle="collapse" type="button" data-target="#checkPayments">Thanh Toán Khi Nhận Hàng</button>
                            </div>
                            <div id="checkPayments" class="collapse show" data-parent="#paymentMethod">
                                @if(Auth::check()){
                                <div class="card-body">
                                    <p>Shipper sẽ giao tới</p>
                                    <input type="text" name="address" value="{{ Auth::user()->address }}">
                                </div>
                                <div class="card-body">
                                    <p>Số Điện Thoại Nhận Hàng</p>
                                    <input type="text" name="phone" value="{{ Auth::user()->phone }}">
                                </div>
                                @endif
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <button data-toggle="collapse" type="button" data-target="#cashkPayments">Chuyển Khoản </button>
                            </div>
                            <div id="cashkPayments" class="collapse" data-parent="#paymentMethod">
                                <div class="card-body">
                                    <p>Pay with cash upon delivery.</p>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <button data-toggle="collapse" type="button" data-target="#payPalPayments">Thẻ Ghi Nợ <img src="client/images/others/pay-2.png" alt=""></button>
                            </div>
                            <div id="payPalPayments" class="collapse" data-parent="#paymentMethod">
                                <div class="card-body">
                                    <p>Pay via PayPal; you can pay with your credit card if you don’t have a PayPal account.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="text-center">
                    <p class="payment-note">Miễn phí vận chuyển</p>
                    <button class="btn btn-dark btn-outline-hover-dark">place order</button>
                </div>
            </div>
        </div>
    </div>



</div>