<div class="tab-pane fade show active profile-overview" id="profile-overview">
    <h5 class="card-title">Profile Details</h5>
    <div class="row">
        <div class="col-lg-3 col-md-4 label ">Full Name</div>
        <div class="col-lg-9 col-md-8">{{ $authUser->name }}</div>
    </div>
    <div class="row">
        <div class="col-lg-3 col-md-4 label">Email</div>
        <div class="col-lg-9 col-md-8">{{ $authUser->email }}</div>
    </div>
    <div class="row">
        <div class="col-lg-3 col-md-4 label">Phone</div>
        <div class="col-lg-9 col-md-8">{{ $authUser->phone }}</div>
    </div>
    <div class="row">
        <div class="col-lg-3 col-md-4 label">Designation</div>
        <div class="col-lg-9 col-md-8">{{ $authUser->designation }}</div>
    </div>
    <div class="row">
        <div class="col-lg-3 col-md-4 label">NID</div>
        <div class="col-lg-9 col-md-8">{{ $authUser->nid }}</div>
    </div>
    <div class="row">
        <div class="col-lg-3 col-md-4 label">Passport</div>
        <div class="col-lg-9 col-md-8">{{ $authUser->passport }}</div>
    </div>
    <div class="row">
        <div class="col-lg-3 col-md-4 label">Address</div>
        <div class="col-lg-9 col-md-8">{{ $authUser->address }}</div>
    </div>
    <div class="row">
        <div class="col-lg-3 col-md-4 label">Is Profile Completed</div>
        <div class="col-lg-9 col-md-8">
        @if($authUser->is_profile_completed)
            <i class="bi bi-check-circle-fill text-success"></i>
        @else
            <i class="bi bi-x-circle-fill text-danger"></i>
        @endif
        </div>
    </div>
</div>