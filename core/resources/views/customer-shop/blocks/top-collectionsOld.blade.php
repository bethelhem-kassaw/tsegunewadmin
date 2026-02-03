<section class="section">
  <div class="container">
    <div class="row">
      <div class="col-lg-12 text-center">
        <h2 class="section-title" style="font-weight:600">Top Collections</h2>
      </div>
      <div class="col-12">
        <div class="collection-slider" style="border-radius:6px;">
          <!-- product -->
          @foreach ($collections as $product)
          <div class="col-lg-4 col-sm-6" style="border-radius:4px;padding-top:6px;padding-bottom:4px;">
            <div class="product card text-center">
              <div class="product-thumb">
                <div class="overflow-hidden position-relative">
                  <a href="{{ route('shop.product-single', $product->id) }}">
                    <img style="margin-left:auto;margin-right:auto;height:380px;object-fit: cover;object-position:top;border-bottom:solid 1px rgb(230,230,230);" class="img-fluid w-100 mb-3 img-first" src="{{ asset('storage/'.$product->photos[0])}}" alt="product-img">
                    @if(count($product->photos) > 0)
                    <img style="margin-left:auto;margin-right:auto;object-fit: cover;" class="img-fluid w-100 mb-3 img-second" src="{{ asset('storage/'.$product->photos[1])}}" alt="product-img">
                    @endif
                  </a>
                  <div class="btn-cart">
                    <a href="{{ route('shop.product-single', $product->id) }}" class="btn btn-primary btn-sm">Add To Cart</a>
                  </div>
                </div>
              </div>
              <div class="product-info">
                <h3 class="h5"><a class="text-color" href="{{ route('shop.product-single', $product->id) }}">{{$product->name}}</a></h3>
                <p class="h5 text-pripary">${{$product->price}}</p>
              </div>
            </div>
          </div>
          @endforeach
        </div>
      </div>
    </div>
  </div>
</section>