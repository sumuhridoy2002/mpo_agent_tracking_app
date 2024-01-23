<div class="tab-pane fade profile-edit pt-3" id="profile-edit">
    <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
        @csrf
        <div class="row mb-3">
            <label for="profileImageInput" class="col-md-4 col-lg-3 col-form-label">Profile Image</label>
            <div class="col-md-8 col-lg-9">
                <img
                src="{{ $authUser->avatar ? asset($authUser->avatar) : asset('assets/img/profile-img.jpg') }}"
                alt="Profile" id="previewImage" style="max-width: 200px; max-height: 200px;">
                <div class="pt-2">
                    <input type="file" id="profileImageInput" name="avatar">
                </div>
                <small class="text-muted">Maximum file size: 2MB</small>
                @error('avatar')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>
        <div class="row mb-3">
            <label for="name" class="col-md-4 col-lg-3 col-form-label">Full Name</label>
            <div class="col-md-8 col-lg-9">
                <input name="name" type="text" class="form-control" id="name"
                value="{{ $authUser->name }}">
            </div>
        </div>
        <div class="row mb-3">
            <label for="email" class="col-md-4 col-lg-3 col-form-label">Email</label>
            <div class="col-md-8 col-lg-9">
                <input name="email" type="text" class="form-control" id="email" value="{{ $authUser->email }}">
            </div>
        </div>
        <div class="row mb-3">
            <label for="phone" class="col-md-4 col-lg-3 col-form-label">Phone</label>
            <div class="col-md-8 col-lg-9">
                <input name="phone" type="text" class="form-control" id="phone" value="{{ $authUser->phone }}">
            </div>
        </div>
        <div class="row mb-3">
            <label for="designation" class="col-md-4 col-lg-3 col-form-label">Designation</label>
            <div class="col-md-8 col-lg-9">
                <input name="designation" type="text" class="form-control" id="designation"
                value="{{ $authUser->designation }}">
            </div>
        </div>
        <div class="row mb-3">
            <label for="certification" class="col-md-4 col-lg-3 col-form-label">Certificaation</label>
            <div class="col-md-8 col-lg-9">
                <input name="certification" type="text" class="form-control" id="certification"
                value="{{ $authUser->certification }}">
            </div>
        </div>
        <div class="row mb-3">
            <label for="nid" class="col-md-4 col-lg-3 col-form-label">NID</label>
            <div class="col-md-8 col-lg-9">
                <input name="nid" type="text" class="form-control" id="nid" value="{{ $authUser->nid }}">
            </div>
        </div>
        <div class="row mb-3">
            <label for="passport" class="col-md-4 col-lg-3 col-form-label">Passport</label>
            <div class="col-md-8 col-lg-9">
                <input name="passport" type="text" class="form-control" id="passport"
                value="{{ $authUser->passport }}">
            </div>
        </div>
        <div class="row mb-3">
            <label for="address" class="col-md-4 col-lg-3 col-form-label">Address</label>
            <div class="col-md-8 col-lg-9">
                <input name="address" type="text" class="form-control" id="address"
                value="{{ $authUser->address }}">
            </div>
        </div>
        <div class="text-center">
            <button type="submit" class="btn btn-primary">Update</button>
        </div>
    </form>
</div>