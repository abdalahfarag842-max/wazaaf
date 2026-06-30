<x-mainlayout>

    <div class="dashboard">

        <section class="dashboard-header">

            <div>

                <h1>Category Details</h1>

                <p>View category information and related jobs.</p>

            </div>

            <a
                href="{{ route('categories.index') }}"
                class="btn-secondary">

                <i class="fa-solid fa-arrow-left"></i>

                Back

            </a>

        </section>

        <div class="dashboard-box">

            <div class="details-grid">

                <div class="detail-item">

                    <label>Category Name</label>

                    <p>{{ $category->name }}</p>

                </div>

                <div class="detail-item">

                    <label>Total Jobs</label>

                    <p>{{ $category->jobs_count }}</p>

                </div>

                <div class="detail-item">

                    <label>Created At</label>

                    <p>{{ $category->created_at->format('d M Y') }}</p>

                </div>

                <div class="detail-item">

                    <label>Last Updated</label>

                    <p>{{ $category->updated_at->format('d M Y') }}</p>

                </div>

            </div>

        </div>

        <div class="dashboard-box" style="margin-top:25px;">

            <div class="box-header">

                <h3>Jobs in this Category</h3>

            </div>

            @if($category->jobs->count())

                <table>

                    <thead>

                        <tr>

                            <th>Title</th>

                            <th>Location</th>

                            <th>Type</th>

                            <th>Status</th>

                            <th>Deadline</th>

                        </tr>

                    </thead>

                    <tbody>

                        @foreach($category->jobs as $job)

                            <tr>

                                <td>{{ $job->title }}</td>

                                <td>{{ $job->location }}</td>

                                <td>{{ ucfirst(str_replace('_',' ',$job->job_type)) }}</td>

                                <td>

                                    <span class="status {{ $job->status }}">

                                        {{ ucfirst($job->status) }}

                                    </span>

                                </td>

                                <td>{{ \Carbon\Carbon::parse($job->deadline)->format('d M Y') }}</td>

                            </tr>

                        @endforeach

                    </tbody>

                </table>

            @else

                <div class="empty-state">

                    No jobs available in this category.

                </div>

            @endif

        </div>

    </div>

</x-mainlayout>
