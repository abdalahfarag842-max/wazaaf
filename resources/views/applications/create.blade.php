<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Apply for Job – Wazaaf</title>
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
        .nav-links a { font-size: 14px; color: #6b7280; padding: 8px 16px; border-radius: 6px; text-decoration: none; font-weight: 500; border-bottom: 2px solid transparent; }
        .nav-links a.active { color: #1a56db; border-bottom: 2px solid #1a56db; border-radius: 0; }
        .navbar-right { display: flex; align-items: center; gap: 16px; margin-left: auto; }
        .user-name { font-size: 14px; font-weight: 500; color: #1a1a2e; }
        .btn-logout-nav { background: none; border: none; color: #6b7280; font-size: 13px; cursor: pointer; padding: 4px 8px; }
        .btn-logout-nav:hover { color: #ef4444; }

        /* PAGE */
        .page-wrapper { max-width: 640px; margin: 40px auto; padding: 0 24px 60px; }

        /* PROGRESS */
        .progress-bar-custom { background: #fff; border: 1px solid #e5e9f0; border-radius: 12px; padding: 20px 28px; margin-bottom: 28px; display: flex; align-items: center; gap: 0; }
        .step { display: flex; align-items: center; gap: 8px; font-size: 13px; font-weight: 600; }
        .step-circle { width: 28px; height: 28px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 12px; font-weight: 700; }
        .step.done .step-circle { background: #dcfce7; color: #16a34a; }
        .step.active .step-circle { background: #1a3a8f; color: #fff; }
        .step.inactive .step-circle { background: #f3f4f6; color: #9ca3af; }
        .step.done { color: #16a34a; }
        .step.active { color: #1a3a8f; }
        .step.inactive { color: #9ca3af; }
        .step-line { flex: 1; height: 2px; background: #e5e9f0; margin: 0 12px; }
        .step-line.done { background: #16a34a; }

        /* JOB PREVIEW */
        .job-preview { background: #eef2fb; border: 1px solid #dbeafe; border-radius: 12px; padding: 16px 20px; margin-bottom: 28px; display: flex; align-items: center; gap: 14px; }
        .job-preview-logo { width: 44px; height: 44px; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 20px; font-weight: 800; color: #fff; flex-shrink: 0; }
        .job-preview-title { font-size: 15px; font-weight: 700; color: #0f172a; }
        .job-preview-meta { font-size: 13px; color: #6b7280; margin-top: 2px; }

        /* FORM CARD */
        .form-card { background: #fff; border: 1px solid #e5e9f0; border-radius: 16px; padding: 36px; }
        .form-card h2 { font-size: 20px; font-weight: 800; color: #0f172a; margin-bottom: 6px; }
        .form-card .subtitle { font-size: 14px; color: #6b7280; margin-bottom: 28px; }
        .form-group { margin-bottom: 22px; }
        .form-label-custom { display: block; font-size: 13px; font-weight: 600; color: #374151; margin-bottom: 7px; }
        .form-label-custom span { color: #ef4444; }
        .form-input { width: 100%; padding: 11px 14px; border: 1.5px solid #e5e9f0; border-radius: 8px; font-size: 14px; color: #1a1a2e; outline: none; transition: border-color 0.15s; background: #fff; }
        .form-input:focus { border-color: #1a56db; }
        .form-input.error { border-color: #ef4444; }
        .error-msg { font-size: 12px; color: #ef4444; margin-top: 5px; display: flex; align-items: center; gap: 4px; }
        .input-hint { font-size: 12px; color: #9ca3af; margin-top: 5px; }
        .file-drop { border: 2px dashed #d1d5db; border-radius: 10px; padding: 28px; text-align: center; cursor: pointer; transition: all 0.15s; background: #fafafa; }
        .file-drop:hover { border-color: #1a56db; background: #eef2fb; }
        .file-drop i { font-size: 28px; color: #9ca3af; margin-bottom: 8px; }
        .file-drop p { font-size: 14px; color: #6b7280; margin-bottom: 4px; }
        .file-drop small { font-size: 12px; color: #9ca3af; }
        #cv-real-input { display: none; }
        #file-name-display { font-size: 13px; color: #16a34a; margin-top: 10px; display: none; font-weight: 500; }

        /* BUTTONS */
        .btn-submit { width: 100%; background: #1a3a8f; color: #fff; border: none; padding: 14px; border-radius: 10px; font-size: 15px; font-weight: 700; cursor: pointer; display: flex; align-items: center; justify-content: center; gap: 8px; transition: background 0.15s; margin-top: 8px; }
        .btn-submit:hover { background: #1447b8; }
        .btn-cancel { width: 100%; background: none; color: #6b7280; border: 1.5px solid #e5e9f0; padding: 12px; border-radius: 10px; font-size: 14px; font-weight: 600; cursor: pointer; margin-top: 10px; text-decoration: none; display: block; text-align: center; transition: all 0.15s; }
        .btn-cancel:hover { background: #f3f4f6; color: #374151; }
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
        <a href="{{ route('applications.index') }}" class="active">My Applications</a>
    </div>
    <div class="navbar-right">
      <a href="{{ route('profile.edit') }}" style="display:flex;align-items:center;gap:8px;text-decoration:none;">
    <span class="user-name">{{ Auth::user()->name ?? 'User' }}</span>
</a>
        <form action="{{ route('logout') }}" method="POST" style="display:inline;">
            @csrf
            <button type="submit" class="btn-logout-nav"><i class="fas fa-sign-out-alt"></i></button>
        </form>
    </div>
</nav>

<div class="page-wrapper">

    {{-- PROGRESS --}}
    <div class="progress-bar-custom">
        <div class="step done">
            <div class="step-circle"><i class="fas fa-check"></i></div>
            Job Details
        </div>
        <div class="step-line done"></div>
        <div class="step active">
            <div class="step-circle">2</div>
            Apply
        </div>
        <div class="step-line"></div>
        <div class="step inactive">
            <div class="step-circle">3</div>
            Done
        </div>
    </div>

    {{-- JOB PREVIEW --}}
    @php
        $logoColors = ['#3b82f6','#f59e0b','#10b981','#8b5cf6','#ef4444','#06b6d4'];
        $color = $logoColors[$job->id % count($logoColors)];
    @endphp
    <div class="job-preview">
        <div class="job-preview-logo" style="background:{{ $color }}">
            {{ strtoupper(substr($job->title, 0, 1)) }}
        </div>
        <div>
            <div class="job-preview-title">{{ $job->title }}</div>
            <div class="job-preview-meta">
                <i class="fas fa-building" style="font-size:11px;color:#1a56db;"></i>
                {{ $job->category->name ?? 'Company' }}
                &nbsp;·&nbsp;
                <i class="fas fa-map-marker-alt" style="font-size:11px;"></i>
                {{ $job->location }}
                @if($job->salary)
                    &nbsp;·&nbsp; EGP {{ number_format($job->salary, 0) }}
                @endif
            </div>
        </div>
    </div>

    {{-- APPLY FORM --}}
    <div class="form-card">
        <h2>Complete Your Application</h2>
        <p class="subtitle">Fill in your details below to apply for this position.</p>

        @if($errors->any())
            <div style="background:#fee2e2;border:1px solid #fca5a5;border-radius:8px;padding:12px 16px;margin-bottom:20px;">
                @foreach($errors->all() as $error)
                    <div style="font-size:13px;color:#dc2626;display:flex;align-items:center;gap:6px;">
                        <i class="fas fa-exclamation-circle"></i> {{ $error }}
                    </div>
                @endforeach
            </div>
        @endif

        <form action="{{ route('applications.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="job_id" value="{{ $job->id }}">

            <div class="form-group">
                <label class="form-label-custom">Full Name <span>*</span></label>
                <input type="text" name="name" class="form-input @error('name') error @enderror"
                    placeholder="Enter your full name"
                    value="{{ old('name', Auth::user()->name) }}" required>
                @error('name')<div class="error-msg"><i class="fas fa-exclamation-circle"></i>{{ $message }}</div>@enderror
            </div>

            <div class="form-group">
                <label class="form-label-custom">Phone Number <span>*</span></label>
                <input type="text" name="phone" class="form-input @error('phone') error @enderror"
                    placeholder="e.g. 01012345678"
                    value="{{ old('phone', auth()->user()->candidate->phone ?? '') }}" required>
                @error('phone')<div class="error-msg"><i class="fas fa-exclamation-circle"></i>{{ $message }}</div>@enderror
            </div>

            <div class="form-group">
                <label class="form-label-custom">Address / Governorate <span>*</span></label>
                <input type="text" name="address" class="form-input @error('address') error @enderror"
                    placeholder="e.g. Cairo, Giza, Alexandria..."
                    value="{{ old('address', auth()->user()->candidate->address ?? '') }}" required>
                @error('address')<div class="error-msg"><i class="fas fa-exclamation-circle"></i>{{ $message }}</div>@enderror
            </div>

            <div class="form-group">
                <label class="form-label-custom">Years of Experience <span>*</span></label>
                <input type="number" name="experience_years" class="form-input @error('experience_years') error @enderror"
                    placeholder="e.g. 3"
                    min="0" max="50"
                    value="{{ old('experience_years', auth()->user()->candidate->experience_years ?? '') }}" required>
                @error('experience_years')<div class="error-msg"><i class="fas fa-exclamation-circle"></i>{{ $message }}</div>@enderror
            </div>

            <div class="form-group">
                <label class="form-label-custom">CV / Resume <span>*</span></label>
                <div class="file-drop" onclick="document.getElementById('cv-real-input').click()">
                    <i class="fas fa-cloud-upload-alt"></i>
                    <p>Click to upload your CV</p>
                    <small>PDF, DOC, DOCX – Max 5MB</small>
                </div>
                <input type="file" id="cv-real-input" name="cv" accept=".pdf,.doc,.docx" onchange="showFileName(this)">
                <div id="file-name-display"><i class="fas fa-check-circle"></i> <span id="fn"></span></div>
                @error('cv')<div class="error-msg"><i class="fas fa-exclamation-circle"></i>{{ $message }}</div>@enderror
            </div>

            <div class="form-group">
                <label class="form-label-custom">Cover Letter / Bio <span style="color:#9ca3af;font-weight:400;">(optional)</span></label>
                <textarea name="cover_letter" class="form-input" rows="4"
                    placeholder="Tell us why you're a great fit for this role...">{{ old('cover_letter') }}</textarea>
                <div class="input-hint">Brief introduction about yourself and your motivation.</div>
            </div>

            <button type="submit" class="btn-submit">
                <i class="fas fa-paper-plane"></i> Submit Application
            </button>
        </form>

        <a href="{{ route('jobs.show', $job) }}" class="btn-cancel">
            <i class="fas fa-arrow-left"></i> Go Back
        </a>
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
