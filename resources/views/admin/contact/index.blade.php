@extends('layout.admin')
@section('title', 'Contact')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <h4 class="fw-bold d-flex align-items-center my-4">
                <i class="bx bx-news me-2 text-primary" style="font-size: 1.5rem;"></i>
                <span class="fw-light me-1 text-muted">News</span>
            </h4>

            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive text-nowrap">
                            <!-- Table Data -->
                            <table id="newsTable" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th style="width: 5px;">No</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Subject</th>
                                        <th>Tanggal Masuk</th> <!-- Tambahan -->
                                        <th style="width: 100px; text-align: center;">Aksi</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($contacts as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->email }}</td>
                                            <td>{{ $item->phone }}</td>
                                            <td>{{ $item->subject }}</td>
                                            <td>{{ $item->created_at->format('d F Y, H:i') }} WIB</td>
                                            <td class="text-center">

                                                <a href="{{ url('Contact-show/' . $item->id) }}"
                                                    class="btn btn-icon btn-outline-info" title="Detail">
                                                    <i class="bx bx-show"></i>
                                                </a>

                                                <a href="javascript:void(0)"
                                                    onclick="confirmDeletecontact('{{ $item->id }}', '{{ $item->name }}')">
                                                    <button class="btn btn-icon btn-outline-danger" title="Hapus">
                                                        <i class="bx bx-trash"></i>
                                                    </button>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function confirmDeletecontact(id, model_name) {
            Swal.fire({
                title: 'Yakin ingin menghapus?',
                text: `"${model_name}" akan dihapus secara permanen!`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Arahkan ke route GET untuk destroy
                    window.location.href = `/Contact-destroy/${id}`;
                }
            });
        }
    </script>

    <!-- JQuery -->
    <script>
        $(document).ready(function() {
            $('#newsTable').DataTable({
                responsive: true,
                autoWidth: false,
                pageLength: 10,
                language: {
                    search: "Cari:",
                    lengthMenu: "Tampilkan _MENU_ data",
                    info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                    paginate: {
                        next: "Berikutnya",
                        previous: "Sebelumnya"
                    },
                    zeroRecords: "Data kosong.",
                }
            });
        });
    </script>

    @include('sweetalert::alert')
@endsection
