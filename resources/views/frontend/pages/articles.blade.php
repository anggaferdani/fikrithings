@extends('frontend.templates.pages')
@section('title')
@section('content')
<div class="container">
  <div class="row pt-5 pb-3">
    <div class="fs-5 fw-bold">{{ $category->title }}</div>
  </div>
  <div class="row g-3 pt-0 pb-5">
    @forelse ($articles as $article)
    <div class="col-md-3">
      <a href="{{ route('article', ['categorySlug' => $category->slug, 'slug' => $article->slug]) }}" class="text-decoration-none">
        <img src="/article/{{ $article->image }}" alt="" class="img-fluid mb-2">
        <div class="mb-1 fw-bold text-dark lh-sm">{{ $article->title }}</div>
        <div class="small text-dark lh-sm">{{ Str::limit($article->description, 100) }}</div>
      </a>
    </div>
    @empty
      <div class="col-md-3 m-auto"><img src="{{ asset('images/3d-casual-life-chatgpt-robot-with-question-mark-in-speech-bubble.png') }}" alt="" class="img-fluid"></div>
    @endforelse
  </div>
  <div class="d-flex justify-content-center py-3">{{ $articles->appends(request()->query())->links('pagination::bootstrap-4') }}</div>
</div>
@endsection