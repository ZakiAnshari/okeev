@extends('layout.admin')
@section('title', 'Edit-News')
@section('content')

    <div class="container-xxl flex-grow-1 container-p-y">

        <div class="card">
            <!-- Tombol kembali -->
            <div class="d-flex align-items-center border-bottom pb-2 mb-3">
                <a class="mx-4 my-4" href="/news">
                    <button class="btn btn-outline-primary border-1 rounded-1 px-3 py-1 d-flex align-items-center"
                        data-bs-toggle="tooltip" title="Kembali">
                        <i class="bi bi-arrow-left fs-5 mx-1"></i>
                    </button>
                </a>

                <h4 class="fw-bold d-flex align-items-center my-4">
                    Edit News
                    <i class="bx bx-cog mx-2 text-primary" style="font-size: 1.5rem;"></i>
                </h4>
            </div>

            <div class="card-body">
                <div class="text-nowrap">

                    {{-- Error Validation --}}
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('news.update', $news->slug) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('POST')

                        <div class="row">

                            <!-- Title -->
                            <div class="col-lg-12 mb-3">
                                <label class="form-label">Judul Berita</label>
                                <input type="text" name="title" class="form-control"
                                    value="{{ old('title', $news->title) }}" placeholder="Masukkan judul berita">

                                @error('title')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <!-- Content -->
                            <div class="col-lg-12 mb-3">
                                <label class="form-label">Isi Berita</label>

                                <textarea name="content" id="editor" class="form-control" rows="5" placeholder="Tulis isi berita...">{{ old('content', $news->content) }}</textarea>

                                @error('content')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <!-- Author -->
                            <div class="col-lg-6 mb-3">
                                <label class="form-label">Penulis</label>
                                <input type="text" name="author" class="form-control"
                                    value="{{ old('author', $news->author) }}" placeholder="Nama penulis">

                                @error('author')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <!-- Status -->
                            <div class="col-lg-6 mb-3">
                                <label class="form-label">Status</label>
                                <select name="status" class="form-control">
                                    <option value="draft" {{ old('status', $news->status) == 'draft' ? 'selected' : '' }}>
                                        Draft</option>
                                    <option value="published"
                                        {{ old('status', $news->status) == 'published' ? 'selected' : '' }}>Published
                                    </option>
                                </select>

                                @error('status')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <!-- Publish Date -->
                            <div class="col-lg-6 mb-3">
                                <label class="form-label">Tanggal Publish</label>
                                <input type="datetime-local" name="published_at" class="form-control"
                                    value="{{ old('published_at', $news->published_at ? date('Y-m-d\TH:i', strtotime($news->published_at)) : '') }}">

                                @error('published_at')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <!-- Thumbnail -->
                            <div class="col-lg-6 mb-3">
                                <label class="form-label">Thumbnail</label>
                                <input type="file" name="thumbnail" class="form-control" id="thumbnailInput">

                                <!-- Note -->
                                <small class="text-muted d-block mt-1">
                                    *Format yang diperbolehkan: JPG, JPEG, PNG. <br>
                                    *Maksimal ukuran 2MB.
                                </small>

                                @error('thumbnail')
                                    <small class="text-danger d-block">{{ $message }}</small>
                                @enderror
                            </div>

                            <!-- Preview Thumbnail -->
                            <div class="col-lg-12 mb-3">
                                <div class="text-center">

                                    @if ($news->thumbnail)
                                        <img id="thumbnailPreview" src="{{ asset('storage/' . $news->thumbnail) }}"
                                            alt="Preview"
                                            style="width:150px;height:150px;object-fit:cover;border:1px solid #ccc;border-radius:6px;">
                                    @else
                                        <img id="thumbnailPreview" src="#"
                                            style="width:150px;height:150px;object-fit:cover;border:1px solid #ccc;border-radius:6px;display:none;">
                                    @endif

                                </div>
                            </div>

                        </div>

                        <div class="text-end mt-4">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>

                    </form>

                </div>
            </div>


        </div>
    </div>

    {{-- JS Preview Thumbnail --}}
    <script>
        document.getElementById('thumbnailInput').addEventListener('change', function(e) {
            const img = document.getElementById('thumbnailPreview');
            img.style.display = 'block';
            img.src = URL.createObjectURL(e.target.files[0]);
        });
    </script>

    @include('sweetalert::alert')
@endsection
