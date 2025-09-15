@extends('frontend.master')
@section('header')
<link rel="stylesheet" href="{{ url('homepage/css/shop.css') }}" />
@endsection

@section('content')
<div class="solar-breadcrumb">
    <a href="/" class="solar-breadcrumb-button"><div class="solar-breadcrumb-item">Home</div></a>
    <div class="solar-breadcrumb-divider">/</div>
    <div class="solar-breadcrumb-wrapper"><div class="solar-breadcrumb-item">Shop</div></div>
    @if(isset($category))
        <div class="solar-breadcrumb-divider">/</div>
        <div class="solar-breadcrumb-wrapper"><a href="{{ route('shop.category', $category->slug) }}" class="solar-breadcrumb-current">{{ $category->name }}</a></div>
    @endif
</div>

<div class="solar-categories">
    <div class="solar-categories-div">
        <div class="solar-categories-all">
            @if(isset($categories) && $categories->count() > 0)
                @foreach($categories as $category)
                    <div class="solar-categories-{{ Str::slug($category->name) }}">
                        <a href="{{ route('shop.category', $category->slug) }}" class="solar-categories-item-link">
                            <div class="solar-categories-item-text">{{ $category->name }}</div>
                        </a>
                        @if($category->products->count() > 0)
                            <div class="solar-categories-subitems">
                                @foreach($category->products->take(5) as $product)
                                    <a href="{{ route('shop.category', $category->slug) }}" class="solar-categories-subitem-link">
                                        <div class="solar-categories-subitem-text">{{ $product->name }}</div>
                                    </a>
                                @endforeach
                            </div>
                        @endif
                    </div>
                @endforeach
            @else
                <div class="solar-categories-default">
                    <div class="solar-categories-item-link"><div class="solar-categories-item-text">No Categories Available</div></div>
                </div>
            @endif
        </div>
        <div class="solar-categories-filter-box">
            <div class="solar-categories-filter-header"><div class="solar-categories-filter-title">FILTERS</div></div>
            <div class="solar-categories-filter-mobile">
                <select class="solar-categories-filter-select" name="brand">
                    <option value="">All Brands (1,250)</option>
                    <option value="brand1">Brand 1 (250)</option>
                    <option value="brand2">Brand 2 (21)</option>
                    <option value="brand3">Brand 3 (555)</option>
                    <option value="brand4">Brand 4 (23)</option>
                    <option value="brand5">Brand 5 (178)</option>
                    <option value="brand6">Brand 6 (100)</option>
                    <option value="brand7">Brand 7 (85)</option>
                    <option value="brand8">Brand 8 (64)</option>
                    <option value="brand9">Brand 9 (64)</option>
                </select>
                <div class="solar-categories-filter-price">
                    <select class="solar-categories-filter-select" name="price-min">
                        <option value="0">Min Price: ₦0</option>
                        <option value="10000">₦10,000</option>
                        <option value="50000">₦50,000</option>
                        <option value="100000">₦100,000</option>
                    </select>
                    <select class="solar-categories-filter-select" name="price-max">
                        <option value="300000000">Max Price: ₦300,000,000</option>
                        <option value="1000000">₦1,000,000</option>
                        <option value="500000">₦500,000</option>
                        <option value="200000">₦200,000</option>
                    </select>
                </div>
                <button class="solar-categories-filter-button">Apply Filters</button>
            </div>
            <div class="solar-categories-filter-desktop">
                <div class="solar-categories-filter-group">
                    <div class="solar-categories-filter-label">Sort By Brands</div>
                    <div class="solar-categories-filter-input"></div>
                    <div class="solar-categories-filter-scroll">
                        <div class="solar-categories-filter-check">
                            <div class="solar-categories-filter-check-input"></div>
                            <div class="solar-categories-filter-check-label">
                                <div class="solar-categories-filter-check-text">All Brands</div>
                                <div class="solar-categories-filter-check-count">(1,250)</div>
                            </div>
                        </div>
                        <div class="solar-categories-filter-check">
                            <div class="solar-categories-filter-check-input-unchecked"></div>
                            <div class="solar-categories-filter-check-label">
                                <div class="solar-categories-filter-brand-img"></div>
                                <div class="solar-categories-filter-check-count">(250)</div>
                            </div>
                        </div>
                        <div class="solar-categories-filter-check">
                            <div class="solar-categories-filter-check-input-unchecked"></div>
                            <div class="solar-categories-filter-check-label">
                                <div class="solar-categories-filter-brand-img-2"></div>
                                <div class="solar-categories-filter-check-count">(21)</div>
                            </div>
                        </div>
                        <div class="solar-categories-filter-check">
                            <div class="solar-categories-filter-check-input-unchecked"></div>
                            <div class="solar-categories-filter-check-label">
                                <div class="solar-categories-filter-brand-img-3"></div>
                                <div class="solar-categories-filter-check-count">(555)</div>
                            </div>
                        </div>
                        <div class="solar-categories-filter-check">
                            <div class="solar-categories-filter-check-input-unchecked"></div>
                            <div class="solar-categories-filter-check-label">
                                <div class="solar-categories-filter-brand-img-4"></div>
                                <div class="solar-categories-filter-check-count">(23)</div>
                            </div>
                        </div>
                        <div class="solar-categories-filter-check">
                            <div class="solar-categories-filter-check-input-unchecked"></div>
                            <div class="solar-categories-filter-check-label">
                                <div class="solar-categories-filter-brand-img-5"></div>
                                <div class="solar-categories-filter-check-count">(178)</div>
                            </div>
                        </div>
                        <div class="solar-categories-filter-check">
                            <div class="solar-categories-filter-check-input-unchecked"></div>
                            <div class="solar-categories-filter-check-label">
                                <div class="solar-categories-filter-brand-img-6"></div>
                                <div class="solar-categories-filter-check-count">(100)</div>
                            </div>
                        </div>
                        <div class="solar-categories-filter-check">
                            <div class="solar-categories-filter-check-input-unchecked"></div>
                            <div class="solar-categories-filter-check-label">
                                <div class="solar-categories-filter-brand-img-7"></div>
                                <div class="solar-categories-filter-check-count">(85)</div>
                            </div>
                        </div>
                        <div class="solar-categories-filter-check">
                            <div class="solar-categories-filter-check-input-unchecked"></div>
                            <div class="solar-categories-filter-check-label">
                                <div class="solar-categories-filter-brand-img-8"></div>
                                <div class="solar-categories-filter-check-count">(64)</div>
                            </div>
                        </div>
                        <div class="solar-categories-filter-check">
                            <div class="solar-categories-filter-check-input-unchecked"></div>
                            <div class="solar-categories-filter-check-label">
                                <div class="solar-categories-filter-brand-img-9"></div>
                                <div class="solar-categories-filter-check-count">(64)</div>
                            </div>
                        </div>
                        </div>
                    </div>
                </a>
                <div class="solar-categories-filter-group-price">
                    <div class="solar-categories-filter-label">Sort By Price</div>
                    <div class="solar-categories-price-range">
                        <div class="solar-categories-price-slider">
                            <div class="solar-categories-price-progress">
                                <div class="solar-categories-price-handle-min"></div>
                                <div class="solar-categories-price-handle-max"></div>
                            </div>
                        </div>
                    </div>
                    <div class="solar-categories-price-inputs">
                        <div class="solar-categories-price-field">
                            <div class="solar-categories-price-value">₦0</div>
                        </div>
                        <div class="solar-categories-price-separator"></div>
                        <div class="solar-categories-price-field">
                            <div class="solar-categories-price-value">₦300,000,000</div>
                        </div>
                    </div>
                    <button class="solar-categories-price-button"><div class="solar-categories-price-button-text">Go</div></button>
                </div>
            </div>
        </div>
        <div class="solar-categories-png" style="background-image: url('{{ url("homepage/images/home/catch-the-sun.png") }}'); background-size:cover">
            <div class="solar-categories-info">
                <p class="solar-categories-mobok">
                    <span class="solar-categories-text-bold">Catch Sun, Save Bill<br /></span>
                    <span class="solar-categories-text-light">Shop On Oplug</span>
                </p>
                <p class="solar-categories-starting-from">
                    <span class="solar-categories-text">Starting from </span>
                    <span class="solar-categories-price">₦98,000</span>
                </p>
            </div>
        </div>
    </div>
    <div class="solar-categories-best-seller">
        <div class="solar-categories-best-title">{{ isset($category) ? strtoupper($category->name) . ' PRODUCTS' : 'ALL PRODUCTS' }}</div>
        <div class="solar-categories-best-products">
            @if($products && $products->count() > 0)
                @foreach($products as $product)
                <div class="solar-categories-best-item">
                    <div class="solar-categories-best-product">
                        <a href="{{ route('prd', $product->slug) }}" style="text-decoration: none; color: inherit;">
                            <div class="solar-categories-best-img-wrapper">
                                @php
                                    $images = json_decode($product->image, true);
                                    $firstImage = $images[0] ?? $product->image;
                                @endphp
                                @php $imageUrl = url("uploads/products/".$firstImage); @endphp
                                <div class="solar-categories-best-img" style="background-image: url('{{ $imageUrl }}'); background-size: cover; background-position: center;"></div>
                            </div>
                        </a>
                        <div class="solar-categories-best-details">
                            <a href="{{ route('prd', $product->slug) }}" style="text-decoration: none; color: inherit;">
                                <div class="solar-categories-best-title-text">{{ Str::limit($product->name, 20) }}</div>
                            </a>
                            <div class="solar-categories-best-category">{{ $product->category->name ?? 'Product' }}</div>
                        </div>
                        <div class="solar-categories-best-price">
                            @if($product->discount_price && $product->discount_price < $product->price)
                                <div class="solar-categories-best-current-price">₦{{ number_format($product->discount_price, 0) }}</div>
                                <div class="solar-categories-best-old-price">₦{{ number_format($product->price, 0) }}</div>
                            @else
                                <div class="solar-categories-best-current-price">₦{{ number_format($product->price, 0) }}</div>
                            @endif
                        </div>
                        <div class="solar-categories-best-status">
                            @if($product->stock_quantity > 0)
                                <div class="solar-categories-best-status-icon"><img src='{{ url("homepage/images/svgs/active.svg") }}' alt="active"/></div>
                                <div class="solar-categories-best-status-text">In stock</div>
                            @else
                                <div class="solar-categories-best-status-icon"><img src='{{ url("homepage/images/svgs/cancel.svg") }}' alt="cancel"/></div>
                                <div class="solar-categories-best-status-text">Out of Stock</div>
                            @endif
                        </div>
                    </div>
                    <div class="solar-categories-best-action" data-product-id="{{ $product->id }}">
                        <div class="solar-categories-best-action-link add-to-cart-btn" data-product-id="{{ $product->id }}" style="cursor: pointer;"><div class="solar-categories-best-action-text">ADD TO CART</div></div>
                    </div>
                </div>
                @endforeach
            @else
                <div class="solar-categories-best-item">
                    <div class="solar-categories-best-product">
                        <div class="solar-categories-best-img-wrapper"><div class="solar-categories-best-img"></div></div>
                        <div class="solar-categories-best-details">
                            <div class="solar-categories-best-title-text">No Products Available</div>
                            <div class="solar-categories-best-category">Product</div>
                        </div>
                        <div class="solar-categories-best-price">
                            <div class="solar-categories-best-current-price">₦0</div>
                        </div>
                        <div class="solar-categories-best-status">
                            <div class="solar-categories-best-status-icon"><img src='{{ url("homepage/images/svgs/cancel.svg") }}' alt="cancel"/></div>
                            <div class="solar-categories-best-status-text">Out of Stock</div>
                        </div>
                    </div>
                    <div class="solar-categories-best-action">
                        <div class="solar-categories-best-action-link"><div class="solar-categories-best-action-text">ADD TO CART</div></div>
                    </div>
                </div>
            @endif
        </div>
        <div class="solar-categories-pagination">
            <div class="solar-categories-page-nav-active"><div class="solar-categories-page-number">1</div></div>
            <div class="solar-categories-page-nav"><div class="solar-categories-page-number">2</div></div>
            <div class="solar-categories-page-nav"><div class="solar-categories-page-number">3</div></div>
            <div class="solar-categories-page-nav"><div class="solar-categories-page-number">4</div></div>
            <div class="solar-categories-page-nav"><div class="solar-categories-page-number">...</div></div>
            <div class="solar-categories-page-nav"><div class="solar-categories-page-number">10</div></div>
            <div class="solar-categories-page-next"><div class="solar-categories-page-next-text">Next</div></div>
        </div>
    </div>
