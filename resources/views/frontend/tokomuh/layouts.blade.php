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

    @include(Helper::setExtendFrontend('mobile_menu'))
    @include(Helper::setExtendFrontend('js'))
    @livewireScripts
    
</body>

</html>