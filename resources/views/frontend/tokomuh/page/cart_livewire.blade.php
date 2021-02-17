<div class="container mb-2">
    <div class="row gutter-lg">
        <div class="col-lg-12 col-md-12">
            <table class="shop-table cart-table mt-2">

                <tbody>

                    @php

                    $grouped = Cart::getContent()->mapToGroups(function ($item, $key) {
                    $attributes = $item->attributes;
                    $data = [
                    'id' => $item->id,
                    'name' => $item->name,
                    'price' => $item->price,
                    'quantity' => $item->quantity,
                    'total' => $item->getPriceSum(),
                    ];

                    $data = array_merge($data, $attributes->toArray());
                    return [$attributes['branch_id'] => (object)$data];
                    });

                    @endphp

                    @if(!Cart::isEmpty())
                    @foreach($grouped as $branch)

                    <thead>
                        <tr>
                            <td class="text-left" colspan="5">
                                <div>
                                    <span class="text-md">{{ $branch[0]->branch_name }}</span>
                                    <br>
                                    <span>
                                        {{ Helper::getSingleProvince($branch[0]->branch_location) }}
                                    </span>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th><span>Product</span></th>
                            <th></th>
                            <th><span>Price</span></th>
                            <th><span>quantity</span></th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    @foreach($branch as $cart)
                    <tr>
                        <td class="product-thumbnail">
                            <figure>
                                <a href="{{ route('product', ['slug' => $cart->product_slug]) }}">
                                    <img src="{{ Helper::files('product/'.$cart->product_image) }}" width="100"
                                        height="100" alt="product">
                                </a>
                                <a wire:click="actionDelete('{{ $cart->id }}')" class="product-remove"
                                    title="Remove this product">
                                    <i class="fas fa-times"></i>
                                </a>
                            </figure>
                        </td>
                        <td class="product-name">
                            <div class="product-name-section">
                                <a href="{{ route('product', ['slug' => $cart->product_slug]) }}"> {{ $cart->name }}</a>
                            </div>
                        </td>
                        <td class="product-subtotal">
                            <span class="amount">{{ Helper::createRupiah($cart->price) }}</span>
                        </td>
                        <td class="product-quantity">
                            <div class="input-group">
                                <button wire:click="actionMinus('{{ $cart->id }}')" class="d-icon-minus"></button>
                                <input class="form-control" value="{{ $cart->quantity }}" type="number">
                                <button wire:click="actionPlus('{{ $cart->id }}')" class="d-icon-plus"></button>
                            </div>
                        </td>
                        <td class="product-price">
                            <span class="amount">{{ number_format($cart->total) }}</span>
                        </td>
                    </tr>
                    @endforeach
                    @endforeach
                    @endif
                </tbody>

                <tfoot>
                    <tr>
                        <td colspan="4">Sub Total</td>
                        <td class="text-right product-price">
                            {{ number_format(Cart::getSubTotal()) }}
                        </td>
                    </tr>
                    @if($coupon = Cart::getConditions()->first())
                    <tr>
                        <td class="total-col" colspan="4">
                            Redem Discount :
                            {{ $coupon ? $coupon->getName() : 'No Voucher' }}
                        </td>
                        <td class="text-right product-price">
                            {{ $coupon ? number_format($coupon->getValue()) : 0 }}
                        </td>
                    </tr>
                    @endif
                    <tr>
                        <td colspan="4">Grand Total</td>
                        <td class="text-right product-price">{{ number_format(Cart::getTotal()) }}</td>
                    </tr>
                </tfoot>
            </table>

            <hr>

            <div class="cart-actions mb-6 pt-6" style="float: right;">
                <div class="coupon">
                    <input type="text" wire:model="coupon" class="input-text form-control" placeholder="Coupon code">
                    @if($coupon)
                    <button wire:click="removeCoupon" class="btn btn-dark">Remove</button>
                    @else
                    <button wire:click="updateCoupon" class="btn btn-dark">Apply</button>
                    @endif

                    <a class="btn btn-dark" href="{{ route('checkout') }}">Checkout</a>

                </div>
            </div>
        </div>

    </div>
</div>