<x-mainlayout>

    @section('title', 'Companies')

    <div class="page-header">
        <div>
            <h1 class="page-title">Companies</h1>
            <p class="page-sub">
                Browse all companies and their hiring statistics.
            </p>
        </div>
    </div>
    <div class="add_company">
        @auth
            @if(auth()->user()->role === 'admin')
                <a href="{{ route('companies.create') }}" class="btn-primary add-company">
                    <i class="ti ti-plus"></i>
                    Add Company
                </a>
            @endif
        @endauth
    </div>

    {{-- Alerts --}}
    @if(session('success'))
        <div class="alert alert-success">
            <i class="ti ti-circle-check"></i>
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-error">
            <i class="ti ti-alert-circle"></i>
            {{ session('error') }}
        </div>
    @endif

    {{-- Search --}}
    <form method="GET" action="{{ route('companies.index') }}" class="filter-bar">

        <div class="search-wrap">
            <i class="ti ti-search"></i>

            <input type="text" name="search" class="filter-input" value="{{ request('search') }}"
                placeholder="Search company...">
        </div>

        <button class="btn-filter">
            Search
        </button>

        @if(request('search'))
            <a href="{{ route('companies.index') }}" class="btn-reset">
                Reset
            </a>
        @endif

    </form>

    {{-- Cards --}}
    <div class="companies-grid">

        @forelse($companies as $company)

            <div class="company-card">

                <div class="company-avatar">
                    {{ strtoupper(substr($company->name, 0, 1)) }}
                </div>

                <h3 class="company-name">
                    {{ $company->name }}
                </h3>

                <p class="company-location">
                    <i class="ti ti-map-pin"></i>
                    {{ $company->location }}
                </p>

                <p class="company-email">
                    <i class="ti ti-mail"></i>
                    {{ $company->email }}
                </p>

                @if($company->website)
                    <p class="company-website">
                        <i class="ti ti-world"></i>

                        <a href="{{ $company->website }}" target="_blank">
                            {{ $company->website }}
                        </a>
                    </p>
                @endif

                <div class="company-description">
                    {{ \Illuminate\Support\Str::limit($company->description, 120) }}
                </div>

                <div class="company-stats">

                    <div class="stat-item">
                        <span>Total</span>
                        <strong>{{ $company->jobs_count }}</strong>
                    </div>

                    <div class="stat-item">
                        <span>Open</span>
                        <strong class="text-success">
                            {{ $company->open_jobs_count }}
                        </strong>
                    </div>

                    <div class="stat-item">
                        <span>Closed</span>
                        <strong class="text-danger">
                            {{ $company->closed_jobs_count }}
                        </strong>
                    </div>

                    <div class="stat-item">
                        <span>Draft</span>
                        <strong class="text-warning">
                            {{ $company->draft_jobs_count }}
                        </strong>
                    </div>

                </div>

                @auth
                    @if(auth()->user()->role === 'admin')

                        <div class="company-actions">

                            <a href="{{ route('companies.show', $company) }}" class="btn-view">
                                View
                            </a>

                            <a href="{{ route('companies.edit', $company) }}" class="btn-edit">
                                Edit
                            </a>
                            <form action="{{ route('companies.destroy', $company) }}" method="POST" class="delete-form">

                                @csrf
                                @method('DELETE')

                                <button type="submit" class="btn-delete">
                                    Delete
                                </button>

                            </form>

                        </div>

                    @endif
                @endauth

            </div>

        @empty

            <div class="empty-state">

                <i class="ti ti-building"></i>

                <h3>No Companies Found</h3>

                <p>
                    There are no companies matching your search.
                </p>

                @auth
                    @if(auth()->user()->role === 'admin')
                        <a href="{{ route('companies.create') }}" class="btn-primary">
                            <i class="ti ti-plus"></i>
                            Add Company
                        </a>
                    @endif
                @endauth

            </div>

        @endforelse

    </div>

    {{-- Pagination --}}
    @if($companies->hasPages())

        <div class="pagination-wrap">

            <p class="pg-info">
                Showing
                {{ $companies->firstItem() }}
                -
                {{ $companies->lastItem() }}
                of
                {{ $companies->total() }}
                companies
            </p>

            {{ $companies->links() }}

        </div>

    @endif

</x-mainlayout>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>

    document.querySelectorAll('.delete-form').forEach(form => {

        form.addEventListener('submit', function (e) {

            e.preventDefault();

            Swal.fire({

                title: 'Delete Company?',

                text: 'This action cannot be undone.',

                icon: 'warning',

                showCancelButton: true,

                confirmButtonText: 'Delete',

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