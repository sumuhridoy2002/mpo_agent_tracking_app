@extends('layouts.master_dashboard')

@section('content')

  <section class="section profile">
    <div class="row">
      <div class="col-xl-4">
        <div class="card">
          <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
            @if($authUser->avatar)
              <img src="{{ $authUser->avatar }}" alt="Profile" class="rounded-circle">
            @else
              <img src="{{ asset('assets/img/profile-img.jpg') }}" alt="Default Profile" class="rounded-circle">
            @endif
            <h2>{{ $authUser->name }}</h2>
            <h3>{{ $authUser->designation }}</h3>
          </div>
        </div>
      </div>
      <div class="col-xl-8">
        <div class="card">
          <div class="card-body pt-3">
            <ul class="nav nav-tabs nav-tabs-bordered">
              <li class="nav-item">
                <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Overview</button>
              </li>
              <li class="nav-item">
                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit Profile</button>
              </li>
              <li class="nav-item">
                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-settings">Settings</button>
              </li>
              <li class="nav-item">
                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password">Change
                  Password</button>
              </li>
            </ul>
            <div class="tab-content pt-2">
            
              @include('profile.partials.overview')

              @include('profile.partials.edit')
              
              @include('profile.partials.settings')

              @include('profile.partials.password_update')
              
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection