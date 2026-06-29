<x-mainlayout>
        @section('title', 'Edit Job')

        <div class="page-header">
            <div>
                <h1 class="page-title">Edit Job</h1>
                <p class="page-sub">Update the details for "{{ $job->title }}"</p>
            </div>
        </div>

        <div class="form-card">
            <form action="{{ route('jobs.update', $job) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-grid">

                    {{-- Title --}}
                    <div class="form-group full-width">
                        <label for="title" class="form-label">Job Title <span class="required">*</span></label>
                        <input type="text" id="title" name="title" value="{{ old('title', $job->title) }}"
                            class="form-input @error('title') is-invalid @enderror"
                            placeholder="e.g. Senior Laravel Developer">
                        @error('title')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Category --}}
                    <div class="form-group">
                        <label for="category_id" class="form-label">Category <span class="required">*</span></label>
                        <select id="category_id" name="category_id"
                            class="form-input @error('category_id') is-invalid @enderror">
                            <option value="">Select a category</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id', $job->category_id) == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Status --}}
                    <div class="form-group">
                        <label for="status" class="form-label">Status <span class="required">*</span></label>
                        <select id="status" name="status" class="form-input @error('status') is-invalid @enderror">
                            <option value="open" {{ old('status', $job->status) === 'open' ? 'selected' : '' }}>Open
                            </option>
                            <option value="closed" {{ old('status', $job->status) === 'closed' ? 'selected' : '' }}>Closed
                            </option>
                            <option value="draft" {{ old('status', $job->status) === 'draft' ? 'selected' : '' }}>Draft
                            </option>
                        </select>
                        @error('status')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Location --}}
                    <div class="form-group">
                        <label for="location" class="form-label">Location <span class="required">*</span></label>
                        <input type="text" id="location" name="location" value="{{ old('location', $job->location) }}"
                            class="form-input @error('location') is-invalid @enderror" placeholder="e.g. Cairo, Remote">
                        @error('location')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Salary --}}
                    <div class="form-group">
                        <label for="salary" class="form-label">Salary ($/month)</label>
                        <input type="number" id="salary" name="salary" value="{{ old('salary', $job->salary) }}"
                            class="form-input @error('salary') is-invalid @enderror" placeholder="e.g. 2500" min="0">
                        @error('salary')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Description --}}
                    <div class="form-group full-width">
                        <label for="description" class="form-label">Description <span class="required">*</span></label>
                        <textarea id="description" name="description" rows="6"
                            class="form-input @error('description') is-invalid @enderror"
                            placeholder="Describe the job responsibilities, requirements, and benefits…">{{ old('description', $job->description) }}</textarea>
                        @error('description')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>

                </div>

                <div class="form-actions">
                    <a href="{{ route('jobs.index') }}" class="btn-secondary btn-cancel-edit">Cancel</a>
                    <button type="submit" class="btn-primary">
                        <i class="ti ti-check"></i> Save Changes
                    </button>
                </div>

            </form>
        </div>
</x-mainlayout>