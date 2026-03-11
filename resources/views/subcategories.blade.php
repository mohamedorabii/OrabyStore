@extends('layouts.parent')

@section('title','Subcategories')

@section('content')

<h2 class="mb-4">Subcategories</h2>

<div class="row g-4">
    @for($i=1; $i<=8; $i++)
    <div class="col-md-3">
        <div class="card shadow-sm text-center p-3">
            <h6>Subcategory {{ $i }}</h6>
        </div>
    </div>
    @endfor
</div>

@endsection
