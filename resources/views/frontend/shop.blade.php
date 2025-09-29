@extends('frontend.master')
@section('header')
<link rel="stylesheet" href="{{ url('homepage/css/shop.css') }}" />
@endsection

@section('content')
<div class="solar-breadcrumb">
    <a href="/" class="solar-breadcrumb-button"><div class="solar-breadcrumb-item">Home</div></a>
    <div class="solar-breadcrumb-divider">/</div>
    <div class="solar-breadcrumb-wrapper">
        <a href='/shop'><div class="solar-breadcrumb-item">Shop</div></a>
    </div>
    @if(isset($category) && is_object($category))
        <div class="solar-breadcrumb-divider">/</div>
        <div class="solar-breadcrumb-wrapper"><a href="{{ route('shop.category', $category->slug) }}" class="solar-breadcrumb-current">{{ $category->name }}</a></div>
    @endif
</div>

<div class="solar-categories">
    <div class="solar-categories-div">
        <div class="solar-categories-all">
            @if(isset($categories) && $categories->count() > 0)
                <div class="category-grid-shop">
                    @foreach($categories as $category)
                        <div class="category-card-shop">
                            <a href="{{ route('shop.category', $category->slug) }}" class="category-link-shop">
                                <div class="category-content-shop">
                                    <div class="category-title-shop">{{ $category->name }}</div>
                                    <div class="category-arrow-shop">→</div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="category-grid-shop">
                    <div class="category-card-shop">
                        <div class="category-content-shop">
                            <div class="category-title-shop">No Categories Available</div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
        <div class="solar-categories-filter-box">
            <div class="solar-categories-filter-header"><div class="solar-categories-filter-title">FILTERS</div></div>
            <form action="{{ route('search') }}" method="GET" id="filter-form">
                <!-- Preserve search query -->
                @if(request('q'))
                    <input type="hidden" name="q" value="{{ request('q') }}">
                @endif
                
                <!-- Preserve brand filter if it exists -->
                @if(request('brand'))
                    <input type="hidden" name="brand" value="{{ request('brand') }}">
                @endif
                
                <div class="solar-categories-filter-mobile">
                    <select class="solar-categories-filter-select" name="category">
                        <option value="">All Categories</option>
                        @if(isset($categories))
                            @foreach($categories as $categoryOption)
                                <option value="{{ $categoryOption->slug }}" {{ request('category') == $categoryOption->slug ? 'selected' : '' }}>
                                    {{ $categoryOption->name }}
                                </option>
                            @endforeach
                        @endif
                    </select>
                    <div class="solar-categories-filter-price">
                        <select class="solar-categories-filter-select" name="min_price">
                            <option value="">Min Price: ₦0</option>
                            <option value="10000" {{ request('min_price') == '10000' ? 'selected' : '' }}>₦10,000</option>
                            <option value="50000" {{ request('min_price') == '50000' ? 'selected' : '' }}>₦50,000</option>
                            <option value="100000" {{ request('min_price') == '100000' ? 'selected' : '' }}>₦100,000</option>
                        </select>
                        <select class="solar-categories-filter-select" name="max_price">
                            <option value="">Max Price: ₦300,000,000</option>
                            <option value="200000" {{ request('max_price') == '200000' ? 'selected' : '' }}>₦200,000</option>
                            <option value="500000" {{ request('max_price') == '500000' ? 'selected' : '' }}>₦500,000</option>
                            <option value="1000000" {{ request('max_price') == '1000000' ? 'selected' : '' }}>₦1,000,000</option>
                        </select>
                    </div>
                    <button type="submit" class="solar-categories-filter-button">Apply Filters</button>
                </div>
                <div class="solar-categories-filter-desktop">
                    <div class="solar-categories-filter-group">
                        <div class="solar-categories-filter-label">Sort By Categories</div>
                        <select class="solar-categories-filter-select" name="category" style="width: 100%; margin-top: 10px;">
                            <option value="">All Categories</option>
                            @if(isset($categories))
                                @foreach($categories as $categoryOption)
                                    <option value="{{ $categoryOption->slug }}" {{ request('category') == $categoryOption->slug ? 'selected' : '' }}>
                                        {{ $categoryOption->name }}
                                    </option>
                                @endforeach
                            @endif
                        </select>
                    </div>
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
                                <input type="number" name="min_price" value="{{ request('min_price', 0) }}" placeholder="₦0" class="solar-categories-price-value" style="border: none; background: transparent; width: 100%;">
                            </div>
                            <div class="solar-categories-price-separator"></div>
                            <div class="solar-categories-price-field">
                                <input type="number" name="max_price" value="{{ request('max_price', 300000000) }}" placeholder="₦300,000,000" class="solar-categories-price-value" style="border: none; background: transparent; width: 100%;">
                            </div>
                        </div>
                        <button type="submit" class="solar-categories-price-button"><div class="solar-categories-price-button-text">Go</div></button>
                    </div>
                </div>
            </form>
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
              <p>No products found</p>
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
                                <div class="solar-recently-viewed-product-title">
                                    <div class="solar-recently-viewed-product-title-text">{{ Str::limit($product->name, 25) }}</div>
                                </div>
                                <div class="solar-recently-viewed-product-price">
                                    @if($product->discount_price && $product->discount_price < $product->price)
                                        ₦{{ number_format($product->discount_price, 0) }}
                                    @else
                                        ₦{{ number_format($product->price, 0) }}
                                    @endif
                                </div>
                            </div>
                        </div>
                    </a>
                @endforeach
            @else
                <div class="solar-recently-viewed-product">
                    <div class="solar-recently-viewed-product-img"></div>
                    <div class="solar-recently-viewed-prd">
                        <div class="solar-recently-viewed-product-title">
                            <div class="solar-recently-viewed-product-title-text">No Recent Products</div>
                        </div>
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