</div>

<div class="solar-recently-viewed">
    <div class="solar-recently-viewed-main">
        <div class="solar-recently-viewed-header">
            <div class="solar-recently-viewed-title">RECENTLY VIEWED</div>
            <div class="solar-recently-viewed-view-all"></div>
        </div>
        
        <div class="solar-recently-viewed-scrolling">
            @if($recentProducts && $recentProducts->count() > 0)
                @foreach($recentProducts as $product)
                <a href="{{ route('prd', $product->slug) }}" style="text-decoration: none; color: inherit;">
                    <div class="solar-recently-viewed-product">
                        @php
                            $images = json_decode($product->image, true);
                            $firstImage = $images[0] ?? $product->image;
                        @endphp
                        @if($product->image)
                            @php $recentImageUrl = url("uploads/products/" . $firstImage); @endphp
                            <div class="solar-recently-viewed-product-img" style="background-image: url('{{ $recentImageUrl }}'); background-size: cover; background-position: center;"></div>
                        @else
                            @php $defaultImageUrl = asset("homepage/images/default-product.png"); @endphp
                            <div class="solar-recently-viewed-product-img" style="background-image: url('{{ $defaultImageUrl }}'); background-size: cover; background-position: center;"></div>
                        @endif
                        <div class="solar-recently-viewed-prd">
                            <div class="solar-recently-viewed-product-title"><div class="solar-recently-viewed-product-title-text">{{ Str::limit($product->name, 25) }}</div></div>
                        <div class="solar-recently-viewed-product-price">
                            @if($product->discount_price && $product->discount_price < $product->price)
                                ₦{{ number_format($product->discount_price, 0) }}
                            @else
                                ₦{{ number_format($product->price, 0) }}
                            @endif
                        </div>
                    </div>
                </div>
                @endforeach
            @else
                <div class="solar-recently-viewed-product">
                    <div class="solar-recently-viewed-product-img"></div>
                    <div class="solar-recently-viewed-prd">
                        <div class="solar-recently-viewed-product-title"><div class="solar-recently-viewed-product-title-text">No Recent Products</div></div>
                        <div class="solar-recently-viewed-product-price">₦0</div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
document.addEventListener('DOMContentLoaded', () => {
    const recentlyViewed = document.querySelector('.solar-recently-viewed-scrolling');
    const prevButton = document.querySelector('.solar-recently-viewed-vector-wrapper');
    const nextButton = document.querySelector('.solar-recently-viewed-img-wrapper');

    if (recentlyViewed && prevButton && nextButton) {
        prevButton.addEventListener('click', () => {
            recentlyViewed.scrollBy({ left: -150, behavior: 'smooth' });
        });

        nextButton.addEventListener('click', () => {
            recentlyViewed.scrollBy({ left: 150, behavior: 'smooth' });
        });
    }
});
</script>

<!-- Cart functionality -->
<script src="{{ asset('js/cart.js') }}"></script>
@endsection