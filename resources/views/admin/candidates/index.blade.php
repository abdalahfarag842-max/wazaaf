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
            @include('partials.search')
            <div class="dashboard-box" id="table-container">

                <div class="box-header">

                    <h3>Candidates List</h3>

                    <span>{{ $candidates->total() }} Candidates</span>

                </div>

                @include('admin.candidates.table')

            </div>

        </section>

    </div>

</x-mainlayout>

