<x-mainlayout>

    <div class="dashboard">

        <section class="dashboard-header">

            <div>

                <h1>Edit Category</h1>

                <p>Update category information.</p>

            </div>

            <a
                href="{{ route('categories.index') }}"
                class="btn-secondary">

                <i class="fa-solid fa-arrow-left"></i>

                Back

            </a>

        </section>

        <form
            action="{{ route('categories.update', $category) }}"
            method="POST">

            @csrf
            @method('PUT')

            @include('categories.form')

        </form>

    </div>

</x-mainlayout>
