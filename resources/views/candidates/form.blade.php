<div class="dashboard-box">

    <div class="box-header">

        <h3>Account Information</h3>

    </div>

    <div class="form-grid">

        <div class="form-group">

            <label>Name</label>

            <input
                type="text"
                name="name"
                value="{{ old('name', $candidate->user->name ?? '') }}"
                placeholder="Enter candidate name">

            @error('name')
                <small class="error">{{ $message }}</small>
            @enderror

        </div>

        <div class="form-group">

            <label>Email</label>

            <input
                type="email"
                name="email"
                value="{{ old('email', $candidate->user->email ?? '') }}"
                placeholder="Enter email">

            @error('email')
                <small class="error">{{ $message }}</small>
            @enderror

        </div>

        @if(!isset($candidate))

            <div class="form-group">

                <label>Password</label>

                <input
                    type="password"
                    name="password"
                    placeholder="Enter password">

                @error('password')
                    <small class="error">{{ $message }}</small>
                @enderror

            </div>

            <div class="form-group">

                <label>Confirm Password</label>

                <input
                    type="password"
                    name="password_confirmation"
                    placeholder="Confirm password">

            </div>

        @endif

    </div>

</div>

<div class="dashboard-box" style="margin-top:25px;">

    <div class="box-header">

        <h3>Candidate Information</h3>

    </div>

    <div class="form-grid">

        <div class="form-group">

            <label>Phone</label>

            <input
                type="text"
                name="phone"
                value="{{ old('phone', $candidate->phone ?? '') }}"
                placeholder="01xxxxxxxxx">

            @error('phone')
                <small class="error">{{ $message }}</small>
            @enderror

        </div>

        <div class="form-group">

            <label>Experience (Years)</label>

            <input
                type="number"
                min="0"
                name="experience_years"
                value="{{ old('experience_years', $candidate->experience_years ?? '') }}"
                placeholder="Years of experience">

            @error('experience_years')
                <small class="error">{{ $message }}</small>
            @enderror

        </div>

        <div class="form-group full">

            <label>Address</label>

            <input
                type="text"
                name="address"
                value="{{ old('address', $candidate->address ?? '') }}"
                placeholder="Enter address">

            @error('address')
                <small class="error">{{ $message }}</small>
            @enderror

        </div>

        <div class="form-group full">

            <label>CV (PDF)</label>

            <input
                type="file"
                name="cv"
                accept=".pdf">

            @if(isset($candidate) && $candidate->cv)

                <small style="color: var(--color-text-secondary);">

                    Current File:

                    <a
                        href="{{ asset('storage/'.$candidate->cv) }}"
                        target="_blank"
                        style="color:blue; font-size: 14px; font-weight: 600;">

                        View CV

                    </a>

                </small>

            @endif

            @error('cv')
                <small class="error">{{ $message }}</small>
            @enderror

        </div>

        <div class="form-group full">

            <label>Bio</label>

            <textarea
                name="bio"
                rows="6"
                placeholder="Write candidate summary...">{{ old('bio', $candidate->bio ?? '') }}</textarea>

            @error('bio')
                <small class="error">{{ $message }}</small>
            @enderror

        </div>

    </div>

    <div class="form-actions">

        <a
            href="{{ route('candidates.index') }}"
            class="btn-secondary">

            <i class="fa-solid fa-arrow-left"></i>

            Cancel

        </a>

        <button
            type="submit"
            class="btn-primary">

            <i class="fa-solid fa-floppy-disk"></i>

            {{ isset($candidate) ? 'Update Candidate' : 'Create Candidate' }}

        </button>

    </div>

</div>
