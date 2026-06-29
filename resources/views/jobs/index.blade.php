<x-mainlayout>
        <div class="page-header">
            <div>
                <h1 class="page-title">Jobs</h1>
                <p class="page-sub">Manage all job postings</p>
            </div>
        </div>

        {{-- Success / Error Alerts --}}
        @if (session('success'))
            <div class="alert alert-success">
                <i class="ti ti-circle-check"></i> {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-error">
                <i class="ti ti-alert-circle"></i> {{ session('error') }}
            </div>
        @endif

        {{-- Stats Cards --}}
        <div class="stats-row">

            <div class="stat-card">
                <p class="stat-label">Total Jobs</p>
                <p class="stat-num">{{ $stats['total'] }}</p>
                <p class="stat-hint">All postings</p>
            </div>

            <div class="stat-card">
                <p class="stat-label">Open</p>
                <p class="stat-num" style="color: var(--color-success)">
                    {{ $stats['open'] }}
                </p>
                <p class="stat-hint">Active now</p>
            </div>

            <div class="stat-card">
                <p class="stat-label">Closed</p>
                <p class="stat-num" style="color: var(--color-danger)">
                    {{ $stats['closed'] }}
                </p>
                <p class="stat-hint">Ended</p>
            </div>

            <div class="stat-card">
                <p class="stat-label">Draft</p>
                <p class="stat-num" style="color: var(--color-warning)">
                    {{ $stats['draft'] }}
                </p>
                <p class="stat-hint">Not published</p>
            </div>

        </div>

        {{-- Filter --}}
        <form method="GET" action="{{ route('jobs.index') }}" class="filter-bar">

            <div class="search-wrap">
                <i class="ti ti-search"></i>

                <input type="text" name="search" value="{{ request('search') }}"
                    placeholder="Search by title or location..." class="filter-input">
            </div>

            <select name="category_id" class="filter-select">
                <option value="">All Categories</option>

                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>

            <select name="status" class="filter-select">
                <option value="">All Status</option>
                <option value="open" {{ request('status') == 'open' ? 'selected' : '' }}>Open</option>
                <option value="closed" {{ request('status') == 'closed' ? 'selected' : '' }}>Closed</option>
                <option value="draft" {{ request('status') == 'draft' ? 'selected' : '' }}>Draft</option>
            </select>

            <button class="btn-filter" type="submit">
                <i class="ti ti-adjustments-horizontal"></i>
                Filter
            </button>

            @if(request()->hasAny(['search', 'category_id', 'status']))
                <a href="{{ route('jobs.index') }}" class="btn-reset">
                    <i class="ti ti-x"></i>
                    Reset
                </a>
            @endif

        </form>

        {{-- Table --}}
        <div class="table-card">

            <div class="table-header">

                <div>
                    <p class="table-title">All Jobs</p>
                    <p class="table-count">
                        Showing {{ $jobs->firstItem() }}–{{ $jobs->lastItem() }}
                        of {{ $jobs->total() }} results
                    </p>
                </div>

                <a href="{{ route('jobs.create') }}" class="btn-primary">
                    <i class="ti ti-plus"></i>
                    Add New Job
                </a>

            </div>

            @if($jobs->isEmpty())

                <div class="empty-state">
                    <i class="ti ti-briefcase-off"></i>
                    <p>
                        No jobs found.
                        <a href="{{ route('jobs.create') }}">Create the first one.</a>
                    </p>
                </div>

            @else

                <div class="table-responsive">

                    <table>

                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Job Title</th>
                                <th>Category</th>
                                <th>Location</th>
                                <th>Salary</th>
                                <th>Applications</th>
                                <th>Status</th>
                                <th>Posted</th>
                                <th>Actions</th>
                            </tr>
                        </thead>

                        <tbody>

                            @foreach($jobs as $index => $job)

                                <tr>

                                    <td class="text-muted">
                                        {{ $jobs->firstItem() + $index }}
                                    </td>

                                    <td class="job-title">
                                        {{ $job->title }}
                                    </td>

                                    <td>
                                        {{ $job->category->name ?? '—' }}
                                    </td>

                                    <td>
                                        <i class="ti ti-map-pin"
                                            style="font-size:13px;vertical-align:-1px;color:var(--text-muted)">
                                        </i>

                                        {{ $job->location }}
                                    </td>

                                    <td>

                                        @if($job->salary)

                                            <span class="salary">
                                                ${{ number_format($job->salary) }}
                                            </span>

                                        @else

                                            <span class="text-muted">—</span>

                                        @endif

                                    </td>

                                    <td>
                                        <span class="apps-chip">
                                            {{ $job->applications_count ?? $job->applications->count() }}
                                            apps
                                        </span>
                                    </td>

                                    <td>
                                        <span class="badge {{ $job->status_color }}">
                                            {{ ucfirst($job->status) }}
                                        </span>
                                    </td>

                                    <td class="text-muted text-sm">
                                        {{ $job->created_at->format('d M Y') }}
                                    </td>

                                    <td>

                                        <div class="actions">

                                            <a href="{{ route('jobs.show', $job) }}" class="btn-view">
                                                View
                                            </a>

                                            <a href="{{ route('jobs.edit', $job) }}" class="btn-edit">
                                                Edit
                                            </a>

                                            <form action="{{ route('jobs.destroy', $job) }}" method="POST" class="delete-form">

                                                @csrf
                                                @method('DELETE')

                                                <button type="submit" class="btn-delete">
                                                    Delete
                                                </button>

                                            </form>

                                        </div>

                                    </td>

                                </tr>

                            @endforeach

                        </tbody>

                    </table>

                </div>

                @if($jobs->hasPages())

                    <div class="pagination-wrap">

                        <p class="pg-info">
                            Showing {{ $jobs->firstItem() }}–{{ $jobs->lastItem() }}
                            of {{ $jobs->total() }} jobs
                        </p>

                        {{ $jobs->links() }}

                    </div>

                @endif

            @endif

        </div>
</x-mainlayout>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.querySelectorAll('.delete-form').forEach(form => {

        form.addEventListener('submit', function (e) {
            e.preventDefault();

            Swal.fire({
                title: 'Delete Job?',
                text: 'This action cannot be undone.',
                icon: 'warning',

                showCancelButton: true,

                confirmButtonText: '<i class="ti ti-trash"></i> Delete',
                cancelButtonText: 'Cancel',

                reverseButtons: true,

                buttonsStyling: false,

                customClass: {
                    popup: 'custom-popup',
                    title: 'custom-title',
                    htmlContainer: 'custom-text',
                    confirmButton: 'custom-confirm',
                    cancelButton: 'custom-cancel'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });

        });

    });
</script>