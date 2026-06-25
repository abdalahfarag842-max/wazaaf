<x-mainlayout>

    <div class="dashboard">

        <section class="dashboard-header">

            <div>
                <h1>Dashboard</h1>
                <p>Welcome back, {{ auth()->user()->name }}.</p>
            </div>

            <div class="dashboard-date">
                {{ now()->format('d M Y') }}
            </div>

        </section>

        <section class="stats-grid">

            <article class="stat-card">
                <span>Total Jobs</span>
                <h2>{{ $jobsCount }}</h2>
                <small>Available job posts</small>
            </article>

            <article class="stat-card">
                <span>Candidates</span>
                <h2>{{ $candidatesCount }}</h2>
                <small>Registered candidates</small>
            </article>

            <article class="stat-card">
                <span>Applications</span>
                <h2>{{ $applicationsCount }}</h2>
                <small>Total submitted applications</small>
            </article>

            <article class="stat-card">
                <span>Categories</span>
                <h2>{{ $categoriesCount }}</h2>
                <small>Job categories</small>
            </article>

        </section>
        <section class="dashboard-content">

            <!-- Latest Jobs -->

            <div class="dashboard-box">

                <div class="box-header">
                    <h3>Latest Jobs</h3>
                    <a href="{{ route('jobs.index') }}">View All</a>
                </div>

                <table>

                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Location</th>
                            <th>Status</th>
                        </tr>
                    </thead>

                    <tbody>

                        @foreach($latestJobs as $job)

                            <tr>

                                <td>{{ $job->title }}</td>

                                <td>{{ $job->location }}</td>

                                <td>
                                    <span class="status {{ $job->status }}">
                                        {{ ucfirst($job->status) }}
                                    </span>
                                </td>

                            </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>

            <!-- Latest Applications -->

            <div class="dashboard-box">

                <div class="box-header">
                    <h3>Latest Applications</h3>
                    <a href="{{ route('applications.index') }}">View All</a>
                </div>

                <table>

                    <thead>

                        <tr>
                            <th>Candidate</th>
                            <th>Job</th>
                            <th>Status</th>
                        </tr>

                    </thead>

                    <tbody>

                        @foreach($latestApplications as $application)

                            <tr>

                                <td>
                                    {{ $application->candidate->user->name }}
                                </td>

                                <td>
                                    {{ $application->job->title }}
                                </td>

                                <td>

                                    <span class="status {{ $application->status }}">
                                        {{ ucfirst($application->status) }}
                                    </span>

                                </td>

                            </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>

        </section>

    </div>

</x-mainlayout>