<table>

                <thead>

                    <tr>

                        <th>#</th>

                        <th>Name</th>

                        <th>Jobs</th>

                        <th>Created At</th>

                        <th style="text-align:center;">Actions</th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($categories as $category)

                        <tr>

                            <td>
                                {{ $loop->iteration + ($categories->currentPage() - 1) * $categories->perPage() }}
                            </td>

                            <td>{{ $category->name }}</td>

                            <td>

                                <span class="status open">

                                    {{ $category->jobs_count }}

                                </span>

                            </td>

                            <td>

                                {{ $category->created_at->format('d M Y') }}

                            </td>

                            <td>

                                <div class="action-buttons">

                                    <a
                                        href="{{ route('categories.show', $category) }}"
                                        class="act-btn act-view">

                                        <i class="fa-solid fa-eye">Show</i>

                                    </a>

                                    <a
                                        href="{{ route('categories.edit', $category) }}"
                                        class="act-btn act-edit">

                                        <i class="fa-solid fa-pen">Edit</i>

                                    </a>

                                    <form
                                        action="{{ route('categories.destroy', $category) }}"
                                        method="POST">

                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="act-btn act-del"
                                            onclick="return confirm('Delete this category?')">

                                            <i class="fa-solid fa-trash">Delete</i>

                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="5">

                                <div class="empty-state">

                                    No categories found.

                                </div>

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

            <div class="pagination">

                {{ $categories->links() }}

            </div>
