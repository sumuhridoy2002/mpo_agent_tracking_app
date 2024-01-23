@extends('layouts.master_dashboard')

@section('content')
<section class="section">
  <div class="row">
     <div class="col-lg-12">
      <div class="card">
        <div class="card-header d-flex">
          <div class="float-start">
            <form action="{{ route('admins.index') }}" class="row g-3" method="get">
              <div class="col-auto">
                <label for="search">Search</label>
                <input type="search" name="search" value="{{ request('search') }}" class="form-control" id="search" placeholder="Search here...">
              </div>
              <div class="col-auto">
                <label for="from">From</label>
                <input type="date" name="from" class="form-control" id="from">
              </div>
              <div class="col-auto">
                <label for="upto">Upto</label>
                <input type="date" name="to" class="form-control" id="upto">
              </div>
              <div class="col-auto">
                <button type="submit" title="Filter admins" class="btn btn-sm btn-success mt-4">
                  <i class="bi bi-search"></i>
                </button>
                <a href="{{ route('admins.index') }}" title="Reset filter" class="btn btn-sm btn-danger mt-4">
                  <i class="bi bi-x-lg"></i>
                </a>
              </div>
            </form>
          </div>
          <div class="float-end mt-4 ms-auto">
            <a href="{{ route('admins.create') }}" class="btn btn-sm btn-success">
              <i class="bi bi-person-plus"></i>
            </a>
          </div>
        </div>
        <div class="card-body table-responsive">
          <table class="table text-center mt-3 table-bordered">
            <thead>
              <tr>
                <th>SL</th>
                <th>Name</th>
                <th>Phone</th>
                <th>Phone Verified</th>
                <th>Designation</th>
                <th>Avatar</th>
                <th>Certification</th>
                <th>NID</th>
                <th>Passport</th>
                <th>Address</th>
                <th>Account Status</th>
                <th>Profile Completed</th>
                <th>Created At</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($admins as $admin)
              <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $admin->name ?? "N/A" }}</td>
                <td>{{ $admin->phone ?? "N/A" }}</td>
                <td>
                  @if($admin->phone_verified)
                    <i class="bi bi-check-lg b-icon-font text-success"></i>
                  @else
                    <i class="bi bi-x-lg b-icon-font text-danger"></i>
                  @endif
                </td>
                <td>{{ $admin->designation ?? "N/A" }}</td>
                <td>
                  @if($admin?->avatar)
                      <img src="{{ $admin?->avatar }}" alt="Profile" class="avatar rounded-circle">
                  @else
                      <img src="{{ asset('assets/img/profile-img.jpg') }}" alt="Default Profile" class="avatar rounded-circle">
                  @endif
                </td>
                <td>{{ $admin->certification ?? "N/A" }}</td>
                <td>{{ $admin->nid ?? "N/A" }}</td>
                <td>{{ $admin->passport ?? "N/A" }}</td>
                <td>{{ $admin->address ?? "N/A" }}</td>
                <td>{{ $admin->account_status ?? "N/A" }}</td>
                <td>
                  @if($admin->is_profile_completed)
                    <i class="bi bi-check-lg b-icon-font text-success"></i>
                  @else
                    <i class="bi bi-x-lg b-icon-font text-danger"></i>
                  @endif
                </td>
                <td>{{ $admin->created_at ? $admin->created_at->diffForHumans() : "N/A" }}</td>
                <td>
                  <a href="" class="btn btn-sm btn-info">
                    <i class="bi bi-pencil-square"></i>
                  </a>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection