@extends('frontend.master')
@section('header')
<link rel="stylesheet" href="{{ url('homepage/css/shop.css') }}" />
@endsection

@section('content')
<div class="solar-breadcrumb">
    <button class="solar-breadcrumb-button"><div class="solar-breadcrumb-item">Home</div></button>
    <div class="solar-breadcrumb-divider">/</div>
    <div class="solar-breadcrumb-wrapper"><div class="solar-breadcrumb-item">Shop</div></div>
    <div class="solar-breadcrumb-divider">/</div>
    <div class="solar-breadcrumb-wrapper"><div class="solar-breadcrumb-item">All-in-one Solutions</div></div>
    <div class="solar-breadcrumb-divider">/</div>
    <div class="solar-breadcrumb-wrapper"><p class="solar-breadcrumb-current">Future-h All In One Solution</p></div>
</div>

<div class="solar-categories">
    <div class="solar-categories-div">
        <div class="solar-categories-all">
            <div class="solar-categories-inverters">
                <div class="solar-categories-item-link"><div class="solar-categories-item-text">Inverters</div></div>
                <div class="solar-categories-subitems">
                    <div class="solar-categories-subitem-link"><div class="solar-categories-subitem-text">Infini-Solar Inverters</div></div>
                    <div class="solar-categories-subitem-link"><div class="solar-categories-subitem-text">Solis Inverters</div></div>
                    <div class="solar-categories-subitem-link"><div class="solar-categories-subitem-text">Galaxy Solar Inverters</div></div>
                    <div class="solar-categories-subitem-link"><div class="solar-categories-subitem-text">East Inverters</div></div>
                    <div class="solar-categories-subitem-link"><div class="solar-categories-subitem-text">Deye Inverters</div></div>
                    <div class="solar-categories-subitem-link"><div class="solar-categories-subitem-text">Huawei Inverters</div></div>
                    <div class="solar-categories-subitem-link"><div class="solar-categories-subitem-text">Growatt Inverters</div></div>
                </div>
            </div>
            <div class="solar-categories-panels">
                <div class="solar-categories-item-link"><div class="solar-categories-item-text">Solar Panels</div></div>
                <div class="solar-categories-subitems">
                    <div class="solar-categories-subitem-link"><div class="solar-categories-subitem-text">Galaxy Solar Panels</div></div>
                    <div class="solar-categories-subitem-link"><div class="solar-categories-subitem-text">Jinko Solar Panels</div></div>
                    <div class="solar-categories-subitem-link"><div class="solar-categories-subitem-text">ZNSHINESOLA Panels</div></div>
                    <div class="solar-categories-subitem-link"><div class="solar-categories-subitem-text">JA Solar Panels</div></div>
                </div>
            </div>
            <div class="solar-categories-batteries">
                <div class="solar-categories-item-link"><div class="solar-categories-item-text">Lithium Batteries</div></div>
            </div>
            <div class="solar-categories-accessories">
                <div class="solar-categories-item-link"><div class="solar-categories-item-text">Accessories</div></div>
                <div class="solar-categories-subitems">
                    <div class="solar-categories-subitem-link"><div class="solar-categories-subitem-text">Mounting kits</div></div>
                    <div class="solar-categories-subitem-link"><div class="solar-categories-subitem-text">UPS</div></div>
                    <div class="solar-categories-subitem-link"><div class="solar-categories-subitem-text">Bracket</div></div>
                </div>
            </div>
            <div class="solar-categories-solutions">
                <div class="solar-categories-item-link"><div class="solar-categories-item-text">All-in-one Solutions</div></div>
                <div class="solar-categories-subitems">
                    <div class="solar-categories-subitem-link"><div class="solar-categories-subitem-text">All-In-one Solar Generators</div></div>
                    <div class="solar-categories-subitem-link"><div class="solar-categories-subitem-text">All-in-one Street Light</div></div>
                </div>
            </div>
            <div class="solar-categories-appliances">
                <div class="solar-categories-item-link"><div class="solar-categories-item-text">Home Appliances</div></div>
            </div>
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
        <div class="solar-categories-best-title">ALL INVERTERS</div>
        <div class="solar-categories-best-products">
            @for ($i = 0; $i < 9; $i++)
            <div class="solar-categories-best-item">
                <div class="solar-categories-best-product">
                    <div class="solar-categories-best-img-wrapper"><div class="solar-categories-best-img"></div></div>
                    <div class="solar-categories-best-details">
                        <div class="solar-categories-best-title-text">Huawei POWER MODULE...</div>
                        <div class="solar-categories-best-category">Inverters</div>
                    </div>
                    <div class="solar-categories-best-price">
                        <div class="solar-categories-best-current-price">₦3,100,000</div>
                        <div class="solar-categories-best-old-price">₦3,800,000</div>
                    </div>
                    <div class="solar-categories-best-status">
                        <div class="solar-categories-best-status-icon"><img src='{{ url("homepage/images/svgs/active.svg") }}' alt="active"/></div>
                        <div class="solar-categories-best-status-text">In stock</div>
                    </div>
                </div>
                <div class="solar-categories-best-action">
                    <div class="solar-categories-best-action-link"><div class="solar-categories-best-action-text">ADD TO CART</div></div>
                </div>
            </div>
            @endfor
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
            <div class="solar-recently-viewed-product">
                <div class="solar-recently-viewed-product-img"></div>
                <div class="solar-recently-viewed-product-details">
                    <div class="solar-recently-viewed-product-title"><div class="solar-recently-viewed-product-title-text">Growatt Inverter SPF 3000..</div></div>
                    <div class="solar-recently-viewed-product-price">₦373,000</div>
                </div>
            </div>
            <div class="solar-recently-viewed-product">
                <div class="solar-recently-viewed-product-img-prod"></div>
                <div class="solar-recently-viewed-product-details-alt">
                    <div class="solar-recently-viewed-product-title-wrapper"><div class="solar-recently-viewed-product-title-text">Huawei POWER MO...</div></div>
                    <div class="solar-recently-viewed-product-price">₦373,000</div>
                </div>
            </div>
            <div class="solar-recently-viewed-product">
                <div class="solar-recently-viewed-product-img-2"></div>
                <div class="solar-recently-viewed-product-details">
                    <div class="solar-recently-viewed-product-title"><div class="solar-recently-viewed-product-title-text">Growatt Inverter SPF 3000..</div></div>
                    <div class="solar-recently-viewed-product-price">₦373,000</div>
                </div>
            </div>
            <div class="solar-recently-viewed-product">
                <div class="solar-recently-viewed-product-img-3"></div>
                <div class="solar-recently-viewed-product-details-alt">
                    <div class="solar-recently-viewed-product-title-wrapper"><div class="solar-recently-viewed-product-title-text">Huawei POWER MO...</div></div>
                    <div class="solar-recently-viewed-product-price">₦373,000</div>
                </div>
            </div>
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
@endsection