<x-mainlayout>
    <link rel="stylesheet" href="/css/admin/category/index.css">
    <div class="page-header">
        <div>
            <h1 class="page-title">category</h1>
            <p class="page-sub">Manage all job category</p>
        </div>
    </div>
    <div class="countcontenaire">
        <div class="countCategory">
            <h4>Total Category</h4>
            <h2>{{ $totalCategory }}</h2>
            <h4>all category</h4>
        </div>
        <div class="countCategory">
            <h4>total Job</h4>
            <h2>{{ $totalJob }}</h2>
            <h4>across all category</h4>
        </div>
        <div class="countCategory">
            <h4>Most Active</h4>
            <h2>{{ $mostActive->name }}</h2>
            <h4>{{ $mostActive->jobs_count }} jobs posted</h4>
        </div>
    </div>
</x-mainlayout>