<x-mainlayout>

    <div class="dashboard">

        <section class="dashboard-header">

            <div>

                <h1>Candidates</h1>

                <p>Manage all registered candidates.</p>

            </div>

            <a href="{{ route('candidates.create') }}" class="btn btn-primary">

                <i class="fa-solid fa-plus"></i>

                Add Candidate

            </a>

        </section>

        <section>

            <div class="dashboard-box">

                <div class="box-header">

                    <h3>Candidates List</h3>

                    <span>{{ $candidates->total() }} Candidates</span>

                </div>

                <table>

                    <thead>

                        <tr>

                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Experience</th>
                            <th>Applications</th>
                            <th>CV</th>
                            <th>Actions</th>

                        </tr>

                    </thead>

                    <tbody>

                        @forelse($candidates as $candidate)

                            <tr>

                                <td>{{ $candidate->user->name }}</td>

                                <td>{{ $candidate->user->email }}</td>

                                <td>{{ $candidate->phone }}</td>

                                <td>

                                    {{ $candidate->experience_years }} Years

                                </td>

                                <td>

                                    {{ $candidate->applications_count }}

                                </td>

                                <td>

                                    @if($candidate->cv)

                                        <a href="{{ asset('storage/' . $candidate->cv) }}"
                                            target="_blank"
                                            class="act-btn act-view">

                                            <i class="fa-solid fa-file-pdf"></i>📄

                                        </a>

                                    @else

                                        —

                                    @endif

                                </td>

                                <td>

                                    <div class="action-buttons">

                                        <a href="{{ route('candidates.show', $candidate) }}"
                                            class="act-btn act-view">

                                            <i class="fa-solid fa-eye">View</i>

                                        </a>

                                        <a href="{{ route('candidates.edit', $candidate) }}"
                                            class="act-btn act-edit">

                                            <i class="fa-solid fa-pen">Edit</i>

                                        </a>

                                        <form
                                            action="{{ route('candidates.destroy', $candidate) }}"
                                            method="POST">

                                            @csrf
                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                class="act-btn act-del"
                                                onclick="return confirm('Delete this candidate?')">

                                                <i class="fa-solid fa-trash">Delete</i>

                                            </button>

                                        </form>

                                    </div>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="7" style="text-align:center;padding:40px;">

                                    No candidates found.

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

                <div class="pagination">

                    {{ $candidates->links() }}

                </div>

            </div>

        </section>

    </div>

</x-mainlayout>

