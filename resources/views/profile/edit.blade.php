<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Profile – Wazaaf</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { background: #f0f2f8; font-family: 'Segoe UI', system-ui, sans-serif; color: #1a1a2e; }

        /* NAVBAR */
        .navbar-custom { background: #fff; border-bottom: 1px solid #e5e9f0; height: 64px; position: sticky; top: 0; z-index: 100; display: flex; align-items: center; padding: 0 32px; }
        .navbar-brand-custom { display: flex; align-items: center; gap: 8px; font-size: 20px; font-weight: 700; color: #1a56db; text-decoration: none; }
        .navbar-brand-custom .brand-icon { background: #1a56db; color: #fff; width: 32px; height: 32px; border-radius: 8px; display: flex; align-items: center; justify-content: center; }
        .nav-links { display: flex; align-items: center; gap: 4px; margin: 0 auto; }
        .nav-links a { font-size: 14px; color: #6b7280; padding: 8px 16px; border-radius: 6px; text-decoration: none; font-weight: 500; border-bottom: 2px solid transparent; transition: all 0.15s; }
        .nav-links a:hover { color: #1a1a2e; }
        .nav-links a.active { color: #1a56db; border-bottom: 2px solid #1a56db; border-radius: 0; }
        .navbar-right { display: flex; align-items: center; gap: 16px; margin-left: auto; }
        .notif-btn { position: relative; background: none; border: none; cursor: pointer; color: #6b7280; font-size: 18px; padding: 4px; text-decoration: none; }
        .notif-badge { position: absolute; top: -2px; right: -4px; background: #ef4444; color: #fff; font-size: 10px; width: 16px; height: 16px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: 700; }
        .user-menu { display: flex; align-items: center; gap: 8px; padding: 4px 8px; border-radius: 8px; text-decoration: none; }
        .user-avatar-sm { width: 34px; height: 34px; border-radius: 50%; background: #1a56db; color: #fff; display: flex; align-items: center; justify-content: center; font-weight: 700; font-size: 14px; }
        .user-name { font-size: 14px; font-weight: 500; color: #1a1a2e; }
        .btn-logout-nav { background: none; border: none; color: #6b7280; font-size: 13px; cursor: pointer; padding: 4px 8px; }
        .btn-logout-nav:hover { color: #ef4444; }

        /* PAGE */
        .page-wrapper { max-width: 880px; margin: 40px auto; padding: 0 24px 60px; }
        .page-header { margin-bottom: 24px; }
        .page-title { font-size: 26px; font-weight: 800; color: #0f172a; margin-bottom: 4px; }
        .page-subtitle { font-size: 14px; color: #6b7280; }

        /* PROFILE HEADER CARD */
        .profile-hero { background: linear-gradient(135deg, #1a3a8f, #1a56db); border-radius: 16px; padding: 32px; display: flex; align-items: center; gap: 20px; margin-bottom: 24px; color: #fff; }
        .profile-avatar { width: 76px; height: 76px; border-radius: 50%; background: rgba(255,255,255,0.18); display: flex; align-items: center; justify-content: center; font-size: 30px; font-weight: 800; flex-shrink: 0; border: 2px solid rgba(255,255,255,0.35); }
        .profile-hero-name { font-size: 22px; font-weight: 800; }
        .profile-hero-email { font-size: 13.5px; opacity: 0.85; margin-top: 2px; }
        .profile-hero-meta { font-size: 12.5px; opacity: 0.75; margin-top: 8px; display: flex; gap: 14px; flex-wrap: wrap; }

        /* STATS ROW */
        .stats-row { display: grid; grid-template-columns: repeat(4, 1fr); gap: 14px; margin-bottom: 24px; }
        .stat-card { background: #fff; border: 1px solid #e5e9f0; border-radius: 12px; padding: 16px 18px; }
        .stat-number { font-size: 24px; font-weight: 800; color: #0f172a; }
        .stat-label { font-size: 12px; color: #9ca3af; font-weight: 500; margin-top: 2px; }
        .stat-card.pending .stat-number { color: #f59e0b; }
        .stat-card.accepted .stat-number { color: #16a34a; }
        .stat-card.rejected .stat-number { color: #ef4444; }

        /* MESSAGES */
        .alert-success { background:#dcfce7;border:1px solid #bbf7d0;border-radius:10px;padding:14px 18px;margin-bottom:20px;display:flex;align-items:center;gap:10px;font-size:14px;color:#16a34a;font-weight:500; }
        .alert-error-box { background:#fee2e2;border:1px solid #fca5a5;border-radius:8px;padding:12px 16px;margin-bottom:20px; }
        .alert-error-box div { font-size:13px;color:#dc2626;display:flex;align-items:center;gap:6px;margin-bottom:4px; }

        /* FORM CARD */
        .form-card { background: #fff; border: 1px solid #e5e9f0; border-radius: 16px; padding: 32px; margin-bottom: 24px; }
        .form-card h2 { font-size: 18px; font-weight: 800; color: #0f172a; margin-bottom: 4px; display: flex; align-items: center; gap: 8px; }
        .form-card h2 i { color: #1a56db; font-size: 16px; }
        .form-card .subtitle { font-size: 13.5px; color: #6b7280; margin-bottom: 24px; }
        .form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 18px; }
        .form-group { margin-bottom: 20px; }
        .form-label-custom { display: block; font-size: 13px; font-weight: 600; color: #374151; margin-bottom: 7px; }
        .form-label-custom span { color: #ef4444; }
        .form-input { width: 100%; padding: 11px 14px; border: 1.5px solid #e5e9f0; border-radius: 8px; font-size: 14px; color: #1a1a2e; outline: none; transition: border-color 0.15s; background: #fff; font-family: inherit; }
        .form-input:focus { border-color: #1a56db; }
        .form-input.error { border-color: #ef4444; }
        .error-msg { font-size: 12px; color: #ef4444; margin-top: 5px; display: flex; align-items: center; gap: 4px; }
        .input-hint { font-size: 12px; color: #9ca3af; margin-top: 5px; }

        .file-drop { border: 2px dashed #d1d5db; border-radius: 10px; padding: 22px; text-align: center; cursor: pointer; transition: all 0.15s; background: #fafafa; }
        .file-drop:hover { border-color: #1a56db; background: #eef2fb; }
        .file-drop i { font-size: 24px; color: #9ca3af; margin-bottom: 6px; }
        .file-drop p { font-size: 13.5px; color: #6b7280; margin-bottom: 2px; }
        .file-drop small { font-size: 11.5px; color: #9ca3af; }
        #cv-real-input { display: none; }
        #file-name-display { font-size: 13px; color: #16a34a; margin-top: 10px; display: none; font-weight: 500; }

        .current-cv-box { display: flex; align-items: center; justify-content: space-between; background: #eef2fb; border: 1px solid #dbeafe; border-radius: 10px; padding: 12px 16px; margin-bottom: 12px; }
        .current-cv-box span { font-size: 13.5px; color: #1a3a8f; font-weight: 500; display: flex; align-items: center; gap: 8px; }
        .current-cv-box a { font-size: 13px; color: #1a56db; font-weight: 600; text-decoration: none; }
        .current-cv-box a:hover { text-decoration: underline; }

        /* BUTTONS */
        .btn-submit { background: #1a3a8f; color: #fff; border: none; padding: 12px 26px; border-radius: 10px; font-size: 14px; font-weight: 700; cursor: pointer; display: inline-flex; align-items: center; justify-content: center; gap: 8px; transition: background 0.15s; }
        .btn-submit:hover { background: #1447b8; }
        .btn-danger { background: #fff; color: #ef4444; border: 1.5px solid #fecaca; padding: 11px 22px; border-radius: 10px; font-size: 13.5px; font-weight: 700; cursor: pointer; }
        .btn-danger:hover { background: #fef2f2; }

        .danger-zone { border: 1.5px solid #fecaca; }
        .danger-zone h2 { color: #dc2626; }
        .danger-zone h2 i { color: #dc2626; }

        @media (max-width: 700px) {
            .form-row { grid-template-columns: 1fr; }
            .stats-row { grid-template-columns: 1fr 1fr; }
        }
    </style>
</head>
<body>

{{-- NAVBAR --}}
<nav class="navbar-custom">
    <a class="navbar-brand-custom" href="{{ route('home') }}">
        <div class="brand-icon"><i class="fas fa-briefcase"></i></div>
        Wazaaf
    </a>
    <div class="nav-links">
        <a href="{{ route('home') }}">Home</a>
        <a href="{{ route('jobs.index') }}">Browse Jobs</a>
        <a href="{{ route('applications.index') }}">My Applications</a>
    </div>
    <div class="navbar-right">
        <a href="{{ route('notifications.index') }}" class="notif-btn">
            <i class="fas fa-bell"></i>
            @if(auth()->user()->unreadNotifications->count() > 0)
                <span class="notif-badge">{{ auth()->user()->unreadNotifications->count() }}</span>
            @endif
        </a>
        <a href="{{ route('profile.edit') }}" class="user-menu">
            <div class="user-avatar-sm">{{ strtoupper(substr($user->name ?? 'U', 0, 1)) }}</div>
            <span class="user-name">{{ $user->name ?? 'User' }}</span>
        </a>
        <form action="{{ route('logout') }}" method="POST" style="display:inline;">
            @csrf
            <button type="submit" class="btn-logout-nav"><i class="fas fa-sign-out-alt"></i></button>
        </form>
    </div>
</nav>

<div class="page-wrapper">

    <div class="page-header">
        <h1 class="page-title">My Profile</h1>
        <p class="page-subtitle">Manage your personal info and candidate profile.</p>
    </div>

    {{-- SUCCESS MESSAGE --}}
    @if(session('status') === 'profile-updated')
        <div class="alert-success">
            <i class="fas fa-check-circle"></i>
            Your profile has been updated successfully.
        </div>
    @endif

    {{-- VALIDATION ERRORS --}}
    @if($errors->any() && !$errors->userDeletion->any())
        <div class="alert-error-box">
            @foreach($errors->all() as $error)
                <div><i class="fas fa-exclamation-circle"></i> {{ $error }}</div>
            @endforeach
        </div>
    @endif

    {{-- PROFILE HERO --}}
    <div class="profile-hero">
        <div class="profile-avatar">{{ strtoupper(substr($user->name ?? 'U', 0, 1)) }}</div>
        <div>
            <div class="profile-hero-name">{{ $user->name }}</div>
            <div class="profile-hero-email"><i class="fas fa-envelope"></i> {{ $user->email }}</div>
            <div class="profile-hero-meta">
                <span><i class="fas fa-calendar"></i> Joined {{ $user->created_at->format('M Y') }}</span>
                @if($candidate?->phone)
                    <span><i class="fas fa-phone"></i> {{ $candidate->phone }}</span>
                @endif
                @if($candidate?->address)
                    <span><i class="fas fa-map-marker-alt"></i> {{ $candidate->address }}</span>
                @endif
            </div>
        </div>
    </div>

    {{-- STATS --}}
    @php
        $total    = $applications->count();
        $pending  = $applications->where('status','pending')->count();
        $accepted = $applications->where('status','accepted')->count();
        $rejected = $applications->where('status','rejected')->count();
    @endphp
    <div class="stats-row">
        <div class="stat-card">
            <div class="stat-number">{{ $total }}</div>
            <div class="stat-label">Total Applications</div>
        </div>
        <div class="stat-card pending">
            <div class="stat-number">{{ $pending }}</div>
            <div class="stat-label">Pending</div>
        </div>
        <div class="stat-card accepted">
            <div class="stat-number">{{ $accepted }}</div>
            <div class="stat-label">Accepted</div>
        </div>
        <div class="stat-card rejected">
            <div class="stat-number">{{ $rejected }}</div>
            <div class="stat-label">Rejected</div>
        </div>
    </div>

    {{-- MAIN UPDATE FORM (account + candidate info together) --}}
    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('patch')

        {{-- PERSONAL INFO --}}
        <div class="form-card">
            <h2><i class="fas fa-user"></i> Personal Information</h2>
            <p class="subtitle">Your basic account details.</p>

            <div class="form-row">
                <div class="form-group">
                    <label class="form-label-custom">Full Name <span>*</span></label>
                    <input type="text" name="name" class="form-input @error('name') error @enderror"
                        value="{{ old('name', $user->name) }}" required>
                    @error('name')<div class="error-msg"><i class="fas fa-exclamation-circle"></i>{{ $message }}</div>@enderror
                </div>
                <div class="form-group">
                    <label class="form-label-custom">Email Address <span>*</span></label>
                    <input type="email" name="email" class="form-input @error('email') error @enderror"
                        value="{{ old('email', $user->email) }}" required>
                    @error('email')<div class="error-msg"><i class="fas fa-exclamation-circle"></i>{{ $message }}</div>@enderror
                </div>
            </div>

            @if($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="input-hint" style="color:#a16207;">
                    Your email address is unverified.
                </div>
            @endif
        </div>

        {{-- CANDIDATE PROFILE --}}
        <div class="form-card">
            <h2><i class="fas fa-id-card"></i> Candidate Profile</h2>
            <p class="subtitle">This information is used when you apply for jobs.</p>

            <div class="form-row">
                <div class="form-group">
                    <label class="form-label-custom">Phone Number</label>
                    <input type="text" name="phone" class="form-input @error('phone') error @enderror"
                        placeholder="e.g. 01012345678"
                        value="{{ old('phone', $candidate->phone ?? '') }}">
                    @error('phone')<div class="error-msg"><i class="fas fa-exclamation-circle"></i>{{ $message }}</div>@enderror
                </div>
                <div class="form-group">
                    <label class="form-label-custom">Years of Experience</label>
                    <input type="number" name="experience_years" class="form-input @error('experience_years') error @enderror"
                        placeholder="e.g. 3" min="0" max="50"
                        value="{{ old('experience_years', $candidate->experience_years ?? '') }}">
                    @error('experience_years')<div class="error-msg"><i class="fas fa-exclamation-circle"></i>{{ $message }}</div>@enderror
                </div>
            </div>

            <div class="form-group">
                <label class="form-label-custom">Address / Governorate</label>
                <input type="text" name="address" class="form-input @error('address') error @enderror"
                    placeholder="e.g. Cairo, Giza, Alexandria..."
                    value="{{ old('address', $candidate->address ?? '') }}">
                @error('address')<div class="error-msg"><i class="fas fa-exclamation-circle"></i>{{ $message }}</div>@enderror
            </div>

            <div class="form-group">
                <label class="form-label-custom">Bio / About You</label>
                <textarea name="bio" class="form-input" rows="4"
                    placeholder="Tell employers a bit about yourself...">{{ old('bio', $candidate->bio ?? '') }}</textarea>
            </div>

            <div class="form-group">
                <label class="form-label-custom">CV / Resume</label>

                @if($candidate?->cv)
                    <div class="current-cv-box">
                        <span><i class="fas fa-file-alt"></i> Current CV on file</span>
                        <a href="{{ asset('storage/' . $candidate->cv) }}" target="_blank">
                            <i class="fas fa-eye"></i> View
                        </a>
                    </div>
                @endif

                <div class="file-drop" onclick="document.getElementById('cv-real-input').click()">
                    <i class="fas fa-cloud-upload-alt"></i>
                    <p>{{ $candidate?->cv ? 'Click to replace your CV' : 'Click to upload your CV' }}</p>
                    <small>PDF, DOC, DOCX – Max 5MB</small>
                </div>
                <input type="file" id="cv-real-input" name="cv" accept=".pdf,.doc,.docx" onchange="showFileName(this)">
                <div id="file-name-display"><i class="fas fa-check-circle"></i> <span id="fn"></span></div>
                @error('cv')<div class="error-msg"><i class="fas fa-exclamation-circle"></i>{{ $message }}</div>@enderror
            </div>
        </div>

        <button type="submit" class="btn-submit">
            <i class="fas fa-save"></i> Save Changes
        </button>
    </form>

    {{-- DANGER ZONE --}}
    <div class="form-card danger-zone" style="margin-top: 28px;">
        <h2><i class="fas fa-exclamation-triangle"></i> Delete Account</h2>
        <p class="subtitle">Once your account is deleted, all of its data will be permanently removed. This action cannot be undone.</p>

        @if($errors->userDeletion->any())
            <div class="alert-error-box">
                @foreach($errors->userDeletion->all() as $error)
                    <div><i class="fas fa-exclamation-circle"></i> {{ $error }}</div>
                @endforeach
            </div>
        @endif

        <form action="{{ route('profile.destroy') }}" method="POST"
              onsubmit="return confirm('Are you sure you want to permanently delete your account?');">
            @csrf
            @method('delete')

            <div class="form-group" style="max-width: 320px;">
                <label class="form-label-custom">Confirm Password <span>*</span></label>
                <input type="password" name="password" class="form-input" placeholder="Enter your password" required>
            </div>

            <button type="submit" class="btn-danger">
                <i class="fas fa-trash"></i> Delete My Account
            </button>
        </form>
    </div>

</div>

<script>
function showFileName(input) {
    if (input.files && input.files[0]) {
        document.getElementById('file-name-display').style.display = 'block';
        document.getElementById('fn').textContent = input.files[0].name;
    }
}
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>