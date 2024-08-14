@extends('frontend.templates.pages')
@section('title')
@section('content')
<div class="container">
  <div class="row align-items-center g-3 py-5">
    <div class="col-md-4">
      <img src="/company-profile/{{ $companyProfile->image_banner_left }}" alt="" class="img-fluid">
    </div>
    <div class="col-md-4">
      <div class="text-center fs-3 fw-bold mb-3">{{ $companyProfile->title }}</div>
      <div class="text-center">{{ $companyProfile->subtitle }}</div>
    </div>
    <div class="col-md-4">
      <img src="/company-profile/{{ $companyProfile->image_banner_right }}" alt="" class="img-fluid">
    </div>
  </div>
  <div class="row py-3">
    <div class="fs-5 fw-bold">Category</div>
  </div>
  <div class="row g-3 pt-0 pb-5">
    @foreach ($categories as $category)
    <div class="col-md-3">
      <a href="{{ route('articles', ['slug' => $category->slug]) }}" class="text-decoration-none">
        <img src="/category/{{ $category->image }}" alt="" class="img-fluid mb-2">
        <div class="mb-1 fw-bold text-dark lh-sm">{{ $category->title }}</div>
        <div class="small text-dark lh-sm">{{ Str::limit($category->description, 100) }}</div>
      </a>
    </div>
    @endforeach
  </div>
</div>
@endsection