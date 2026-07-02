<x-mainlayout>

    <div class="dashboard">

        <section class="dashboard-header">

            <div>

                <h1>Applications</h1>

                <p>Manage submitted job applications.</p>

            </div>

        </section>
        @include('partials.search')
        <div class="dashboard-box" id="table-container">
            <div class="box-header">

                    <h3>Applications List</h3>

                    <span>{{ $applications->total() }} Applications</span>

                </div>
            @include('admin.applications.table')

        </div>

    </div>

</x-mainlayout>
