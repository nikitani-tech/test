<div>
    @if($products->count() > 0)
        <div class="row gy-3 align-items-end mb-4">
            <div class="col-md-4">
                <label for="sortBy" class="form-label">Sort by</label>
                <select id="sortBy" class="form-select" wire:model.live="sort_by">
                    <option value="product_name" selected>Name</option>
                    <option value="price">Price</option>
                    <option value="stock">Product Availability</option>
                </select>
            </div>

            <div class="col-md-4">
                <label for="sortType" class="form-label">Sort Type</label>
                <select id="sortType" class="form-select" wire:model.live="asc">
                    <option value="1" selected>Sort by ascending</option>
                    <option value="0">Sort by descending</option>
                </select>
            </div>

            <div class="col-md-4">
                <label for="searchInput" class="form-label d-none d-md-block">Search</label>
                <form class="d-flex" role="search">
                    <input wire:model.live="search_request" class="form-control me-2" type="search" name="q" placeholder="Search Products..." aria-label="Search" id="searchInput">
                </form>
            </div>
        </div>
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-5 g-4">
            @foreach($products as $product)
                <div class="col">
                    <a href="/product/{{ $product->slug }}" class="text-decoration-none text-dark">
                        <div class="card h-100 shadow-sm">
                            <img src="{{ $product->getFirstMediaUrl('product_image') }}" class="card-img-top" alt="{{ $product->product_name }}">
                            <div class="card-body">
                                <h5 class="card-title">{{ $product->product_name }}</h5>
                                <p class="card-text text-primary fw-bold">₴{{ $product->price }}</p>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
        @if($products->count() > 0)
            <div class="mt-4 d-flex justify-content-center">
                {{ $products->links('livewire.shop-pagination') }}
            </div>
        @endif
    @else
        <h3>There no products here yet :)</h3>
    @endif
</div>
