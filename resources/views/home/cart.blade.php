@extends('layout.user')
@section('title', 'Home')
@section('content')
    <br><br><br><br>
    <section class="py-5">
        <div class="container">

            <div class="row g-4">

                <!-- LEFT SIDE -->
                <div class="col-lg-8">

                    <!-- Select All Section -->
                    <div class="p-3 rounded-3 d-flex align-items-center mb-4" style="background:#2e425c; color:white;">
                        <input type="checkbox" id="selectAll" class="form-check-input me-3"
                            style="width:25px; height:25px; cursor:pointer;">
                        <label for="selectAll" class="fw-semibold" style="cursor:pointer;">
                            Select All Products
                        </label>
                    </div>

                    <!-- PRODUCT CARD -->
                    <div class="card border-0 shadow-sm rounded-4 p-3 mb-3 product-item">

                        <div class="d-flex align-items-center">

                            <!-- CHECKBOX -->
                            <input type="checkbox" class="form-check-input product-check me-3"
                                style="width:22px; height:22px; cursor:pointer;">

                            <!-- IMAGE -->
                            <img src="https://via.placeholder.com/120" class="rounded"
                                style="width:80px; height:80px; object-fit:contain;">

                            <!-- PRODUCT INFO -->
                            <div class="ms-3 flex-grow-1">
                                <h6 class="fw-bold text-primary mb-1">ASUS Zenbook A14 (UX3407)</h6>
                                <p class="mb-2" style="font-size:14px; color:#666;">
                                    Lorem ipsum dolor sit amet consectetur. Nunc congue varius nisl nulla fames.
                                </p>

                                <h5 class="fw-bold text-danger price" data-price="14999000">
                                    Rp 14.999.000
                                </h5>
                            </div>

                            <!-- QTY CONTROL -->
                            <div class="d-flex align-items-center">
                                <button class="btn btn-outline-info rounded-circle minus-btn">-</button>
                                <span class="mx-3 fw-semibold qty">1</span>
                                <button class="btn btn-outline-info rounded-circle plus-btn">+</button>
                            </div>
                        </div>

                    </div>

                </div>

                <!-- RIGHT SIDE -->
                <div class="col-lg-4">
                    <div class="card rounded-4 shadow-sm border-0 p-4">

                        <h5 class="fw-bold mb-4" style="color:#2e425c;">Shopping Summary</h5>

                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-muted fw-semibold">Total</span>
                            <span class="fw-bold text-danger fs-5" id="totalPrice">Rp 0</span>
                        </div>

                        <hr>

                        <button id="buyBtn" class="btn w-100 text-white fw-bold mt-3 py-3 rounded-pill"
                            style="background: linear-gradient(90deg,#09c6f9,#05a0f7,#04d4c3);">
                            BUY (0)
                        </button>
                    </div>
                </div>

            </div>

        </div>
    </section>


    <!-- ========== SCRIPT ========== -->
    <script>
        function formatRupiah(angka) {
            return "Rp " + angka.toLocaleString("id-ID");
        }

        function updateTotal() {
            let total = 0;
            let count = 0;

            document.querySelectorAll('.product-item').forEach(item => {
                const checked = item.querySelector('.product-check').checked;
                const qty = parseInt(item.querySelector('.qty').textContent);
                const price = parseInt(item.querySelector('.price').dataset.price);

                if (checked) {
                    total += price * qty;
                    count += qty;
                }
            });

            document.getElementById("totalPrice").textContent = formatRupiah(total);
            document.getElementById("buyBtn").textContent = `BUY (${count})`;
        }

        // Checkbox: Select All
        document.getElementById("selectAll").addEventListener("change", function() {
            const checked = this.checked;
            document.querySelectorAll(".product-check").forEach(cb => cb.checked = checked);
            updateTotal();
        });

        // Checkbox: per-product
        document.querySelectorAll(".product-check").forEach(cb => {
            cb.addEventListener("change", () => {
                const allChecked =
                    document.querySelectorAll(".product-check:checked").length ===
                    document.querySelectorAll(".product-check").length;

                document.getElementById("selectAll").checked = allChecked;
                updateTotal();
            });
        });

        // Quantity +/- buttons
        document.querySelectorAll(".product-item").forEach(item => {
            const qtySpan = item.querySelector(".qty");

            item.querySelector(".plus-btn").addEventListener("click", () => {
                qtySpan.textContent = parseInt(qtySpan.textContent) + 1;
                updateTotal();
            });

            item.querySelector(".minus-btn").addEventListener("click", () => {
                let qty = parseInt(qtySpan.textContent);
                if (qty > 1) qtySpan.textContent = qty - 1;
                updateTotal();
            });
        });
    </script>


    @include('sweetalert::alert')
@endsection
