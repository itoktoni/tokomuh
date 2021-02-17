@extends(Helper::setExtendFrontend())
@section('content')
<main class="main mt-2">
    <div class="page-content mb-10">
        <div class="container">
            <hr>
            <div class="row gutter-lg">
                <aside class="col-lg-4 col-md-4 right-sidebar sidebar-fixed sticky-sidebar-wrapper">
                    <div class="sidebar-overlay">
                        <a class="sidebar-close" href="#"><i class="d-icon-times"></i></a>
                    </div>
                    <a href="#" class="sidebar-toggle"><i class="fas fa-chevron-left"></i></a>
                    <div class="sidebar-content">
                        <div class="sticky-sidebar">
                            <div class="service-list mb-4">
                                <div class="icon-box icon-box-side icon-box3">
                                    <span class="icon-box-icon">
                                        <i class="	fas fa-copy"></i>
                                    </span>
                                    <div class="icon-box-content">
                                        <h4 class="icon-box-title">Promo Code</h4>
                                        <p>{{ $data->marketing_promo_code }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="banner banner-fixed mb-4">

                                <a href="{{ route('promo_page', ['slug' => $data->marketing_promo_slug])}}">
                                    <div
                                        class="banner banner-2 banner-fixed content-middle content-center overlay-light appear-animate">
                                        <figure>
                                            <img src="{{ Helper::files('promo/'.$data->marketing_promo_image) }}"
                                                alt="{{ $data->marketing_promo_name }}" width="380" height="250" />
                                        </figure>
                                        <div class="banner-content">
                                            <h3 class="banner-title font-weight-bold mb-2 mt-5">
                                                {{ $data->marketing_promo_name }}</h3>
                                            {!! $data->marketing_promo_description !!}
                                            @if(!empty($data->marketing_promo_link))
                                            <a href="{{ $data->marketing_promo_link }}"
                                                class="btn btn-dark btn-md mt-3 mb-5">
                                                {{ !empty($data->marketing_promo_button) ? $data->marketing_promo_button : 'SHOP NOW' }}
                                            </a>
                                            @endif
                                        </div>
                                    </div>
                                </a>

                                <figure>
                                    <img src="{{ Helper::files('promo/'.$data->marketing_promo_image) }}" alt="banner"
                                        width="280" height="320">
                                </figure>
                            </div>

                        </div>
                    </div>
                </aside>
                <div class="col-lg-8 col-md-8">

                    <section>
                        <h1 class="title title-link mb-4">{{ $data->marketing_promo_name }}
                            <!-- <a href="#" class="btn btn-link btn-slide-right">View more<i
                                    class="fa fa-chevron-right"></i></a> -->
                        </h1>

                        {!! $data->marketing_promo_page !!}
                    </section>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection