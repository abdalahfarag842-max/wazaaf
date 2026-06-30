<x-mainlayout>

    <div class="dashboard">

        <section class="dashboard-header">

            <div>

                <h1>Application Details</h1>

                <p>Review application information.</p>

            </div>

            <a href="{{ route('applications.index') }}" class="btn-secondary">

                <i class="fa-solid fa-arrow-left"></i>

                Back

            </a>

        </section>

        <div class="dashboard-box">

            <div class="details-grid">

                <div class="detail-item">

                    <label>Candidate</label>

                    <p>{{ $application->candidate->user->name }}</p>

                </div>

                <div class="detail-item">

                    <label>Email</label>

                    <p>{{ $application->candidate->user->email }}</p>

                </div>

                <div class="detail-item">

                    <label>Phone</label>

                    <p>{{ $application->candidate->phone }}</p>

                </div>

                <div class="detail-item">

                    <label>Experience</label>

                    <p>{{ $application->candidate->experience_years }} Years</p>

                </div>

                <div class="detail-item">

                    <label>Job</label>

                    <p>{{ $application->job->title }}</p>

                </div>

                <div class="detail-item">

                    <label>Category</label>

                    <p>{{ $application->job->category->name }}</p>

                </div>

                <div class="detail-item">

                    <label>Location</label>

                    <p>{{ $application->job->location }}</p>

                </div>

                <div class="detail-item">

                    <label>Salary</label>

                    <p>${{ number_format($application->job->salary) }}</p>

                </div>

                <div class="detail-item">

                    <label>Status</label>

                    <p>

                        <span class="status {{ $application->status }}">

                            {{ ucfirst($application->status) }}

                        </span>

                    </p>

                </div>

                <div class="detail-item">

                    <label>Applied At</label>

                    <p>{{ $application->created_at->format('d M Y') }}</p>

                </div>

                <div class="detail-item full">

                    <label>Cover Letter</label>

                    <p class="job-description">

                        {{ $application->cover_letter ?: 'No cover letter provided.' }}

                    </p>

                </div>

                <div class="detail-item full">

                    <label>Candidate CV</label>

                    @if($application->candidate->cv)

                        <a
                            href="{{ asset('storage/'.$application->candidate->cv) }}"
                            target="_blank"
                            class="btn-primary">

                            <i class="fa-solid fa-file-pdf"></i>

                            View CV

                        </a>

                    @else

                        <p>No CV uploaded.</p>

                    @endif

                </div>

            </div>

        </div>

    </div>

</x-mainlayout>
