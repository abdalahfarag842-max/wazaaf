<x-mainlayout>
    @section('title', $job->title)
        <div class="page-header">
            <div>
                <h1 class="page-title">{{ $job->title }}</h1>
                <p class="page-sub">
                    <span class="badge {{ $job->status_color }}">{{ ucfirst($job->status) }}</span>
                    &nbsp;·&nbsp; Posted {{ $job->created_at->format('d M Y') }}
                </p>
            </div>
        </div>

        {{-- Job Info --}}
        <div class="show-grid">

            {{-- Left: Details --}}
            <div class="detail-card">
                <h2 class="detail-section-title">Job Details</h2>

                <div class="detail-row">
                    <span class="detail-label"><i class="ti ti-category"></i> Category</span>
                    <span class="detail-value">{{ $job->category->name ?? '—' }}</span>
                </div>

                <div class="detail-row">
                    <span class="detail-label"><i class="ti ti-map-pin"></i> Location</span>
                    <span class="detail-value">{{ $job->location }}</span>
                </div>

                <div class="detail-row">
                    <span class="detail-label"><i class="ti ti-currency-dollar"></i> Salary</span>
                    <span class="detail-value">
                        @if ($job->salary)
                            <span class="salary">${{ number_format($job->salary) }}/month</span>
                        @else
                            Not specified
                        @endif
                    </span>
                </div>

                <div class="detail-row">
                    <span class="detail-label"><i class="ti ti-toggle-left"></i> Status</span>
                    <span class="badge {{ $job->status_color }}">{{ ucfirst($job->status) }}</span>
                </div>

                <div class="detail-row">
                    <span class="detail-label"><i class="ti ti-calendar"></i> Posted</span>
                    <span class="detail-value">{{ $job->created_at->format('d M Y') }}</span>
                </div>

                <div class="detail-row">
                    <span class="detail-label"><i class="ti ti-refresh"></i> Last Updated</span>
                    <span class="detail-value">{{ $job->updated_at->format('d M Y') }}</span>
                </div>

                <hr class="detail-divider">

                <h3 class="detail-sub-title">Description</h3>
                <div class="detail-description">
                    {!! nl2br(e($job->description)) !!}
                </div>

                {{-- Danger Zone --}}
                <hr class="detail-divider">
                <div style="display:flex; justify-content:flex-end;">
                    <form action="{{ route('jobs.destroy', $job) }}" method="POST"
                        onsubmit="return confirm('Delete this job permanently?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-danger">
                            <i class="ti ti-trash"></i> Delete Job
                        </button>
                    </form>
                </div>
            </div>

            {{-- Right: Applications --}}
            <div class="detail-card">
                <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:1rem;">
                    <h2 class="detail-section-title" style="margin:0">
                        Applications
                        <span class="apps-chip" style="margin-left:8px">{{ $job->applications->count() }}</span>
                    </h2>
                    <a href="{{ route('applications.index', ['job_id' => $job->id]) }}" class="btn-secondary"
                        style="font-size:12px; padding:4px 12px;">
                        View All
                    </a>
                </div>

                @if ($job->applications->isEmpty())
                    <div class="empty-state" style="padding:2rem 0;">
                        <i class="ti ti-user-off"></i>
                        <p>No applications yet for this job.</p>
                    </div>
                @else
                    <div class="apps-list">
                        @foreach ($job->applications->take(5) as $application)
                            <div class="app-row">
                                <div class="app-avatar">
                                    {{ strtoupper(substr($application->candidate->user->name ?? 'C', 0, 2)) }}
                                </div>
                                <div class="app-info">
                                    <p class="app-name">{{ $application->candidate->user->name ?? 'Unknown' }}</p>
                                    <p class="app-date">Applied {{ $application->created_at->format('d M Y') }}</p>
                                </div>
                                <span class="badge status-{{ $application->status }}">{{ ucfirst($application->status) }}</span>
                            </div>
                        @endforeach

                        @if ($job->applications->count() > 5)
                            <a href="{{ route('applications.index', ['job_id' => $job->id]) }}" class="show-more-link">
                                + {{ $job->applications->count() - 5 }} more applications
                            </a>
                        @endif
                    </div>
                @endif
            </div>
            <div class="abdullah">
                <a href="{{ route('jobs.edit', $job) }}" class="btn-secondary btn-edit-show">
                    <i class="ti ti-edit"></i> Edit
                </a>
                <a href="{{ route('jobs.index') }}" class="btn-secondary btn-back-show">
                    <i class="ti ti-arrow-left"></i> Back
                </a>
            </div>

        </div>
</x-mainlayout>