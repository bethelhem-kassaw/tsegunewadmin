<!DOCTYPE html>
<html lang="zxx">

<head>
  <meta charset="utf-8">
  <title>EzKe Exports</title>

  <!-- mobile responsive meta -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">



  <!--Favicon-->
  <link rel="shortcut icon" href="{{ asset('customer/images/favicon.png')}}" type="image/x-icon">
  <link rel="icon" href="{{ asset('customer/images/favicon.png')}}" type="image/x-icon">
  <!-- Preloader CSS -->

  @livewireStyles

</head>

<body class="w-screen">

  <!-- preloader start -->
  <div class="preloader">
    <img src="{{ asset('customer/images/preloader.gif')}}" alt="preloader">
  </div>
  <!-- preloader end -->

  <!-- header -->
  <!-- <header> -->
  <!-- top advertise -->
  <!-- <div class="alert alert-secondary alert-dismissible fade show rounded-0 pb-0 mb-0" role="alert">
    <div class="d-flex justify-content-between">
      <p>SAVE UP TO $50</p>
      <h4>SALE!</h4>
      <div class="shop-now">
        <a href="shop.html" class="btn btn-sm btn-primary">Shop Now</a>
      </div>
    </div>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div> -->

  <!-- top header -->
  <!-- <div class="top-header">
      <div class="row">
        <div class="col-lg-6 text-center text-lg-left">
          <p class="text-white mb-lg-0 mb-1">Free Shipping On All Addis Ababa Orders • Express delivery</p>
        </div>
        <div class="col-lg-6 text-center text-lg-right">
          <ul class="list-inline">
            <li class="list-inline-item"><img src="customer/images/flag.jpg" alt="flag"></li>
            <li class="list-inline-item"><a href="{{ route('login')}}">My Accounts</a></li>
            <li class="list-inline-item">
              <form action="#">
                <select class="country" name="country">
                  <option value="USD">USD</option>
                  <option value="JPN">JPN</option>
                  <option value="BAN">BAN</option>
                </select>
              </form>
            <li class="list-inline-item">
              <a class="active" href="#">EN</a>
              <a href="#">FR</a>
            </li>
          </ul>
        </div>
      </div>
    </div> -->
  <!-- /top-header -->
  <!-- </header> -->

  <!-- navigation -->
  <section>
    <header class="absolute top-0 left-0 ">
      @include('layouts.customer.navbar')

    </header>


    {{ $slot }}

    <!-- footer -->
    <footer class="fixed bottom-0">
      @include('customer-shop.blocks.footer')
    </footer>
    <!-- /footer -->
  </section>
  <script>
    window.addEventListener('load', function() {
      document.querySelector('.preloader').classList.add('hidden');
    });
  </script>
  <!-- /main wrapper -->
  @livewireScripts

</body>

</html>