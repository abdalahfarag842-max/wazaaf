<x-mainlayout>

    <div class="dashboard">

        <section class="dashboard-header">

            <div>

                <h1>{{ $job->title }}</h1>

                <p>Job details and information.</p>

            </div>

            <a href="{{ route('jobs.index') }}" class="btn-secondary">

                <i class="fa-solid fa-arrow-left"></i>

                Back

            </a>

        </section>

        <div class="dashboard-box">

            <div class="box-header">

                <h3>Job Information</h3>

                <span class="status {{ $job->status }}">
                    {{ ucfirst($job->status) }}
                </span>

            </div>

            <div class="details-grid">

                <div class="detail-item">

                    <label>Category</label>

                    <p>{{ $job->category->name }}</p>

                </div>

                <div class="detail-item">

                    <label>Job Type</label>

                    <p>{{ ucwords(str_replace('_', ' ', $job->job_type)) }}</p>

                </div>

                <div class="detail-item">

                    <label>Location</label>

                    <p>{{ $job->location }}</p>

                </div>

                <div class="detail-item">

                    <label>Salary</label>

                    <p>{{ number_format($job->salary) }} EGP</p>

                </div>

                <div class="detail-item">

                    <label>Deadline</label>

                    <p>{{ $job->deadline->format('d M Y') }}</p>

                </div>

                <div class="detail-item">

                    <label>Created By</label>

                    <p>{{ $job->creator->name }}</p>

                </div>

            </div>

        </div>

        <div class="dashboard-box" style="margin-top:25px;">

            <div class="box-header">

                <h3>Job Description</h3>

            </div>

            <p class="job-description">

                {!! nl2br(e($job->description)) !!}

            </p>

        </div>

        <div class="form-actions">

            <a href="{{ route('jobs.edit', $job) }}" class="btn-primary">

                <i class="fa-solid fa-pen"></i>

                Edit Job

            </a>

            <form action="{{ route('jobs.destroy', $job) }}" method="POST">

                @csrf
                @method('DELETE')

                <button
                    type="submit"
                    class="btn-danger"
                    onclick="return confirm('Delete this job?')">

                    <i class="fa-solid fa-trash"></i>

                    Delete Job

                </button>

            </form>

        </div>

    </div>

</x-mainlayout>
