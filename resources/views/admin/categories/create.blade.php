<x-mainlayout>

    <div class="dashboard">

        <section class="dashboard-header">

            <div>

                <h1>Create Category</h1>

                <p>Add a new job category.</p>

            </div>

            <a
                href="{{ route('categories.index') }}"
                class="btn-secondary">

                <i class="fa-solid fa-arrow-left"></i>

                Back

            </a>

        </section>

        <form
            action="{{ route('categories.store') }}"
            method="POST">

            @csrf

            @include('admin.categories.form')

        </form>

    </div>

</x-mainlayout>
