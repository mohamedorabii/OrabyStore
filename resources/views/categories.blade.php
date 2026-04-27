@extends('layouts.parent')

@section('title', 'Categories - OrabyStore')

@section('content')

{{-- Banner --}}
<section class="banner_area">
    <div class="banner_inner d-flex align-items-center">
        <div class="container">
            <div class="banner_content d-md-flex justify-content-between align-items-center">
                <div class="mb-3 mb-md-0">
                    <h2>Shop Categories</h2>
                    <p>Browse all our categories</p>
                </div>
                <div class="page_link">
                    <a href="{{ route('home') }}">Home</a>
                    <a href="{{ route('categories') }}">Categories</a>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Categories Section --}}
<section class="cat_product_area section_gap">
    <div class="container">
        <div class="row justify-content-center mb-40">
            <div class="col-lg-12">
                <div class="main_title">
                    <h2><span>Our</span> Categories</h2>
                </div>
            </div>
        </div>

        <div class="row">
            @foreach ($categories as $category)
            <div class="col-lg-4 col-md-6 mb-4 text-center">
                <div class="single-product">
                    <div class="product-img">
                        <img class="img-fluid w-100"
                            src="{{ asset('storage/' . $category->image) }}"
                            alt="{{ $category->name_en }}"
                            style="max-height:250px; min-height:250px; object-fit:cover;" />
                        <div class="p_icon">
                            <a href="{{ route('products', $category->id) }}" title="View products">
                                <i class="ti-eye"></i>
                            </a>
                        </div>
                    </div>
                    <div class="product-btm text-left">
                        <a href="{{ route('products', $category->id) }}" class="d-block" style="text-decoration:none;">
                            <h4>{{ $category->name_en }}</h4>
                              <p style="color:#56a97a;">Browse Products &rarr;</p>
                        </a>
                      
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        {{-- Pagination --}}
        @if ($categories->hasPages())
        <div class="row mt-4">
            <div class="col-12 text-center">
                <ul style="display:flex; gap:10px; justify-content:center; list-style:none; padding:0;">
                    @if ($categories->onFirstPage())
                        <li><span class="main_btn" style="opacity:0.5; cursor:not-allowed;">← Prev</span></li>
                    @else
                        <li><a href="{{ $categories->previousPageUrl() }}" class="main_btn">← Prev</a></li>
                    @endif

                    @foreach ($categories->getUrlRange(1, $categories->lastPage()) as $page => $url)
                        @if ($page == $categories->currentPage())
                            <li><span class="main_btn">{{ $page }}</span></li>
                        @else
                            <li><a href="{{ $url }}" class="main_btn" style="background:#fff; color:#F28123; border:1px solid #F28123;">{{ $page }}</a></li>
                        @endif
                    @endforeach

                    @if ($categories->hasMorePages())
                        <li><a href="{{ $categories->nextPageUrl() }}" class="main_btn">Next →</a></li>
                    @else
                        <li><span class="main_btn" style="opacity:0.5; cursor:not-allowed;">Next →</span></li>
                    @endif
                </ul>
            </div>
        </div>
        @endif

    </div>
</section>

@endsection