<x-mainlayout>

    @section('title', 'Add Company')

    <div class="page-header">
        <div>
            <h1 class="page-title">Add Company</h1>
            <p class="page-sub">Create a new company</p>
        </div>
    </div>

    @include('admin.companies.form')

</x-mainlayout>