<div class="dashboard-box">

    <div class="box-header">

        <h3>

            {{ isset($category) ? 'Category Information' : 'New Category' }}

        </h3>

    </div>

    <div class="form-grid">

        <div class="form-group full">

            <label for="name">

                Category Name

            </label>

            <input
                type="text"
                id="name"
                name="name"
                placeholder="Enter category name"
                value="{{ old('name', $category->name ?? '') }}">

            @error('name')

                <small class="error">

                    {{ $message }}

                </small>

            @enderror

        </div>

    </div>

    <div class="form-actions">

        <a
            href="{{ route('categories.index') }}"
            class="btn-secondary">

            <i class="fa-solid fa-arrow-left "></i>

            Cancel

        </a>

        <button
            type="submit"
            class="btn-primary">

            <i class="fa-solid fa-floppy-disk"></i>

            {{ isset($category) ? 'Update Category' : 'Create Category' }}

        </button>

    </div>

</div>
