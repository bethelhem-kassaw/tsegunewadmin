<div class="container">
    <div class="row">
        <div class="col-lg-12 text-center">
            <h2 class="section-title">Our Newsletter</h2>
            <p class="mb-4">Subscribe to our Newsletter to receive early discount offers</p>
        </div>
        <div class="col-lg-6 col-md-8 col-sm-9 col-10 mx-auto">
            <form wire:submit="subscribe" class="d-flex flex-column flex-sm-row">
                <input wire:model.live="email" wire:keydown.enter="subscribe" type="email" required  class="form-control border-0 mb-4 mb-sm-0" id="mail" placeholder="Enter your email">
                <button type="submit" style="margin-left:10px" class="btn btn-primary">Subscribe</button>
            </form>
        </div>
    </div>
</div>