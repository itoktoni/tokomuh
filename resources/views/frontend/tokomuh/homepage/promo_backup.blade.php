<section class="banner-group mb-9 container text-uppercase appear-animate">
    <div class="row">

        @forelse($promos as $promo)
        <div class="col-lg-4 col-sm-6 mb-4">
            <a href="{{ route('promo_page', ['slug' => $promo->marketing_promo_slug])}}">
                <div class="banner banner-2 banner-fixed content-middle content-center overlay-light appear-animate">
                    <figure>
                        <img src="{{ Helper::files('promo/'.$promo->marketing_promo_image) }}"
                            alt="{{ $promo->marketing_promo_name }}" width="380" height="250" />
                    </figure>
                    <div class="banner-content">
                        <h3 class="banner-title font-weight-bold mb-0 mt-5">{{ $promo->marketing_promo_name }}</h3>
                        {!! $promo->marketing_promo_description !!}
                        @if(!empty($promo->marketing_promo_link))
                        <a href="{{ $promo->marketing_promo_link }}" class="btn btn-dark btn-md mt-3 mb-5">
                            {{ !empty($promo->marketing_promo_button) ? $promo->marketing_promo_button : 'SHOP NOW' }}
                        </a>
                        @endif
                    </div>
                </div>
            </a>
        </div>
        @empty
        @endforelse

    </div>
</section>