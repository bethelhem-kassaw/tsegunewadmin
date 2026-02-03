<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">

  <!-- mobile responsive meta -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  @vite('resources/css/app.css')
  <!-- ** Plugins Needed for the Project ** -->

  <!--Favicon-->
  <link rel="shortcut icon" href="{{ asset('/customer/images/Logo/mainLogo.svg')}}" type="image/x-icon">
  <link rel="icon" href="{{ asset('/customer/images/Logo/mainLogo.svg')}}" type="image/x-icon">
  <script defer src="https://cdnjs.cloudflare.com/ajax/libs/alpinejs/3.13.5/cdn.js"></script>


  <title>
    {{ config('app.name') }}
    @yield('title')
  </title>
  @livewireStyles
</head>

<body class="auto-padd">

  <!-- preloader start -->
  <!-- <div class="preloader">
    <img src="{{ asset('/customer/images/preloader.gif')}}" alt="preloader">
  </div> -->
  <!-- preloader end -->
  <!-- navigation -->
  <div class="absolute top-0 right-0 left-0">
    @if(Route::currentRouteName() == 'shop.product-single' or Route::currentRouteName() == 'shop.comingSoon')
    @include('layouts.customer.navbarNew')
    @else
    @include('layouts.customer.navbar')

    @endif
  </div>

  @include('layouts.customer.bottombar')
  <!-- navigation -->

  {{ $slot }}
  <!-- <div class="whatsapp-container">
    <a target="blank" href="https://wa.me/">
      <img src="{{ asset('/customer/images/whatsapp3.gif')}}" alt="">
    </a>
  </div> -->
  <!-- footer -->
  @include('customer-shop.blocks.footer')
  <!-- /footer -->

  </div>
  <!-- /main wrapper -->
  @livewireScripts
  <script>
    Livewire.on('makeAlert', message => {
      var element = document.getElementById(message.type);
      var body = document.getElementById(message.type + "-body");
      body.innerHTML = message.message;
      element.className += " show";
      console.log(element)
      setTimeout(function() {
        element.className = element.className.replace(" show", "");
      }, 7000);
    });
  </script>

  <!-- jQuery -->
  <script src="{{ asset('/customer/plugins/jQuery/jquery.min.js')}}"></script>
  <!-- Bootstracustomer/p JS -->
  <!-- <script src="{{ asset('/customer/plugins/bootstrap/bootstrap.min.js')}}"></script> -->
  @if(Route::currentRouteName() == 'shop.index')
  <link rel="stylesheet" href="{{ asset('/customer/plugins/animate/animate.css')}}">
  <script src="{{ asset('/customer/plugins/slick/slick.min.js')}}"></script>
  <script src="{{ asset('/customer/plugins/bootstrap-slider/bootstrap-slider.min.js')}}"></script>
  @endif
  @if(Route::currentRouteName() == 'shop.product-single')
  <script src="{{ asset('/customer/plugins/slick/slick.min.js')}}"></script>
  <script src="{{ asset('/customer/plugins/venobox/venobox.min.js')}}"></script>
  <script src="{{ asset('/customer/plugins/zoom-master/jquery.zoom.min.js')}}"></script>
  <script src="{{ asset('/customer/plugins/syotimer/jquery.syotimer.js')}}"></script>
  @endif
  <!-- <script src="{{ asset('/customer/plugins/aos/aos.js')}}"></script> -->

  <!-- <script src="{{ asset('/customer/plugins/instafeed/instafeed.min.js')}}"></script> -->

  <script src="{{ asset('/customer/plugins/bootstrap-touchspin-master/jquery.bootstrap-touchspin.min.js')}}"></script>
  <!-- <script src="{{ asset('/customer/plugins/nice-select/jquery.nice-select.min.js')}}"></script> -->


  <!-- Main Script -->
  <script src="{{ asset('/customer/js/script.js')}}"></script>
</body>

</html>