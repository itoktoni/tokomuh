@auth
<button class="btn-product-icon btn-cart {{ $love ? 'love' : '' }}" wire:click="actionWishlist('{{ $product_id }}')">
    <i class="fa fas fa-heart"></i>
</button>
@endauth