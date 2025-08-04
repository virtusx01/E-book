@if ($errors->any())
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
        <strong class="font-bold">Oops!</strong>
        <span class="block sm:inline">Terjadi beberapa kesalahan.</span>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    <div>
        <label for="title" class="block text-sm font-medium text-gray-700">Judul</label>
        <input type="text" name="title" id="title" value="{{ old('title', $book->title ?? '') }}" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
    </div>

    <div>
        <label for="author" class="block text-sm font-medium text-gray-700">Penulis</label>
        <input type="text" name="author" id="author" value="{{ old('author', $book->author ?? '') }}" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
    </div>

    <div>
        <label for="release_date" class="block text-sm font-medium text-gray-700">Tanggal Rilis</label>
        <input type="date" name="release_date" id="release_date" value="{{ old('release_date', $book->release_date ?? '') }}" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
    </div>

    <div>
        <label for="publisher" class="block text-sm font-medium text-gray-700">Penerbit</label>
        <input type="text" name="publisher" id="publisher" value="{{ old('publisher', $book->publisher ?? '') }}" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700">Kategori (Pilih satu atau lebih)</label>
        <div id="category_selection_container" class="mt-1 flex flex-wrap gap-2 p-2">
            @foreach($categories as $category)
                <span
                    class="category-tag inline-block px-3 py-1 rounded-full cursor-pointer border transition-colors duration-200 ease-in-out
                           @if(isset($book) && $book->categories->contains($category->id))
                               bg-blue-600 text-white border-blue-600
                           @elseif(is_array(old('category_ids')) && in_array($category->id, old('category_ids')))
                               bg-blue-600 text-white border-blue-600
                           @else
                               bg-gray-100 text-gray-700 border-gray-300 hover:bg-gray-200
                           @endif"
                    data-id="{{ $category->id }}"
                    data-name="{{ $category->name }}"
                >
                    {{ $category->name }}
                </span>
            @endforeach
        </div>
        <div id="hidden_category_inputs">
        </div>

        <div class="mt-4 p-3 bg-gray-50 rounded-md border border-gray-200">
            <p class="text-sm font-medium text-gray-700 mb-1">Kategori Terpilih:</p>
            <span id="selected_categories_preview" class="text-sm text-gray-600">Tidak ada kategori terpilih.</span>
        </div>
    </div>

    <div>
        <label for="number_of_pages" class="block text-sm font-medium text-gray-700">Jumlah Halaman</label>
        <input type="text" name="number_of_pages" id="number_of_pages" value="{{ old('number_of_pages', $book->number_of_pages ?? '') }}" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
    </div>

    <div class="md:col-span-2">
        <label for="cover_book" class="block text-sm font-medium text-gray-700">Cover Buku</label>
        <input type="file" name="cover_book" id="cover_book" class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
        @isset($book)
            @if($book->cover_book)
            <div class="mt-4">
                <p class="text-sm text-gray-500">Cover Saat Ini:</p>
                <img src="{{ asset('storage/' . $book->cover_book) }}" alt="Current Cover" class="h-32 mt-2 rounded">
            </div>
            @endif
        @endisset
    </div>


    <div class="md:col-span-2">
        <label for="synopsis" class="block text-sm font-medium text-gray-700">Sinopsis</label>
        <textarea name="synopsis" id="synopsis" rows="4" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500">{{ old('synopsis', $book->synopsis ?? '') }}</textarea>
    </div>

    <div class="md:col-span-2">
        <label for="content" class="block text-sm font-medium text-gray-700">Konten Buku</label>
        <div class="mt-1 border border-gray-300 rounded-md shadow-sm overflow-hidden focus-within:border-indigo-500 focus-within:ring-1 focus-within:ring-indigo-500">
            <textarea name="content" id="content" required class="block w-full border-0 resize-none p-4 focus:ring-0" style="height: 400px;">{{ old('content', $book->content ?? '') }}</textarea>
        </div>
        <p class="mt-2 text-sm text-gray-500">Konten dapat di-scroll jika isinya panjang.</p>
    </div>
</div>

<div class="mt-8 flex justify-end">
    <a href="{{ route('books.index') }}" class="bg-gray-200 text-gray-700 py-2 px-4 rounded-md shadow-sm hover:bg-gray-300 mr-4">Batal</a>
    <button type="submit" class="bg-blue-600 text-white py-2 px-4 rounded-md shadow-sm hover:bg-blue-700">{{ isset($book) ? 'Update Buku' : 'Simpan Buku' }}</button>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const categorySelectionContainer = document.getElementById('category_selection_container');
        const previewSpan = document.getElementById('selected_categories_preview');
        const hiddenInputsContainer = document.getElementById('hidden_category_inputs');
        let selectedCategoryIds = new Set(); 

        // Fungsi untuk memperbarui bidang input tersembunyi untuk pengiriman formulir
        function updateHiddenInputs() {
            hiddenInputsContainer.innerHTML = ''; 
            selectedCategoryIds.forEach(id => {
                const input = document.createElement('input');
                input.type = 'hidden';
                input.name = 'category_ids[]';
                input.value = id;
                hiddenInputsContainer.appendChild(input);
            });
        }

        // Fungsi untuk memperbarui tampilan pratinjau kategori
        function updateCategoryPreview() {
            const selectedNames = Array.from(categorySelectionContainer.children)
                                 .filter(tag => tag.classList.contains('bg-blue-600'))
                                 .map(tag => tag.dataset.name);

            if (selectedNames.length > 0) {
                previewSpan.textContent = selectedNames.join(', ');
            } else {
                previewSpan.textContent = 'Tidak ada kategori terpilih.';
            }
        }

        // Inisialisasi kategori yang dipilih berdasarkan opsi yang sudah dipilih (jika ada)
        Array.from(categorySelectionContainer.children).forEach(tag => {
            if (tag.classList.contains('bg-blue-600')) {
                selectedCategoryIds.add(tag.dataset.id);
            }
        });
        updateHiddenInputs();
        updateCategoryPreview(); 

        // Tambahkan event listener klik ke wadah dan delegasikan ke tag kategori
        categorySelectionContainer.addEventListener('click', function(event) {
            const clickedTag = event.target.closest('.category-tag');
            if (clickedTag) {
                const categoryId = clickedTag.dataset.id;

                if (selectedCategoryIds.has(categoryId)) {
                    selectedCategoryIds.delete(categoryId);
                    clickedTag.classList.remove('bg-blue-600', 'text-white', 'border-blue-600');
                    clickedTag.classList.add('bg-gray-100', 'text-gray-700', 'border-gray-300', 'hover:bg-gray-200');
                } else {
                    selectedCategoryIds.add(categoryId);
                    clickedTag.classList.remove('bg-gray-100', 'text-gray-700', 'border-gray-300', 'hover:bg-gray-200');
                    clickedTag.classList.add('bg-blue-600', 'text-white', 'border-blue-600');
                }
                updateHiddenInputs();
                updateCategoryPreview();
            }
        });
    });
</script>
