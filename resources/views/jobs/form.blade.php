<div class="dashboard-box">

    <div class="box-header">

        <h3>Job Information</h3>

    </div>

    <div class="form-grid">

        {{-- Job Title --}}
        <div class="form-group">

            <label for="title">Job Title</label>

            <input
                type="text"
                id="title"
                name="title"
                value="{{ old('title', $job->title ?? '') }}"
                placeholder="Enter job title">

            @error('title')
                <small class="error">{{ $message }}</small>
            @enderror

        </div>

        {{-- Category --}}
        <div class="form-group">

            <label for="category_id">Category</label>

            <select id="category_id" name="category_id">

                <option value="">Select Category</option>

                @foreach($categories as $category)

                    <option
                        value="{{ $category->id }}"
                        @selected(old('category_id', $job->category_id ?? '') == $category->id)>

                        {{ $category->name }}

                    </option>

                @endforeach

            </select>

            @error('category_id')
                <small class="error">{{ $message }}</small>
            @enderror

        </div>

        {{-- Location --}}
        <div class="form-group">

            <label for="location">Location</label>

            <input
                type="text"
                id="location"
                name="location"
                value="{{ old('location', $job->location ?? '') }}"
                placeholder="Ex: Cairo">

            @error('location')
                <small class="error">{{ $message }}</small>
            @enderror

        </div>

        {{-- Salary --}}
        <div class="form-group">

            <label for="salary">Salary</label>

            <input
                type="number"
                id="salary"
                name="salary"
                value="{{ old('salary', $job->salary ?? '') }}"
                placeholder="Ex: 12000">

            @error('salary')
                <small class="error">{{ $message }}</small>
            @enderror

        </div>

        {{-- Job Type --}}
        <div class="form-group">

            <label for="job_type">Job Type</label>

            <select id="job_type" name="job_type">

                <option value="full_time"
                    @selected(old('job_type', $job->job_type ?? '') == 'full_time')>

                    Full Time

                </option>

                <option value="part_time"
                    @selected(old('job_type', $job->job_type ?? '') == 'part_time')>

                    Part Time

                </option>

                <option value="remote"
                    @selected(old('job_type', $job->job_type ?? '') == 'remote')>

                    Remote

                </option>

                <option value="internship"
                    @selected(old('job_type', $job->job_type ?? '') == 'internship')>

                    Internship

                </option>

            </select>

        </div>

        {{-- Status --}}
        <div class="form-group">

            <label for="status">Status</label>

            <select id="status" name="status">

                <option value="open"
                    @selected(old('status', $job->status ?? '') == 'open')>

                    Open

                </option>

                <option value="closed"
                    @selected(old('status', $job->status ?? '') == 'closed')>

                    Closed

                </option>

            </select>

        </div>

        {{-- Deadline --}}
        <div class="form-group">

            <label for="deadline">Deadline</label>

            <input
                type="date"
                id="deadline"
                name="deadline"
                value="{{ old('deadline', isset($job) ? \Carbon\Carbon::parse($job->deadline)->format('Y-m-d') : '') }}">

            @error('deadline')
                <small class="error">{{ $message }}</small>
            @enderror

        </div>

    </div>

    {{-- Description --}}
    <div class="form-group" style="margin-top:25px;">

        <label for="description">Description</label>

        <textarea
            id="description"
            name="description"
            rows="7"
            placeholder="Write job description...">{{ old('description', $job->description ?? '') }}</textarea>

        @error('description')
            <small class="error">{{ $message }}</small>
        @enderror

    </div>

    <div class="form-actions">

        <a href="{{ route('jobs.index') }}" class="btn-secondary">

            Cancel

        </a>

        <button type="submit" class="btn-primary">

            {{ isset($job) ? 'Update Job' : 'Create Job' }}

        </button>

    </div>

</div>
