<x-mainlayout>

    <div class="dashboard">

        <section class="dashboard-header">

            <div>

                <h1>Create Candidate</h1>

                <p>Create a new candidate account.</p>

            </div>

            <a href="{{ route('candidates.index') }}" class="btn-secondary">

                <i class="fa-solid fa-arrow-left"></i>

                Back

            </a>

        </section>

        <form
            action="{{ route('candidates.store') }}"
            method="POST"
            enctype="multipart/form-data">

            @csrf

            @include('candidates.form')

        </form>

    </div>

</x-mainlayout>
