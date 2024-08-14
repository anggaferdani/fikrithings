@extends('backend.templates.pages')
@section('title')
@section('header')
<h1>Article</h1>
@endsection
@section('content')
<div class="row">
  <div class="col-12">

    @if(Session::get('success'))
      <div class="alert alert-important alert-primary" role="alert">
        {{ Session::get('success') }}
      </div>
    @endif
  
    <div class="card">
      <div class="card-body">
        <div class="float-left">
          <button type="button" class="btn btn-icon btn-primary" data-toggle="modal" data-target="#createModal"><i class="fas fa-plus"></i></button>
        </div>
        <div class="float-right">
          <form id="filter" action="{{ route('admin.article.index') }}" method="GET">
            <div class="input-group">
              <input type="text" class="form-control" placeholder="Search" name="search" id="search" value="">
            </div>
          </form>
        </div>

        <div class="clearfix mb-3"></div>

        <div class="table-responsive">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th class="align-items-center text-center text-nowrap">No.</th>
                <th class="align-items-center text-center text-nowrap">Image</th>
                <th class="align-items-center text-center text-nowrap">Category</th>
                <th class="align-items-center text-center text-nowrap">Slug</th>
                <th class="align-items-center text-center text-nowrap">Title</th>
                <th class="align-items-center text-center text-nowrap">Created At</th>
                <th class="align-items-center">Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach($articles as $article)
                <tr>
                  <td class="align-items-center text-center text-nowrap">{{ ($articles->currentPage() - 1) * $articles->perPage() + $loop->iteration }}</td>
                  <td class="align-items-center text-center text-nowrap"><img src="/article/{{ $article->image }}" alt="" class="" width="130"></td>
                  <td class="align-items-center text-center text-nowrap">{{ $article->category->title }}</td>
                  <td class="align-items-center text-center text-nowrap">{{ $article->slug }}</td>
                  <td class="align-items-center text-center text-nowrap">{{ $article->title }}</td>
                  <td class="align-items-center text-center text-nowrap">{{ $article->created_at }}</td>
                  <td class="align-items-center text-nowrap">
                    <form action="{{ route('admin.article.destroy', $article->id) }}" method="POST">
                      @csrf
                      @method('DELETE')
                      <button type="button" class="btn btn-icon btn-primary" data-toggle="modal" data-target="#editModal{{ $article->id }}"><i class="fas fa-pen"></i></button>
                      <button type="button" class="btn btn-icon btn-danger delete"><i class="fas fa-trash"></i></button>
                    </form>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>

        <div class="float-right">
          {{ $articles->appends(request()->query())->links('pagination::bootstrap-4') }}
        </div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="createModal" data-backdrop="static" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Create</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ route('admin.article.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="modal-body">
          <div class="form-group">
            <label for="">Image <span class="text-danger">*</span></label>
            <input type="file" class="form-control" name="image">
            @error('image')<div class="text-danger">{{ $message }}</div>@enderror
          </div>
          <div class="form-group">
            <label for="">Category <span class="text-danger">*</span></label>
            <select class="form-control select2" name="category_id" style="width: 100%;">
              <option disabled selected value="">Select</option>
              @foreach($categories as $category)
                <option value="{{ $category->id }}">{{ $category->title }}</option>
              @endforeach
            </select>
            @error('category_id')<div class="text-danger">{{ $message }}</div>@enderror
          </div>
          <div class="form-group">
            <label for="">Title <span class="text-danger">*</span></label>
            <input type="text" class="form-control" name="title">
            @error('title')<div class="text-danger">{{ $message }}</div>@enderror
          </div>
          <div class="form-group">
            <label for="">Description <span class="text-danger">*</span></label>
            <textarea class="form-control" name="description"></textarea>
            @error('title')<div class="text-danger">{{ $message }}</div>@enderror
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Submit</button>
        </div>
      </form>
    </div>
  </div>
</div>

@foreach($articles as $article)
<div class="modal fade" id="editModal{{ $article->id }}" data-backdrop="static" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Edit</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ route('admin.article.update', $article->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="modal-body">
          <div class="form-group">
            <label for="">Image <span class="text-danger">*</span></label>
            <input type="file" class="form-control" name="image" value="{{ $article->image }}">
            <a href="/article/{{ $article->image }}" target="_blank">{{ $article->image }}</a>
            @error('image')<div class="text-danger">{{ $message }}</div>@enderror
          </div>
          <div class="form-group">
            <label for="">Category <span class="text-danger">*</span></label>
            <select class="form-control select2" name="category_id" style="width: 100%;">
              <option disabled selected value="">Select</option>
              @foreach($categories as $category)
                <option value="{{ $category->id }}" @if($category->id == $article->category_id) @selected(true) @endif>{{ $category->title }}</option>
              @endforeach
            </select>
            @error('category_id')<div class="text-danger">{{ $message }}</div>@enderror
          </div>
          <div class="form-group">
            <label for="">Title <span class="text-danger">*</span></label>
            <input type="text" class="form-control" name="title" value="{{ $article->title }}">
            @error('title')<div class="text-danger">{{ $message }}</div>@enderror
          </div>
          <div class="form-group">
            <label for="">Description <span class="text-danger">*</span></label>
            <textarea class="form-control" name="description">{{ $article->description }}</textarea>
            @error('title')<div class="text-danger">{{ $message }}</div>@enderror
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Submit</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endforeach
@endsection
@push('scripts')
<script>
  document.addEventListener("DOMContentLoaded", function() {
      document.getElementById('search').addEventListener('input', function() {
          document.getElementById('filter').submit();
      });
  });
</script>
<script>
  const urlParams = new URLSearchParams(window.location.search);
  const searchQuery = urlParams.get('search');

  document.addEventListener("DOMContentLoaded", function() {
      const searchInput = document.getElementById('search');

      if (searchQuery) {
          searchInput.value = searchQuery;
      }
  });
</script>
@endpush