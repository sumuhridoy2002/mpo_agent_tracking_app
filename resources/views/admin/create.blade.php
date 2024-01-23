@extends('layouts.master_dashboard')

@section('content')
<section class="section">
  <div class="row">
     <div class="col-lg-12">
      <div class="card">
        <div class="card-header d-flex">
          <div class="float-start">
            <h4>Create admin</h4>
          </div>
          <div class="float-end ms-auto">
            <a href="{{ route('admins.index') }}" class="btn btn-sm btn-success">
              <i class="bi bi-list-columns-reverse"></i>
            </a>
          </div>
        </div>
        <div class="card-body">
          <form method="post" action="{{ route('admins.store') }}" class="col-sm-10 m-auto" enctype="multipart/form-data">
            @csrf
            <div class="form-group mt-2 row">
              <label for="name" class="col-sm-3 col-form-label text-md-end">Name : </label>
              <div class="col-sm-9">
                <input type="text" name="name" value="{{ old('name') }}" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="Admin name">
                @error('name')
                  <small class="text-danger">{{ $message }}</small>
                @enderror
              </div>
            </div>
            <div class="form-group mt-2 row">
              <label for="phone" class="col-sm-3 col-form-label text-md-end">Phone number : </label>
              <div class="col-sm-9">
                <input type="number" name="phone" value="{{ old('phone') }}" class="form-control @error('phone') is-invalid @enderror" id="phone" placeholder="Phone number">
                @error('phone')
                  <small class="text-danger">{{ $message }}</small>
                @enderror
              </div>
            </div>
            <div class="form-group mt-2 row">
              <label for="password" class="col-sm-3 col-form-label text-md-end">Password : </label>
              <div class="col-sm-9">
                <input type="password" name="password" value="{{ old('password') }}" class="form-control @error('password') is-invalid @enderror" id="password" placeholder="Password">
                @error('password')
                  <small class="text-danger">{{ $message }}</small>
                @enderror
              </div>
            </div>
            <div class="form-group mt-2 row">
              <label for="designation" class="col-sm-3 col-form-label text-md-end">Designation : </label>
              <div class="col-sm-9">
                <input type="text" name="designation" value="{{ old('designation') }}" class="form-control @error('designation') is-invalid @enderror" id="designation" placeholder="Designation">
                @error('designation')
                  <small class="text-danger">{{ $message }}</small>
                @enderror
              </div>
            </div>
            <div class="form-group mt-2 row">
              <label for="avatar" class="col-sm-3 col-form-label text-md-end">Avatar : </label>
              <div class="col-sm-9">
                <input type="file" name="avatar" value="{{ old('avatar') }}" class="form-control @error('avatar') is-invalid @enderror" id="avatar">
                @error('avatar')
                  <small class="text-danger">{{ $message }}</small>
                @enderror
              </div>
            </div>
            <div class="form-group mt-2 row">
              <label for="certification" class="col-sm-3 col-form-label text-md-end">Certification : </label>
              <div class="col-sm-9">
                <input type="text" name="certification" value="{{ old('certification') }}" class="form-control @error('certification') is-invalid @enderror" id="certification" placeholder="Certification">
                @error('certification')
                  <small class="text-danger">{{ $message }}</small>
                @enderror
              </div>
            </div>
            <div class="form-group mt-2 row">
              <label for="nid" class="col-sm-3 col-form-label text-md-end">NID number : </label>
              <div class="col-sm-9">
                <input type="number" name="nid" value="{{ old('nid') }}" class="form-control @error('nid') is-invalid @enderror" id="nid" placeholder="NID number">
                @error('nid')
                  <small class="text-danger">{{ $message }}</small>
                @enderror
              </div>
            </div>
            <div class="form-group mt-2 row">
              <label for="nid_pdf" class="col-sm-3 col-form-label text-md-end">NID PDF : </label>
              <div class="col-sm-9">
                <input type="file" name="nid_pdf" value="{{ old('nid_pdf') }}" class="form-control @error('nid_pdf') is-invalid @enderror" id="nid_pdf">
                @error('nid_pdf')
                  <small class="text-danger">{{ $message }}</small>
                @enderror
              </div>
            </div>
            <div class="form-group mt-2 row">
              <label for="passport" class="col-sm-3 col-form-label text-md-end">Passport number : </label>
              <div class="col-sm-9">
                <input type="number" name="passport" value="{{ old('passport') }}" class="form-control @error('passport') is-invalid @enderror" id="passport" placeholder="Passport number">
                @error('passport')
                  <small class="text-danger">{{ $message }}</small>
                @enderror
              </div>
            </div>
            <div class="form-group mt-2 row">
              <label for="passport_pdf" class="col-sm-3 col-form-label text-md-end">Passport PDF : </label>
              <div class="col-sm-9">
                <input type="file" name="passport_pdf" value="{{ old('passport_pdf') }}" class="form-control @error('passport_pdf') is-invalid @enderror" id="passport_pdf">
                @error('passport_pdf')
                  <small class="text-danger">{{ $message }}</small>
                @enderror
              </div>
            </div>
            <div class="form-group mt-2 row">
              <label for="address" class="col-sm-3 col-form-label text-md-end">Address : </label>
              <div class="col-sm-9">
                <textarea name="address" id="address" class="form-control @error('address') is-invalid @enderror" placeholder="Address">{{ old('address') }}</textarea>
                @error('address')
                  <small class="text-danger">{{ $message }}</small>
                @enderror
              </div>
            </div>
            <div class="form-group mt-2 row">
              <label class="col-sm-3"></label>
              <div class="col-sm-9 text-md-end">
                <input type="submit" class="btn btn-success" value="Create Admin">
              </div>
            </div>
          </form>
        
        </div>
      </div>
    </div>
  </div>
</section>
@endsection