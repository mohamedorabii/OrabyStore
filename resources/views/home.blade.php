@extends('layouts.parent')
@extends('layouts.hero-area')

@section('title', 'Home')

@section('content')

    <!-- product section -->
    <div class="product-section mt-150 mb-150">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2 text-center">
                    <div class="section-title">
                        <h3><span class="orange-text">Our</span> Categories</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquid, fuga quas itaque eveniet
                            beatae optio.</p>
                    </div>
                </div>
            </div>

            <div class="row">
                @foreach ($categories as $category)
                    <div class="col-lg-4 col-md-6 text-center">
                        <div class="single-product-item">
                            <div class="product-image">
                                <a href="{{ route('products', $category->id) }}"><img
                                        src="{{ asset('storage/' . $category->image) }}"class="card-img-top"
                                        style="max-height:250px !important; min-height:250px !important;">

                            </div>
                            <h3>{{ $category->name_en }}</h3>
                        </div>

                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- end product section -->


@endsection
