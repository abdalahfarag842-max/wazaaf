<x-mainlayout>

    <div class="dashboard">

        <section class="dashboard-header">

            <div>

                <h1>Jobs</h1>

                <p>Manage all available job opportunities.</p>

            </div>

            <a href="{{ route('jobs.create') }}" class="btn-primary">
                Add Job
            </a>

        </section>

        <section>

            <div class="dashboard-box">

                <div class="box-header">

                    <h3>Jobs List</h3>

                    <span>{{ $jobs->total() }} Jobs</span>

                </div>

                <table>

                    <thead>

                        <tr>

                            <th>Title</th>
                            <th>Category</th>
                            <th>Location</th>
                            <th>Salary</th>
                            <th>Type</th>
                            <th>Status</th>
                            <th>Created By</th>
                            <th>Actions</th>

                        </tr>

                    </thead>

                    <tbody>

                        @forelse ($jobs as $job)

                            <tr>

                                <td>{{ $job->title }}</td>

                                <td>{{ $job->category->name }}</td>

                                <td>{{ $job->location }}</td>

                                <td>${{ number_format($job->salary) }}</td>

                                <td>{{ ucwords(str_replace('_', ' ', $job->job_type)) }}</td>

                                <td>

                                    <span class="status {{ $job->status }}">
                                        {{ ucfirst($job->status) }}
                                    </span>

                                </td>

                                <td>{{ $job->creator->name }}</td>

                                <td>

                                    <div class="action-buttons">

                                        <a href="{{ route('jobs.show', $job) }}"
                                            class="act-btn act-view">

                                            <i class="fa-solid fa-eye">View</i>

                                        </a>

                                        <a href="{{ route('jobs.edit', $job) }}"
                                            class="act-btn act-edit">

                                            <i class="fa-solid fa-pen">Edit</i>

                                        </a>

                                        <form action="{{ route('jobs.destroy', $job) }}"
                                            method="POST">

                                            @csrf
                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                class="act-btn act-del"
                                                onclick="return confirm('Delete this job?')">

                                                <i class="fa-solid fa-trash">Delete</i>

                                            </button>

                                        </form>

                                    </div>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="8" style="text-align:center;padding:35px">

                                    No jobs found.

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

                <div class="pagination">

                    {{ $jobs->links() }}

                </div>

            </div>

        </section>

    </div>

</x-mainlayout>
