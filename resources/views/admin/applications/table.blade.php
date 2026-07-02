<table>

                <thead>

                    <tr>

                        <th>#</th>

                        <th>Candidate</th>

                        <th>Job</th>

                        <th>Status</th>

                        <th>Applied At</th>

                        <th style="text-align:center;">Actions</th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($applications as $application)

                        <tr>

                            <td>

                                {{ $loop->iteration + ($applications->currentPage() - 1) * $applications->perPage() }}

                            </td>

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

                            <td>

                                {{ $application->created_at->format('d M Y') }}

                            </td>

                            <td>

                                <div class="action-buttons">

                                    <a
                                        href="{{ route('applications.show', $application) }}"
                                        class="act-btn act-view">

                                        <i class="fa-solid fa-eye">View</i>

                                    </a>

                                    <a
                                        href="{{ route('applications.edit', $application) }}"
                                        class="act-btn act-edit">

                                        <i class="fa-solid fa-pen">Edit</i>

                                    </a>

                                    <form
                                        action="{{ route('applications.destroy', $application) }}"
                                        method="POST">

                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="act-btn act-del"
                                            onclick="return confirm('Delete this application?')">

                                            <i class="fa-solid fa-trash">Delete</i>

                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="6">

                                <div class="empty-state">

                                    No applications found.

                                </div>

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

            <div class="pagination">

                {{ $applications->links() }}

            </div>
