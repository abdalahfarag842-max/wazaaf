<x-mainlayout>

    <div class="dashboard">

        <section class="dashboard-header">

            <div>

                <h1>Edit Job</h1>

                <p>Update the selected job information.</p>

            </div>

            <a href="{{ route('jobs.index') }}" class="btn-secondary">

                <i class="fa-solid fa-arrow-left"></i>

                Back

            </a>

        </section>

        <form action="{{ route('jobs.update', $job) }}" method="POST">

            @csrf
            @method('PUT')

            @include('jobs.form')

        </form>

    </div>

</x-mainlayout>
