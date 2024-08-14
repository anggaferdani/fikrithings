@extends('backend.templates.pages')
@section('title')
@section('header')
<h1>Category</h1>
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
          <form id="filter" action="{{ route('admin.category.index') }}" method="GET">
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
                <th class="align-items-center text-center text-nowrap">Title</th>
                <th class="align-items-center text-center text-nowrap">Created At</th>
                <th class="align-items-center">Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach($categories as $category)
                <tr>
                  <td class="align-items-center text-center text-nowrap">{{ ($categories->currentPage() - 1) * $categories->perPage() + $loop->iteration }}</td>
                  <td class="align-items-center text-center text-nowrap"><img src="/category/{{ $category->image }}" alt="" class="" width="130"></td>
                  <td class="align-items-center text-center text-nowrap">{{ $category->title }}</td>
                  <td class="align-items-center text-center text-nowrap">{{ $category->created_at }}</td>
                  <td class="align-items-center text-nowrap">
                    <form action="{{ route('admin.category.destroy', $category->id) }}" method="POST">
                      @csrf
                      @method('DELETE')
                      <button type="button" class="btn btn-icon btn-primary" data-toggle="modal" data-target="#editModal{{ $category->id }}"><i class="fas fa-pen"></i></button>
                      <button type="button" class="btn btn-icon btn-danger delete"><i class="fas fa-trash"></i></button>
                    </form>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>

        <div class="float-right">
          {{ $categories->appends(request()->query())->links('pagination::bootstrap-4') }}
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
      <form action="{{ route('admin.category.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="modal-body">
          <div class="form-group">
            <label for="">Image <span class="text-danger">*</span></label>
            <input type="file" class="form-control" name="image">
            @error('image')<div class="text-danger">{{ $message }}</div>@enderror
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

@foreach($categories as $category)
<div class="modal fade" id="editModal{{ $category->id }}" data-backdrop="static" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Edit</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ route('admin.category.update', $category->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="modal-body">
          <div class="form-group">
            <label for="">Image <span class="text-danger">*</span></label>
            <input type="file" class="form-control" name="image" value="{{ $category->image }}">
            <a href="/category/{{ $category->image }}" target="_blank">{{ $category->image }}</a>
            @error('image')<div class="text-danger">{{ $message }}</div>@enderror
          </div>
          <div class="form-group">
            <label for="">Title <span class="text-danger">*</span></label>
            <input type="text" class="form-control" name="title" value="{{ $category->title }}">
            @error('title')<div class="text-danger">{{ $message }}</div>@enderror
          </div>
          <div class="form-group">
            <label for="">Description <span class="text-danger">*</span></label>
            <textarea class="form-control" name="description">{{ $category->description }}</textarea>
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