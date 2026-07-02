<x-mainlayout>

    <div class="main-content">

        <section class="dashboard-header">
            <div>
                <h1 class="company-namee">{{ $company->name }}</h1>
                <p>View company information.</p>
            </div>
        </section>

        <div class="company-view-card">

            <div class="company-info">

                <div class="info-group">
                    <span class="info-label">Company Name</span>
                    <p class="company-namee">{{ $company->name }}</p>
                </div>

                <div class="info-group">
                    <span class="info-label">Email</span>
                    <p>{{ $company->email }}</p>
                </div>

                <div class="info-group">
                    <span class="info-label">Website</span>
                    <p>
                        @if($company->website)
                            <a href="{{ $company->website }}" target="_blank">
                                {{ $company->website }}
                            </a>
                        @else
                            <span class="text-muted">Not Available</span>
                        @endif
                    </p>
                </div>

                <div class="info-group">
                    <span class="info-label">Location</span>
                    <p>{{ $company->location }}</p>
                </div>

                <div class="info-group full-width">
                    <span class="info-label">Description</span>
                    <p>{{ $company->description ?? 'No description available.' }}</p>
                </div>

                <div class="info-group">
                    <span class="info-label">Created At</span>
                    <p>{{ $company->created_at->format('d M, Y') }}</p>
                </div>

                <div class="info-group">
                    <span class="info-label">Last Updated</span>
                    <p>{{ $company->updated_at->format('d M, Y') }}</p>
                </div>

            </div>

        </div>

        <div class="action-buttons">

            <a href="{{ route('companies.edit', $company) }}" class="btn-edi_edit">
                <i class="fa-solid fa-pen"></i>
                Edit
            </a>

            <a href="{{ route('companies.index') }}" class="btn-back_show">
                <i class="fa-solid fa-arrow-left"></i>
                Back
            </a>

        </div>

    </div>

</x-mainlayout>