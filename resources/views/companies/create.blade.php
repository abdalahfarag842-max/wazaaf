<x-mainlayout>
@section('title', 'Add Company')

<div class="page-header">
    <div>
        <h1 class="page-title">Add Company</h1>
        <p class="page-sub">Create a new company</p>
    </div>
</div>

<div class="form-card">
    <form action="{{ route('companies.store') }}" method="POST">
        @csrf

        <div class="form-grid">

            {{-- Company Name --}}
            <div class="form-group full-width">
                <label class="form-label">
                    Company Name <span class="required">*</span>
                </label>

                <input
                    type="text"
                    name="name"
                    value="{{ old('name') }}"
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
                    value="{{ old('email') }}"
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
                    value="{{ old('website') }}"
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
                    value="{{ old('location') }}"
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
                    placeholder="Write a short description about the company...">{{ old('description') }}</textarea>

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
                Create Company
            </button>
        </div>

    </form>
</div>

</x-mainlayout>