<!DOCTYPE html>
<html lang="zxx">


<head>
  <meta charset="utf-8">
  <title>Ezke</title>

  <!-- mobile responsive meta -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  @vite('resources/css/app.css')
  <!-- ** Plugins Needed for the Project ** -->
  <!-- Bootstrap -->
  <!-- <link rel="stylesheet" href="{{ asset('customer/plugins/bootstrap/bootstrap.min.css')}}">
  <link rel="stylesheet" href="{{ asset('customer/plugins/themify-icons/themify-icons.css')}}">
  <link rel="stylesheet" href="{{ asset('customer/plugins/slick/slick.css')}}">
  <link rel="stylesheet" href="{{ asset('customer/plugins/venobox/venobox.css')}}">
  <link rel="stylesheet" href="{{ asset('customer/plugins/animate/animate.css')}}">
  <link rel="stylesheet" href="{{ asset('customer/plugins/aos/aos.css')}}">
  <link rel="stylesheet" href="{{ asset('customer/plugins/bootstrap-touchspin-master/jquery.bootstrap-touchspin.min.css')}}">
  <link rel="stylesheet" href="{{ asset('customer/plugins/nice-select/nice-select.css')}}">
  <link rel="stylesheet" href="{{ asset('customer/plugins/bootstrap-slider/bootstrap-slider.min.css')}}"> -->

  <!-- Main Stylesheet -->
  <!-- <link href="{{ asset('customer/css/style.css')}}" rel="stylesheet"> -->

  <!--Favicon-->
  <link rel="shortcut icon" href="customer/images/favicon.png" type="image/x-icon">
  <link rel="icon" href="customer/images/favicon.png" type="image/x-icon">

</head>

<body class="font-poppins">

  <!-- preloader start -->
  <!-- <div class="preloader">
    <img src="customer/images/preloader.gif" alt="preloader">
  </div> -->
  <!-- preloader end -->

  <!-- <section class="signin-page account">
  <div class="container">
    <div class="row">
      <div class="col-md-6 mx-auto">
        <div class="block text-center">
          <a class="logo" href="{{ route('shop.index')}}">
            <img height="35px" src="{{ asset('customer/images/main-logo.png')}}" alt="logo">
          </a>
          <h2 class="text-center">Create Your Account</h2>
          <form class="text-left clearfix" method="post" action="{{ route('register')}}">
            @csrf
            <div class="form-group">
              <input type="text" name="first-name" value="{{ old('first-name')}}" class="form-control"  placeholder="First Name">
            </div>
            @error('first-name')
              <span style="color:red;padding-left:3px">{{ $message }}</span>
            @enderror
            <div class="form-group">
              <input type="text" name="last-name" value="{{ old('last-name')}}" class="form-control"  placeholder="Last Name">
            </div>
            @error('last-name')
              <span style="color:red;padding-left:3px">{{ $message }}</span>
            @enderror
            <div class="form-group">
              <input type="email" name="email" value="{{ old('email')}}" class="form-control"  placeholder="Email">
            </div>
            @error('email')
              <span style="color:red;padding-left:3px">{{ $message }}</span>
            @enderror
            <div class="form-group">
              <input type="tel" name="phone" value="{{ old('phone')}}" class="form-control" style="border-radius:0"  placeholder="Phone eg">
            </div>
            @error('phone')
              <span style="color:red;padding-left:3px">{{ $message }}</span>
            @enderror
            <div class="form-group">
              <input type="password" name="password" class="form-control"  placeholder="Password">
            </div>
            @error('password')
              <span style="color:red;padding-left:3px">{{ $message }}</span>
            @enderror
            <div class="form-group">
              <input type="password" name="password-confirmation" class="form-control"  placeholder="Password">
            </div>
            <div class="text-center">
              <button type="submit" class="btn btn-primary">Register</button>
            </div>
          </form>
          <p class="mt-3">Already hava an account ?<a href="{{ route('login')}}"> Login</a></p>
          <p><a href="{{ url('forgot-password') }}"> Forgot your password?</a></p>
        </div>
      </div>
    </div>
  </div>
</section> -->

  <!-- </div> -->
  <!-- /main wrapper -->

  <!-- jQuery -->
  <!-- <script src="{{ asset('customer/plugins/jQuery/jquery.min.js')}}"></script> -->
  <!-- Bootstrap JS -->
  <!-- <script src="{{ asset('customer/plugins/bootstrap/bootstrap.min.js')}}"></script>
<script src="{{ asset('customer/plugins/slick/slick.min.js')}}"></script>
<script src="{{ asset('customer/plugins/venobox/venobox.min.js')}}"></script>
<script src="{{ asset('customer/plugins/aos/aos.js')}}"></script>
<script src="{{ asset('customer/plugins/syotimer/jquery.syotimer.js')}}"></script>
<script src="{{ asset('customer/plugins/instafeed/instafeed.min.js')}}"></script>
<script src="{{ asset('customer/plugins/zoom-master/jquery.zoom.min.js')}}"></script>
<script src="{{ asset('customer/plugins/bootstrap-touchspin-master/jquery.bootstrap-touchspin.min.js')}}"></script>
<script src="{{ asset('customer/plugins/nice-select/jquery.nice-select.min.js')}}"></script>
<script src="{{ asset('customer/plugins/bootstrap-slider/bootstrap-slider.min.js')}}"></script> -->
  <!-- google map -->
  <!-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCcABaamniA6OL5YvYSpB3pFMNrXwXnLwU&amp;libraries=places"></script>
