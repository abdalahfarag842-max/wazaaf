<div class="form-card">
    <form action="{{ isset($company) ? route('companies.update', $company) : route('companies.store') }}" method="POST">
        @csrf

        @if(isset($company))
            @method('PUT')
        @endif

        <div class="form-grid">

            {{-- Company Name --}}
            <div class="form-group full-width">
                <label class="form-label">
                    Company Name <span class="required">*</span>
                </label>

                <input
                    type="text"
                    name="name"
                    value="{{ old('name', $company->name ?? '') }}"
                    class="form-input @error('name') is-invalid @enderror"
                    placeholder="e.g. Google">

                @error('name')
                    <p class="form-error">{{ $message }}</p>
                @enderror
            </div>

            {{-- Email --}}
            <div class="form-group">
                <label class="form-label">
                    Email <span class="required">*</span>
                </label>

                <input
                    type="email"
                    name="email"
                    value="{{ old('email', $company->email ?? '') }}"
                    class="form-input @error('email') is-invalid @enderror"
                    placeholder="company@example.com">

                @error('email')
                    <p class="form-error">{{ $message }}</p>
                @enderror
            </div>

            {{-- Website --}}
            <div class="form-group">
                <label class="form-label">
                    Website
                </label>

                <input
                    type="url"
                    name="website"
                    value="{{ old('website', $company->website ?? '') }}"
                    class="form-input @error('website') is-invalid @enderror"
                    placeholder="https://example.com">

                @error('website')
                    <p class="form-error">{{ $message }}</p>
                @enderror
            </div>

            {{-- Location --}}
            <div class="form-group full-width">
                <label class="form-label">
                    Location <span class="required">*</span>
                </label>

                <input
                    type="text"
                    name="location"
                    value="{{ old('location', $company->location ?? '') }}"
                    class="form-input @error('location') is-invalid @enderror"
                    placeholder="Cairo, Egypt">

                @error('location')
                    <p class="form-error">{{ $message }}</p>
                @enderror
            </div>

            {{-- Description --}}
            <div class="form-group full-width">
                <label class="form-label">
                    Description
                </label>

                <textarea
                    name="description"
                    rows="6"
                    class="form-input @error('description') is-invalid @enderror"
                    placeholder="Write a short description about the company...">{{ old('description', $company->description ?? '') }}</textarea>

                @error('description')
                    <p class="form-error">{{ $message }}</p>
                @enderror
            </div>

        </div>

        <div class="form-actions">
            <a href="{{ route('companies.index') }}" class="btn-secondary btn-cancel-edit">
                Cancel
            </a>

            <button type="submit" class="btn-primary">
                <i class="ti ti-building"></i>
                {{ isset($company) ? 'Update Company' : 'Create Company' }}
            </button>
        </div>

    </form>
</div>