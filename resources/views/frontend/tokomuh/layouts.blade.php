<!DOCTYPE html>
<html lang="en">

<head>

    @include(Helper::setExtendFrontend('meta'))
    @include(Helper::setExtendFrontend('css'))
    @livewireStyles

</head>

<body class="home">
    <div class="page-wrapper">

        @include(Helper::setExtendFrontend('header'))

        <!-- End of Header -->
        <main class="main">
            @yield('content')
        </main>

        <!-- End of Main -->
        @include(Helper::setExtendFrontend('footer'))
        <!-- End of Footer -->
    </div>
    <!-- Sticky Footer -->

    @include(Helper::setExtendFrontend('minicon'))

    <!-- Scroll Top -->
    <a id="scroll-top" href="#top" title="Top" role="button" class="scroll-top"><i class="fas fa-chevron-up"></i></a>

    <a class="wa" target="_blank" href="https://api.whatsapp.com/send?phone={{ Helper::convertPhone(config('website.phone')) }}">
        <img class="wa" src="{{ Helper::files('logo/wa.png') }}" alt="wa">
    </a>

    @include(Helper::setExtendFrontend('mobile_menu'))
    @include(Helper::setExtendFrontend('js'))
    @livewireScripts

</body>

</html>