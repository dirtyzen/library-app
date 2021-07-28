

<div class="col-md-3 d-flex align-items-stretch">
    <div class="card mb-4">
        <img data-src="{{ $product->image }}" class="card-img-top lazyload" alt="{{ $product->title }}">
        <div class="card-body d-flex flex-column">
            <h5 class="card-title">{{ $product->title }}</h5>

            <h6 class="font-weight-bold text-muted mb-0">{{ Helpers::ownerTitle($product) }}</h6>
            <p class="card-text mb-2">{{ $product->owner }}</p>

            <h6 class="font-weight-bold text-muted mb-0">Publisher</h6>
            <p class="card-text mb-2">{{ $product->publisher }}</p>

            <h6 class="font-weight-bold text-muted mb-0">Category</h6>
            <p class="card-text">{{ $product->category->name }}</p>

            <a href="{{ route('productDetail', [$product->category->slug, $product->slug, $product->id]) }}" class="btn btn-primary mt-auto">Details / Lease</a>
        </div>
    </div>
</div>
