<x-mainlayout>

    <div class="dashboard">

        <section class="dashboard-header">

            <div>

                <h1>Edit Candidate</h1>

                <p>Update candidate information.</p>

            </div>

            <a href="{{ route('candidates.index') }}" class="btn-secondary">

                <i class="fa-solid fa-arrow-left"></i>

                Back

            </a>

        </section>

        <form
            action="{{ route('candidates.update',$candidate) }}"
            method="POST"
            enctype="multipart/form-data">

            @csrf
            @method('PUT')

            @include('candidates.form')

        </form>

    </div>

</x-mainlayout>
