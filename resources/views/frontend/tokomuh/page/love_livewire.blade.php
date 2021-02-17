@auth
<a wire:click="actionWishlist('{{ $product_id }}')" class="size-guide">
    <i class="fa fas fa-heart mr-2 button-love {{ $love ? 'love' : '' }}">
    </i> Wishlist
</a>
@endauth