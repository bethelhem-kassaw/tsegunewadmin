<section class="section">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-12 text-center">
        <h2 class="section-title" style="font-weight:600">Top Categories</h2>
      </div>
      <!-- categories item -->
      @foreach($categories as $cat)
      <div class="col-lg-4 col-md-4 mb-50">
        <div class="card p-0">
          <div class="border-bottom text-center hover-zoom-img">
            <a href="{{ route('shop.list', $cat->id) }}"><img src="{{ asset('storage/'.$cat->photos[0]) }}" class="rounded-top img-fluid w-100" alt="product-img"></a>
          </div>
          <ul class="d-flex list-unstyled pl-0 categories-list">
            @foreach($cat->photos as $photo)
            <li class="m-0 hover-zoom-img">
              <a href="{{ route('shop.list', $cat->id) }}"><img src="{{ asset('storage/'.$photo) }}" class="img-fluid w-100" alt="product-img"></a>
            </li>
            @endforeach
          </ul>
          <div class="px-4 py-3 border-top">
            <h4 class="d-inline-block mb-0 mt-1">{{ $cat->name }}</h4>
            <a href="{{ route('shop.list', $cat->id) }}" class="btn btn-sm btn-outline-primary float-right">view more</a>
          </div>
        </div>
      </div>
      @endforeach
    </div>
  </div>
</section>