<div class="tab-pane fade pt-3" id="profile-change-password">
    <form method="POST" action="{{ route('profile.password.update') }}">
        @csrf
        <div class="row mb-3">
            <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">Current Password</label>
            <div class="col-md-8 col-lg-9">
                <input name="current_password" type="password" class="form-control" id="currentPassword">
                @error('current_password')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>
        <div class="row mb-3">
            <label for="password" class="col-md-4 col-lg-3 col-form-label">New Password</label>
            <div class="col-md-8 col-lg-9">
                <input name="password" type="password" class="form-control" id="password">
                @error('password')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>
        <div class="row mb-3">
            <label for="confirmedPassword" class="col-md-4 col-lg-3 col-form-label">Re-enter New Password</label>
            <div class="col-md-8 col-lg-9">
                <input name="password_confirmation" type="password" class="form-control" id="confirmedPassword">
            </div>
        </div>
        <div class="text-center">
            <button type="submit" class="btn btn-primary">Change Password</button>
        </div>
    </form>
</div>