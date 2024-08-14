@extends('backend.templates.pages')
@section('title')
@section('header')
<h1>Company Profile</h1>
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
        
        <div class="float-right">
          <form id="filter" action="" method="GET">
            <div class="input-group">
              <input disabled type="text" class="form-control" placeholder="Search" name="search" id="search" value="">
            </div>
          </form>
        </div>

        <div class="clearfix mb-3"></div>

        <div class="table-responsive">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th class="align-items-center text-center text-nowrap">No.</th>
                <th class="align-items-center text-center text-nowrap">Title</th>
                <th class="align-items-center text-center text-nowrap">Name</th>
                <th class="align-items-center">Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach($companyProfiles as $companyProfile)
                <tr>
                  <td class="align-items-center text-center text-nowrap">{{ $loop->iteration }}</td>
                  <td class="align-items-center text-center text-nowrap">{{ $companyProfile->title }}</td>
                  <td class="align-items-center text-center text-nowrap">{{ $companyProfile->name }}</td>
                  <td class="align-items-center text-nowrap">
                    <button type="button" class="btn btn-icon btn-primary" data-toggle="modal" data-target="#editModal{{ $companyProfile->id }}"><i class="fas fa-pen"></i></button>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

@foreach($companyProfiles as $companyProfile)
<div class="modal fade" id="editModal{{ $companyProfile->id }}" data-backdrop="static" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Create</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ route('admin.company-profile.update', $companyProfile->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="modal-body">
          <div class="form-group">
            <label for="">Title <span class="text-danger">*</span></label>
            <input type="text" class="form-control" name="title" value="{{ $companyProfile->title }}">
            @error('title')<div class="text-danger">{{ $message }}</div>@enderror
          </div>
          <div class="form-group">
            <label for="">Subtitle <span class="text-danger">*</span></label>
            <textarea class="form-control" name="subtitle">{{ $companyProfile->subtitle }}</textarea>
            @error('title')<div class="text-danger">{{ $message }}</div>@enderror
          </div>
          <div class="form-group">
            <label for="">Image Banner Left <span class="text-danger">*</span></label>
            <input type="file" class="form-control" name="image_banner_left" value="{{ $companyProfile->image_banner_left }}">
            <a href="/company-profile/{{ $companyProfile->image_banner_left }}" target="_blank">{{ $companyProfile->image_banner_left }}</a>
            @error('image_banner_left')<div class="text-danger">{{ $message }}</div>@enderror
          </div>
          <div class="form-group">
            <label for="">Image Banner Right <span class="text-danger">*</span></label>
            <input type="file" class="form-control" name="image_banner_right" value="{{ $companyProfile->image_banner_right }}">
            <a href="/company-profile/{{ $companyProfile->image_banner_right }}" target="_blank">{{ $companyProfile->image_banner_right }}</a>
            @error('image_banner_right')<div class="text-danger">{{ $message }}</div>@enderror
          </div>
          <div class="form-group">
            <label for="">Image <span class="text-danger">*</span></label>
            <input type="file" class="form-control" name="image" value="{{ $companyProfile->image }}">
            <a href="/company-profile/{{ $companyProfile->image }}" target="_blank">{{ $companyProfile->image }}</a>
            @error('image')<div class="text-danger">{{ $message }}</div>@enderror
          </div>
          <div class="form-group">
            <label for="">Name <span class="text-danger">*</span></label>
            <input type="text" class="form-control" name="name" value="{{ $companyProfile->name }}">
            @error('name')<div class="text-danger">{{ $message }}</div>@enderror
          </div>
          <div class="form-group">
            <label for="">Description <span class="text-danger">*</span></label>
            <textarea class="form-control" name="description">{{ $companyProfile->description }}</textarea>
            @error('title')<div class="text-danger">{{ $message }}</div>@enderror
          </div>
          <div class="form-group">
            <label for="">Instagram <span class="text-danger">*</span></label>
            <input type="text" class="form-control" name="instagram" value="{{ $companyProfile->instagram }}">
            @error('instagram')<div class="text-danger">{{ $message }}</div>@enderror
          </div>
          <div class="form-group">
            <label for="">LinkedIn <span class="text-danger">*</span></label>
            <input type="text" class="form-control" name="linkedin" value="{{ $companyProfile->linkedin }}">
            @error('linkedin')<div class="text-danger">{{ $message }}</div>@enderror
          </div>
          <div class="form-group">
            <label for="">TikTok <span class="text-danger">*</span></label>
            <input type="text" class="form-control" name="tiktok" value="{{ $companyProfile->tiktok }}">
            @error('tiktok')<div class="text-danger">{{ $message }}</div>@enderror
          </div>
          <div class="form-group">
            <label for="">Facebook <span class="text-danger">*</span></label>
            <input type="text" class="form-control" name="facebook" value="{{ $companyProfile->facebook }}">
            @error('facebook')<div class="text-danger">{{ $message }}</div>@enderror
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