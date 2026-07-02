<x-mainlayout>

    @section('title', 'Edit Company')

    <div class="page-header">
        <div>
            <h1 class="page-title">Edit Company</h1>
            <p class="page-sub">Update company information</p>
        </div>
    </div>

    @include('admin.companies.form', ['company' => $company])

</x-mainlayout>