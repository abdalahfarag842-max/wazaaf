<x-mainlayout>

    <div class="dashboard">

        <section class="dashboard-header">

            <div>

                <h1>Create Job</h1>

                <p>Create a new job opportunity.</p>

            </div>

            <a href="{{ route('jobs.index') }}" class="btn-secondary">
                <i class="fa-solid fa-arrow-left"></i>Back
            </a>

        </section>

        <form action="{{ route('jobs.store') }}" method="POST">

            @csrf

            @include('jobs.form')

        </form>

    </div>

</x-mainlayout>
