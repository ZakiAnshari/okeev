@extends('layout.admin')
@section('title', 'Edit-Order')
@section('content')

    <div class="container-xxl flex-grow-1 container-p-y">

        <div class="card">
            <!-- Tombol kembali -->
            <div class="d-flex align-items-center border-bottom pb-2 mb-3">
                <a class="mx-4 my-4" href="/orders">
                    <button class="btn btn-outline-primary border-1 rounded-1 px-3 py-1 d-flex align-items-center"
                        data-bs-toggle="tooltip" title="Kembali">
                        <i class="bi bi-arrow-left fs-5 mx-1"></i>
                    </button>
                </a>

                <h4 class="fw-bold d-flex align-items-center my-4">
                    Order
                    <i class="bx bx-receipt mx-2 text-primary" style="font-size: 1.5rem;"></i>
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

                    <form action="#" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('POST')

                        <div class="row">

                            <div class="mb-3">
                                <label class="form-label m-0">No. Transaksi</label> :
                                <strong class="fs-6">{{ $orders->external_id }}</strong>
                                <div class="text-muted small">
                                    {{ $orders->created_at->timezone('Asia/Jakarta')->format('d F Y, H:i') }} WIB
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">Nama Pemesan</label>
                                    <div class="form-control bg-light">
                                        {{ $orders->first_name }}
                                    </div>
                                </div>
                            </div>


                            <!-- Title -->
                            <div class="col-lg-12 mb-3">
                                <label class="form-label d-block">Status</label>

                                <div class="d-flex flex-wrap gap-2">

                                    <div class="d-flex justify-content-center">
                                        <input type="radio" class="btn-check" name="status" id="status-new"
                                            value="new" {{ old('status', $orders->status) == 'new' ? 'checked' : '' }}>
                                        <label class="btn btn-outline-primary w-100" for="status-new">
                                            <i class="bx bx-bell-plus me-1"></i> New
                                        </label>
                                    </div>

                                    <div class="d-flex justify-content-center">
                                        <input type="radio" class="btn-check" name="status" id="status-processing"
                                            value="processing"
                                            {{ old('status', $orders->status) == 'processing' ? 'checked' : '' }}>
                                        <label class="btn btn-outline-primary w-100" for="status-processing">
                                            <i class="bx bx-loader-circle me-1"></i> Processing
                                        </label>
                                    </div>

                                    <div class="d-flex justify-content-center">
                                        <input type="radio" class="btn-check" name="status" id="status-being-sent"
                                            value="being_sent"
                                            {{ old('status', $orders->status) == 'being_sent' ? 'checked' : '' }}>
                                        <label class="btn btn-outline-primary w-100" for="status-being-sent">
                                            <i class="bx bx-car me-1"></i> Being Sent
                                        </label>
                                    </div>

                                    <div class="d-flex justify-content-center">
                                        <input type="radio" class="btn-check" name="status" id="status-location"
                                            value="to_the_location"
                                            {{ old('status', $orders->status) == 'to_the_location' ? 'checked' : '' }}>
                                        <label class="btn btn-outline-primary w-100" for="status-location">
                                            <i class="bx bx-map me-1"></i> Location
                                        </label>
                                    </div>

                                    <div class="d-flex justify-content-center">
                                        <input type="radio" class="btn-check" name="status" id="status-delivered"
                                            value="delivered"
                                            {{ old('status', $orders->status) == 'delivered' ? 'checked' : '' }}>
                                        <label class="btn btn-outline-primary w-100" for="status-delivered">
                                            <i class="bx bx-check-circle me-1"></i> Delivered
                                        </label>
                                    </div>

                                    <div class="d-flex justify-content-center">
                                        <input type="radio" class="btn-check" name="status" id="status-cancelled"
                                            value="cancelled"
                                            {{ old('status', $orders->status) == 'cancelled' ? 'checked' : '' }}>
                                        <label class="btn btn-outline-primary w-100" for="status-cancelled">
                                            <i class="bx bx-x-circle me-1"></i> Cancelled
                                        </label>
                                    </div>

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

    @include('sweetalert::alert')
@endsection
