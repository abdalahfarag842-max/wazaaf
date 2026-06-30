<x-mainlayout>

    <div class="dashboard">

        <section class="dashboard-header">

            <div>

                <h1>Categories</h1>

                <p>Manage all job categories.</p>

            </div>

            <a href="{{ route('categories.create') }}" class="btn-primary">

                <i class="fa-solid fa-plus"></i>

                Add Category

            </a>

        </section>

        <section>
            @include('partials.search')
            <div class="dashboard-box" id="table-container">

                <div class="box-header">

                    <h3>Categories List</h3>

                    <span>{{ $categories->total() }} Categories</span>

                </div>

                @include('categories.table')

            </div>

        </section>

    </div>

</x-mainlayout>
