@extends('layouts.parent')

@section('title', 'Subcategories - OrabyStore')

@section('content')

{{-- Banner --}}
<section class="banner_area">
    <div class="banner_inner d-flex align-items-center">
        <div class="container">
            <div class="banner_content d-md-flex justify-content-between align-items-center">
                <div class="mb-3 mb-md-0">
                    <h2>Subcategories</h2>
                    <p>Browse all our subcategories</p>
                </div>
                <div class="page_link">
                    <a href="{{ route('home') }}">Home</a>
                    <a href="{{ route('subcategories') }}">Subcategories</a>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Subcategories Section --}}
<section class="cat_product_area section_gap">
    <div class="container">
<div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="main_title">
                    <h2><span>Our</span> Subcategories</h2>
                </div>
            </div>
        </div>

        <div class="row">
            @foreach ($subcategories as $subcategory)
            <div class="col-lg-4 col-md-6 mb-4 text-center">
                <div class="single-product">
                    <div class="product-img">
                        <img class="img-fluid w-100"
                            src="{{ asset('storage/' . $subcategory->image) }}"
                            alt="{{ $subcategory->name_en }}" />
                        <div class="p_icon">
                            <a href="{{ route('subcategories.products', $subcategory->id) }}" title="View">
                                <i class="ti-eye"></i>
                            </a>
                        </div>
                    </div>
                    <div class="product-btm text-left">
                        <a href="{{ route('subcategories.products', $subcategory->id) }}" class="d-block">
                            <h4>{{ $subcategory->name_en }}</h4>
                             <p class="browse-link">Browse Products &rarr;</p>
                        </a>
                       
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        {{-- Pagination --}}
        @if ($subcategories->hasPages())
        <div class="row mt-4">
            <div class="col-12 text-center">
                <ul class="pagination-list">
                    @if ($subcategories->onFirstPage())
                        <li><span class="main_btn btn-disabled">← Prev</span></li>
                    @else
                        <li><a href="{{ $subcategories->previousPageUrl() }}" class="main_btn">← Prev</a></li>
                    @endif

                    @foreach ($subcategories->getUrlRange(1, $subcategories->lastPage()) as $page => $url)
                        @if ($page == $subcategories->currentPage())
                            <li><span class="main_btn">{{ $page }}</span></li>
                        @else
                            <li><a href="{{ $url }}" class="main_btn btn-outline-page">{{ $page }}</a></li>
                        @endif
                    @endforeach

                    @if ($subcategories->hasMorePages())
                        <li><a href="{{ $subcategories->nextPageUrl() }}" class="main_btn">Next →</a></li>
                    @else
                        <li><span class="main_btn btn-disabled">Next →</span></li>
                    @endif
                </ul>
            </div>
        </div>
        @endif

    </div>
</section>

@endsection