<x-mainlayout>

    <div class="dashboard">

        <section class="dashboard-header">

            <div>

                <h1>Edit Application</h1>

                <p>Update application status.</p>

            </div>

            <a
                href="{{ route('applications.index') }}"
                class="btn-secondary">

                <i class="fa-solid fa-arrow-left"></i>

                Back

            </a>

        </section>

        <form
            action="{{ route('applications.update', $application) }}"
            method="POST">

            @csrf
            @method('PUT')
            <div class="dashboard-box" style="margin-bottom:25px;">

    <div style="
        background: var(--color-info-light);
        color: var(--color-info-base);
        padding:18px;
        border-radius:12px;
        border-left:4px solid var(--color-primary);
    ">

        <i class="fa-solid fa-circle-info"></i>

        <strong>Notice:</strong>

        Only the <strong>Application Status</strong> can be updated.
        Candidate information, job details, and cover letter are read-only.

    </div>

</div>
            @include('admin.applications.form')

        </form>

    </div>

</x-mainlayout>
