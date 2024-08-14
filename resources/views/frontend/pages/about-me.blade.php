@extends('frontend.templates.pages')
@section('title')
@section('content')
<div class="col-md-5 m-auto">
  <div class="container">
    <div class="row py-5">
      <div class="fs-3 fw-bold lh-sm mb-3">Tentang</div>
      <div class="mb-3"><img src="/company-profile/{{ $companyProfile->image }}" alt="" class="img-fluid w-100"></div>
      <div class="fs-5 fw-bold mb-2">{{ $companyProfile->name }}</div>
      <div class="lh-sm mb-3">{!! nl2br(e($companyProfile->description)) !!}</div>
      <div class="d-flex gap-3">
        @if($companyProfile->instagram != null)
          <a href="{{ $companyProfile->instagram }}"><i class="fa-brands fa-instagram fs-3"></i></a>
        @endif
        @if($companyProfile->facebook != null)
          <a href="{{ $companyProfile->facebook }}"><i class="fa-brands fa-facebook fs-3"></i></a>
        @endif
        @if($companyProfile->linkedin != null)
          <a href="{{ $companyProfile->linkedin }}"><i class="fa-brands fa-linkedin fs-3"></i></a>
        @endif
        @if($companyProfile->tiktok != null)
          <a href="{{ $companyProfile->tiktok }}"><i class="fa-brands fa-tiktok fs-3"></i></a>
        @endif
      </div>
    </div>
  </div>
</div>
@endsection