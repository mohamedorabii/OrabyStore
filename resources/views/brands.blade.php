@extends('layouts.parent')

@section('title','Brands')

@section('content')

<h2 class="mb-4">Brands</h2>

<div class="row g-4">
    @for($i=1; $i<=6; $i++)
    <div class="col-md-4">
        <div class="card shadow-sm text-center p-4">
            <h5>Brand Name</h5>
        </div>
    </div>
    @endfor
</div>

@endsection