<script src="plugins/google-map/gmap.js"></script> -->
  <!-- Main Script -->
  <!-- <script src="{{ asset('customer/js/script.js')}}"></script> -->


  <main class="w-full h-screen overflow-hidden  font-poppins">
    <div class="h-full w-full flex flex-row relative ">
      <div class="h-full md:w-2/3  bg-gray-400 flex flex-row relative">

        <img class="w-[90%] h-full object-cover" src="{{ asset('customer/images/backgrounds/login.png')}}" alt="" srcset="">
        <img class=" h-full " src="{{ asset('customer/images/backgrounds/login2.png')}}" alt="" srcset="">
        <div class="fixed top-0 z-20 left-0 w-full lg:w-[66.7%] sm:h-20 h-16 bg-secondary-50 flex justify-between items-center px-4 sm:px-10">
          <div class="flex gap-10">
            <a class="font-poppins text-gray-500 text-base sm:text-lg">
              About
            </a>
            <a class="font-poppins text-gray-500 text-base sm:text-lg">
              Shop
            </a>
            <a class="font-poppins text-gray-500 text-base sm:text-lg">
              contact
            </a>
          </div>
          <div>
            <a class="logo" href="{{ route('shop.index')}}">
              <img class="w-20" src="{{ asset('customer/images/Logo/mainLogo.svg')}}" alt="logo">
            </a>
          </div>
        </div>
      </div>
      <form method="post" method="post" action="{{ route('register')}}" class="absolute top-0 right-0 w-[80%] lg:w-1/3 h-full z-10 bg-white flex flex-col gap-3 items-center justify-center overflow-y-auto">
        @csrf
        <div class="flex flex-col gap-3 w-full h-full sm:mt-10 md:mt-20 mt-32 mb-3 items-center sm:justify-center">
          <h1 class=" font-poppins font-medium text-3xl md:text-5xl ">
            Register
          </h1>
          <p class="font-poppins text-gray-700">To create your account</p>
          @if (session('status'))
          <p style="color:rgb(10, 200, 10) mb-5">{{ session('status') }}</p>
          @endif

          <div class="flex flex-col gap-2 w-[90%] sm:w-[80%] mt-3">
            <label class=" font-poppins text-gray-500" for="first_name">First Name</label>
            <input type="first_name" name="first_name" id="first_name" value="{{ old('first-name')}}" class="border border-gray-400 py-3 w-full rounded-lg">
            @error('first-name')
            <span style="color:red;padding-left:3px">{{ $message }}</span>
            @enderror
          </div>
          <div class="flex flex-col gap-2 w-[90%] sm:w-[80%]">
            <label class=" font-poppins text-gray-500" for="last_name">Last Name</label>
            <input type="last_name" name="last_name" id="last_name" value="{{ old('last-name')}}" class="border border-gray-400 py-3 w-full rounded-lg">
            @error('last-name')
            <span style="color:red;padding-left:3px">{{ $message }}</span>
            @enderror
          </div>
          <div class="flex flex-col gap-2 w-[90%] sm:w-[80%]">
            <label class=" font-poppins text-gray-500" for="phone">Phone</label>
            <input type="tel" name="phone" id="phone" value="{{ old('phone')}}" class="border border-gray-400 py-3 w-full rounded-lg">
            @error('phone')
            <span style="color:red;padding-left:3px">{{ $message }}</span>
            @enderror
          </div>
          <div class="flex flex-col gap-2 w-[90%] sm:w-[80%] ">
            <label class=" font-poppins text-gray-500" for="email">Email address</label>
            <input type="email" name="email" id="email" value="{{ old('email')}}" class="border border-gray-400 py-3 w-full rounded-lg">
            @error('email')
            <span style="color:red;padding-left:3px">{{ $message }}</span>
            @enderror
          </div>
          <div class="flex flex-col gap-2  w-[90%] sm:w-[80%]">
            <label class=" font-poppins text-gray-500" for="password">password</label>
            <input type="password" name="password" id="password" class="border border-gray-400 py-3 w-full rounded-lg">
            @error('password')
            <span style="color:red;padding-left:3px">{{ $message }}</span>
            @enderror
          </div>
          <div class="flex flex-col gap-2  w-[90%] sm:w-[80%]">
            <label class=" font-poppins text-gray-500" for="password-confirmation">Confirm password</label>
            <input type="password" name="password-confirmation" id="password-confirmation" class="border border-gray-400 py-3 w-full rounded-lg">
          </div>
          <p class="w-[80%] text-sm font-light mt-2 ">
            By creating an account, you agree to the Terms of use and Privacy Policy.
          </p>
          <button type="submit" class="sm:w-[80%] w-[90%] bg-primary-default text-white sm:py-3 py-2 rounded-full mt-5 text-lg">
            Sign up
          </button>
          <a href="{{ route('login')}}" class="font-poppins mb-2 hover:text-secondary-default">
            I have an account
          </a>
        </div>

      </form>

    </div>
  </main>
</body>

</html>