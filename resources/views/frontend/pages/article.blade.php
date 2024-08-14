@extends('frontend.templates.pages')
@section('title')
@section('content')
<div class="col-md-5 m-auto">
  <div class="container">
    <div class="row py-5">
      <div class="lh-sm text-muted mb-1">{{ $article->category->title }}</div>
      <div class="fs-3 fw-bold lh-sm mb-2">{{ $article->title }}</div>
      <div class="lh-sm text-muted mb-3">{{ $article->created_at->format('d M Y') }}</div>
      <div class="mb-3"><img src="/article/{{ $article->image }}" alt="" class="img-fluid w-100"></div>
      <div class="lh-sm">{!! nl2br(e($article->description)) !!}</div>
    </div>
  </div>
</div>
@endsection