<div class="dropdown cart-dropdown">
    <a href="" class="cart-toggle">
        <i class="minicart-icon">
            <span class="cart-count">2</span>
        </i>
    </a>
    <!-- End of Cart Toggle -->
    <div class="dropdown-box">
        <div class="product product-cart-header">
            <span class="product-cart-counts">2 items</span>
            <span><a href="{{ route('cart') }}">View cart</a></span>
        </div>
        <div class="products scrollable">
            <div class="product product-cart">
                <div class="product-detail">
                    <a href="product.html" class="product-name">Solid Pattern In Fashion Summer
                        Dress</a>
                    <div class="price-box">
                        <span class="product-quantity">1</span>
                        <span class="product-price">$129.00</span>
                    </div>
                </div>
                <figure class="product-media">
                    <a href="#">
                        <img src="{{ Helper::frontend('images/cart/product-1.jpg') }}" alt="product" width="90"
                            height="90" />
                    </a>
                    <button class="btn btn-link btn-close">
                        <i class="fas fa-times"></i>
                    </button>
                </figure>
            </div>
            <!-- End of Cart Product -->
            <div class="product product-cart">
                <div class="product-detail">
                    <a href="product.html" class="product-name">Mackintosh Poket Backpack</a>
                    <div class="price-box">
                        <span class="product-quantity">1</span>
                        <span class="product-price">$98.00</span>
                    </div>
                </div>
                <figure class="product-media">
                    <a href="#">
                        <img src="{{ Helper::frontend('images/cart/product-2.jpg') }}" alt="product" width="90"
                            height="90" />
                    </a>
                    <button class="btn btn-link btn-close">
                        <i class="fas fa-times"></i>
                    </button>
                </figure>
            </div>
            <!-- End of Cart Product -->
        </div>
        <!-- End of Products  -->
        <div class="cart-total">
            <label>Subtotal:</label>
            <span class="price">$42.00</span>
        </div>
        <!-- End of Cart Total -->
        <div class="cart-action">
            <a href="{{ route('checkout') }}" class="btn btn-dark"><span>Checkout</span></a>
        </div>
        <!-- End of Cart Action -->
    </div>
    <!-- End of Dropdown Box -->
</div>