<x-mainlayout>

    <div class="dashboard">

        <section class="dashboard-header">

            <div>

                <h1>Candidate Details</h1>

                <p>View candidate profile and information.</p>

            </div>

            <a href="{{ route('candidates.index') }}" class="btn-secondary">

                <i class="fa-solid fa-arrow-left"></i>

                Back

            </a>

        </section>

        <div class="dashboard-box">

            <div class="details-grid">

                <div class="detail-item">

                    <label>Name</label>

                    <p>{{ $candidate->user->name }}</p>

                </div>

                <div class="detail-item">

                    <label>Email</label>

                    <p>{{ $candidate->user->email }}</p>

                </div>

                <div class="detail-item">

                    <label>Phone</label>

                    <p>{{ $candidate->phone }}</p>

                </div>

                <div class="detail-item">

                    <label>Address</label>

                    <p>{{ $candidate->address }}</p>

                </div>

                <div class="detail-item">

                    <label>Experience</label>

                    <p>{{ $candidate->experience_years }} Years</p>

                </div>

                <div class="detail-item">

                    <label>Total Applications</label>

                    <p>{{ $candidate->applications->count() }}</p>

                </div>

                <div class="detail-item full">

                    <label>Bio</label>

                    <p class="job-description">

                        {{ $candidate->bio ?: 'No bio available.' }}

                    </p>

                </div>

                <div class="detail-item full">

                    <label>CV</label>

                    @if($candidate->cv)

                        <a
                            href="{{ asset('storage/'.$candidate->cv) }}"
                            target="_blank"
                            class="btn-primary">

                            <i class="fa-solid fa-file-pdf"></i>

                            View CV

                        </a>

                    @else

                        <p>No CV uploaded.</p>

                    @endif

                </div>

            </div>

        </div>

        @if($candidate->applications->count())

            <div class="dashboard-box" style="margin-top:25px;">

                <div class="box-header">

                    <h3>Applications</h3>

                </div>

                <table>

                    <thead>

                        <tr>

                            <th>Job</th>

                            <th>Status</th>

                            <th>Applied At</th>

                        </tr>

                    </thead>

                    <tbody>

                        @foreach($candidate->applications as $application)

                            <tr>

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

                            </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>

        @endif

    </div>

</x-mainlayout>
