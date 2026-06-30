<div class="dashboard-box">

    <div class="box-header">

        <h3>Update Application Status</h3>

    </div>

    <div class="form-grid">

        <div class="form-group">

            <label>Candidate</label>

            <input
                type="text"
                value="{{ $application->candidate->user->name }}"
                readonly>

        </div>

        <div class="form-group">

            <label>Job</label>

            <input
                type="text"
                value="{{ $application->job->title }}"
                readonly>

        </div>

        <div class="form-group full">

            <label>Current Status</label>

            <select name="status">

                <option value="pending"
                    @selected(old('status', $application->status) == 'pending')>

                    Pending

                </option>

                <option value="reviewed"
                    @selected(old('status', $application->status) == 'reviewed')>

                    Reviewed

                </option>

                <option value="accepted"
                    @selected(old('status', $application->status) == 'accepted')>

                    Accepted

                </option>

                <option value="rejected"
                    @selected(old('status', $application->status) == 'rejected')>

                    Rejected

                </option>

            </select>

            @error('status')

                <small class="error">

                    {{ $message }}

                </small>

            @enderror

        </div>

        <div class="form-group full">

            <label>Cover Letter</label>

            <textarea
                rows="8"
                readonly>{{ $application->cover_letter }}</textarea>

        </div>

    </div>

    <div class="form-actions">

        <a
            href="{{ route('applications.index') }}"
            class="btn-secondary">

            <i class="fa-solid fa-arrow-left"></i>

            Cancel

        </a>

        <button
            type="submit"
            class="btn-primary">

            <i class="fa-solid fa-floppy-disk"></i>

            Update Status

        </button>

    </div>

</div>
