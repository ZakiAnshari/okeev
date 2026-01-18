      @extends('layout.admin')
      @section('title', 'About')
      @section('content')
          <div class="container-xxl flex-grow-1 container-p-y">
              <div class="d-flex justify-content-between align-items-center my-4">
                  <h4 class="fw-bold d-flex align-items-center mb-0">
                      <i class="bx bx-info-circle me-3 text-primary" style="font-size: 1.5rem;"></i>
                      <span>Master About</span>
                  </h4>
              </div>

              <div class="col">
                  <div class="card">
                      <div class="card-body">
                          <form id="aboutForm" action="{{ route('cms.home.about.update') }}" method="post"
                              enctype="multipart/form-data">
                              @csrf
                              {{-- SECTION 1 --}}
                              <div class="mb-4">
                                  <p class="text-muted mb-0 small">First Section</p>
                                  <span class="text-dark fw-semibold d-block mt-2 fs-6 mb-1 ">
                                      About Us First Content *
                                  </span>
                                  <div class="col-md-12 mb-3">
                                      <label class="form-label">Label Section</label>
                                      <input type="text" name="section_label" class="form-control"
                                          placeholder="Contoh: About Okeev"
                                          value="{{ old('section_label', $about->section_label ?? '') }}">

                                      @error('section_label')
                                          <small class="text-danger d-block mt-1">{{ $message }}</small>
                                      @enderror
                                  </div>
                                  <div class="col-md-12 mb-3">
                                      <label class="form-label">Judul Utama</label>
                                      <input type="text" name="title_main" class="form-control"
                                          placeholder="Trusted Multi-Brand Electric Car Dealer"
                                          value="{{ old('title_main', $about->title_main ?? '') }}">

                                      @error('title_main')
                                          <small class="text-danger d-block mt-1">{{ $message }}</small>
                                      @enderror
                                  </div>
                                  <div class="col-md-12 mb-3">
                                      <label class="form-label">Deskripsi</label>

                                      <textarea id="description_main" name="description_main" class="form-control" rows="6"
                                          placeholder="Masukkan deskripsi halaman About">{{ old('description_main', $about->description_main ?? '') }}</textarea>

                                      @error('description_main')
                                          <small class="text-danger d-block mt-1">{{ $message }}</small>
                                      @enderror
                                  </div>

                                  <div class="col-md-12 mb-3">
                                      <label class="form-label">Tagline</label>
                                      <input type="text" name="tagline" class="form-control"
                                          placeholder="Bringing You Into the Era of Future Mobility"
                                          value="{{ old('tagline', $about->tagline ?? '') }}">

                                      @error('tagline')
                                          <small class="text-danger d-block mt-1">{{ $message }}</small>
                                      @enderror
                                  </div>


                              </div>
                              {{-- SECTION 2 --}}
                              <div class="mb-4">
                                  <p class="text-muted mb-0 small">Second Section</p>
                                  <span class="text-dark fw-semibold d-block mt-2 fs-6 mb-1 ">
                                      About Us Second Content *
                                  </span>
                                  <div class="col-md-12 mb-3">
                                      <label class="form-label">Deskripsi</label>
                                      <textarea id="description_second" name="description_second" class="form-control" rows="6"
                                          placeholder="Masukkan deskripsi halaman About">{{ old('description_second', $about->description_second ?? '') }}</textarea>
                                      @error('description_second')
                                          <small class="text-danger d-block mt-1">{{ $message }}</small>
                                      @enderror
                                  </div>
                              </div>
                              {{-- SECTION 3 --}}
                              <div class="mb-4">
                                  <p class="text-muted mb-0 small">Third Section</p>
                                  <span class="text-dark fw-semibold d-block mt-2 fs-6 mb-1 ">
                                      About Us Third Content *
                                  </span>
                                  {{-- VISI --}}
                                  <div class="row">
                                      <div class="col-md-8 mb-3">
                                          <label class="form-label">Visi</label>
                                          <textarea id="visi_description" name="visi_description" class="form-control" rows="4"
                                              placeholder="Masukkan deskripsi halaman About">{{ old('visi_description', $about->visi_description ?? '') }}</textarea>
                                          @error('visi_description')
                                              <small class="text-danger d-block mt-1">{{ $message }}</small>
                                          @enderror
                                      </div>
                                      <div class="col-md-4 mb-3">
                                          <label class="form-label">Gambar Visi</label>

                                          <input type="file" name="visi_image"
                                              class="form-control @error('visi_image') is-invalid @enderror"
                                              accept="image/*">

                                          <small class="text-muted d-block mt-1">
                                              * Format JPG, PNG, JPEG. Maksimal ukuran 2 MB
                                          </small>

                                          @error('visi_image')
                                              <div class="invalid-feedback">
                                                  {{ $message }}
                                              </div>
                                          @enderror

                                          @if (!empty($about->visi_image))
                                              <div class="mt-3">
                                                  <small class="text-muted d-block">
                                                      <strong>Current:</strong> {{ basename($about->visi_image) }}
                                                  </small>

                                                  <img src="{{ asset('storage/' . $about->visi_image) }}"
                                                      alt="Current Visi Image" class="img-fluid rounded mt-2"
                                                      style="max-height: 180px; object-fit: cover;">
                                              </div>
                                          @else
                                              <div class="mt-3">
                                                  <small class="text-muted d-block">
                                                      <strong>Contoh Gambar:</strong> example.jpg
                                                  </small>

                                                  <img src="https://picsum.photos/600/400" alt="Contoh About Image"
                                                      class="img-fluid rounded mt-2"
                                                      style="max-height: 207px; object-fit: cover;">
                                              </div>
                                          @endif
                                      </div>

                                  </div>
                                  {{-- MISI --}}
                                  <div class="row">
                                      <label class="form-label">Misi</label>

                                      <div class="col-md-8">

                                          <div class="mb-2">
                                              <label class="form-label">First Title Misi</label>
                                              <textarea name="title_1" class="form-control" rows="1" placeholder="Masukkan judul konten">{{ old('title_1', $about->title_1 ?? '') }}</textarea>
                                              @error('title_1')
                                                  <small class="text-danger d-block">{{ $message }}</small>
                                              @enderror
                                          </div>

                                          <div class="mb-2">
                                              <label class="form-label">Second Title Misi</label>
                                              <textarea name="title_2" class="form-control" rows="1" placeholder="Masukkan judul konten">{{ old('title_2', $about->title_2 ?? '') }}</textarea>
                                              @error('title_2')
                                                  <small class="text-danger d-block">{{ $message }}</small>
                                              @enderror
                                          </div>

                                          <div class="mb-2">
                                              <label class="form-label">Third Title Misi</label>
                                              <textarea name="title_3" class="form-control" rows="1" placeholder="Masukkan judul konten">{{ old('title_3', $about->title_3 ?? '') }}</textarea>
                                              @error('title_3')
                                                  <small class="text-danger d-block">{{ $message }}</small>
                                              @enderror
                                          </div>

                                          <div class="mb-2">
                                              <label class="form-label">Fourth Title Misi</label>
                                              <textarea name="title_4" class="form-control" rows="1" placeholder="Masukkan judul konten">{{ old('title_4', $about->title_4 ?? '') }}</textarea>
                                              @error('title_4')
                                                  <small class="text-danger d-block">{{ $message }}</small>
                                              @enderror
                                          </div>

                                      </div>


                                      <div class="col-md-4">
                                          <label class="form-label">Gambar Misi</label>

                                          <input type="file" name="misi_image"
                                              class="form-control @error('misi_image') is-invalid @enderror"
                                              accept="image/*">

                                          <small class="text-muted d-block">
                                              * Format JPG, PNG, JPEG. Maksimal ukuran 2 MB
                                          </small>

                                          @error('misi_image')
                                              <div class="invalid-feedback">
                                                  {{ $message }}
                                              </div>
                                          @enderror

                                          @if (!empty($about->misi_image))
                                              <div class="mt-3">
                                                  <small class="text-muted d-block">
                                                      <strong>Current:</strong> {{ basename($about->misi_image) }}
                                                  </small>

                                                  <img src="{{ asset('storage/' . $about->misi_image) }}"
                                                      alt="Current Misi Image" class="img-fluid rounded mt-2"
                                                      style="max-height: 180px; object-fit: cover;">
                                              </div>
                                          @else
                                              <div class="mt-3">
                                                  <small class="text-muted d-block">
                                                      <strong>Contoh Gambar:</strong> example.jpg
                                                  </small>

                                                  <img src="https://picsum.photos/600/400" alt="Contoh About Image"
                                                      class="img-fluid rounded mt-2"
                                                      style="max-height: 207px; object-fit: cover;">
                                              </div>
                                          @endif
                                      </div>

                                  </div>
                              </div>
                              {{-- SECTION 4 --}}
                              <div class="mb-4">
                                  <p class="text-muted mb-0 small mt-3">Fourth Section</p>
                                  <span class="text-dark fw-semibold d-block mt-2 fs-6 mb-1">
                                      About Us Fourth Content *
                                  </span>
                                  <div class="row mb-3">
                                      <div class="col-md-4 mb-2">
                                          <label class="form-label"> First Title Electronic And Smart Devices </label>
                                          <input type="text" name="title" class="form-control"
                                              placeholder="Masukkan judul konten"
                                              value="{{ old('title', $content->title ?? '') }}">
                                          @error('title')
                                              <small class="text-danger d-block mt-1">{{ $message }}</small>
                                          @enderror
                                      </div>
                                      <div class="col-md-4 mb-2">
                                          <label class="form-label"> Second Title Electronic And Smart Devices </label>
                                          <input type="text" name="fourth_title_1" class="form-control"
                                              placeholder="Masukkan judul konten"
                                              value="{{ old('fourth_title_1', $about->fourth_title_1 ?? '') }}">
                                          @error('fourth_title_1')
                                              <small class="text-danger d-block mt-1">{{ $message }}</small>
                                          @enderror
                                      </div>
                                      <div class="col-md-4 mb-2">
                                          <label class="form-label"> Third Title Electronic And Smart Devices </label>
                                          <input type="text" name="fourth_title_2" class="form-control"
                                              placeholder="Masukkan judul konten"
                                              value="{{ old('fourth_title_2', $about->fourth_title_2 ?? '') }}">
                                          @error('fourth_title_2')
                                              <small class="text-danger d-block mt-1">{{ $message }}</small>
                                          @enderror
                                      </div>
                                      <div class="col-md-4 mb-2">
                                          <label class="form-label"> Third Title Electronic And Smart Devices </label>
                                          <input type="text" name="fourth_title_3" class="form-control"
                                              placeholder="Masukkan judul konten"
                                              value="{{ old('fourth_title_3', $about->fourth_title_3 ?? '') }}">
                                          @error('fourth_title_3')
                                              <small class="text-danger d-block mt-1">{{ $message }}</small>
                                          @enderror
                                      </div>
                                  </div>

                                  <div class="row">
                                      <div class="col-md-6 mb-3">
                                          <label class="form-label">First Support Services</label>
                                          <textarea name="support_service_1" class="form-control" rows="3"
                                              placeholder="Masukkan konten support service pertama">{{ old('support_service_1', $about->support_service_1 ?? '') }}</textarea>
                                          @error('support_service_1')
                                              <small class="text-danger d-block mt-1">{{ $message }}</small>
                                          @enderror
                                      </div>

                                      <div class="col-md-6 mb-3">
                                          <label class="form-label">Second Support Services</label>
                                          <textarea name="support_service_2" class="form-control" rows="3"
                                              placeholder="Masukkan konten support service kedua">{{ old('support_service_2', $about->support_service_2 ?? '') }}</textarea>
                                          @error('support_service_2')
                                              <small class="text-danger d-block mt-1">{{ $message }}</small>
                                          @enderror
                                      </div>

                                      <div class="col-md-6 mb-3">
                                          <label class="form-label">Third Support Services</label>
                                          <textarea name="support_service_3" class="form-control" rows="3"
                                              placeholder="Masukkan konten support service ketiga">{{ old('support_service_3', $about->support_service_3 ?? '') }}</textarea>
                                          @error('support_service_3')
                                              <small class="text-danger d-block mt-1">{{ $message }}</small>
                                          @enderror
                                      </div>

                                      <div class="col-md-6 mb-3">
                                          <label class="form-label">Fourth Support Services</label>
                                          <textarea name="support_service_4" class="form-control" rows="3"
                                              placeholder="Masukkan konten support service keempat">{{ old('support_service_4', $about->support_service_4 ?? '') }}</textarea>
                                          @error('support_service_4')
                                              <small class="text-danger d-block mt-1">{{ $message }}</small>
                                          @enderror
                                      </div>
                                  </div>

                              </div>

                              <div class="d-flex justify-content-end gap-2 mb-3 mt-4">
                                  <button type="button" id="resetBtn"
                                      class="btn btn-outline-secondary d-flex align-items-center">
                                      <i class="bx bx-reset me-2"></i>
                                      <span>Reset</span>
                                  </button>

                                  <button type="submit" class="btn btn-outline-success d-flex align-items-center">
                                      <i class="bx bx-save "></i>
                                      <span>Save Changes</span>
                                  </button>
                              </div>
                          </form>
                          <script>
                              document.addEventListener('DOMContentLoaded', function() {
                                  const resetBtn = document.getElementById('resetBtn');
                                  const form = document.getElementById('aboutForm');
                                  if (!resetBtn || !form) return;
                                  resetBtn.addEventListener('click', function() {
                                      form.querySelectorAll('input, textarea, select').forEach(function(el) {
                                          if (el.type === 'checkbox' || el.type === 'radio') el.checked = false;
                                          else el.value = '';
                                      });
                                  });
                              });
                          </script>
                      </div>
                  </div>
              </div>


          </div>

      @endsection
