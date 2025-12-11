@extends('layout.user')
@section('title', 'Home')
@section('content')
    <br><br><br><br>
    <section class="py-5">
        <div class="container">
            <div class="header-title">

                <a href="" class="text-decoration-none text-dark me-2">
                    <i class="bx bx-arrow-back me-2 mb-5"></i> Order Now
                </a>

            </div>
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
                    <!-- PRODUCT CARD CONTAINER -->
                    <div id="cartProductsContainer"></div>
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
    <!-- SCRIPT CART -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const cartContainer = document.getElementById('cartProductsContainer');
            let cart = JSON.parse(localStorage.getItem('cart')) || [];

            // Fungsi format rupiah
            function formatRupiah(angka) {
                return "Rp " + angka.toLocaleString('id-ID');
            }

            // Fungsi update total dan badge
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
                const cartBadge = document.getElementById("cartCount");
                if (cartBadge) cartBadge.textContent = count;

                // Simpan kembali ke localStorage
                cart = [];
                document.querySelectorAll('.product-item').forEach(item => {
                    const id = item.id.replace('product-', '');
                    const name = item.querySelector('h6').textContent;
                    const price = parseInt(item.querySelector('.price').dataset.price);
                    const qty = parseInt(item.querySelector('.qty').textContent);
                    const image = item.querySelector('img').src;
                    cart.push({
                        id,
                        name,
                        price,
                        qty,
                        image
                    });
                });
                localStorage.setItem('cart', JSON.stringify(cart));
            }

            // Render semua produk dari cart
            function renderCart() {
                cartContainer.innerHTML = ''; // bersihkan container
                cart.forEach(product => {
                    const div = document.createElement('div');
                    div.className = 'card border-0 shadow-sm rounded-4 p-3 mb-3 product-item';
                    div.id = `product-${product.id}`;
                    div.innerHTML = `
                <div class="d-flex align-items-center">
                    <input type="checkbox" class="form-check-input product-check me-3" checked style="width:22px; height:22px; cursor:pointer;">
                    <img src="${product.image}" class="rounded" style="width:80px; height:80px; object-fit:contain;">
                    <div class="ms-3 flex-grow-1">
                        <h6 class="fw-bold text-primary mb-1">${product.name}</h6>
                        <h5 class="fw-bold text-danger price" data-price="${product.price}">${formatRupiah(product.price)}</h5>
                    </div>
                    <div class="d-flex align-items-center">
                        <button class="minus-btn" style="width:36px; height:36px; border-radius:50%; border:none; background:#0dcaf0; color:white; font-weight:bold; display:flex; justify-content:center; align-items:center; cursor:pointer;">-</button>
                        <span class="mx-2 fw-semibold qty">${product.qty}</span>
                        <button class="plus-btn" style="width:36px; height:36px; border-radius:50%; border:none; background:#0dcaf0; color:white; font-weight:bold; display:flex; justify-content:center; align-items:center; cursor:pointer;">+</button>
                        <button class="remove-btn ms-3" style="width:36px; height:36px; border-radius:50%; border:none; background:#dc3545; color:white; font-weight:bold; display:flex; justify-content:center; align-items:center; cursor:pointer;">x</button>
                    </div>
                </div>
            `;
                    cartContainer.appendChild(div);
                });
                updateTotal();
            }

            // Event delegation untuk checkbox, plus, minus, remove
            document.addEventListener('click', function(e) {
                const item = e.target.closest('.product-item');
                if (!item) return;

                const qtySpan = item.querySelector('.qty');

                if (e.target.matches('.plus-btn')) {
                    qtySpan.textContent = parseInt(qtySpan.textContent) + 1;
                } else if (e.target.matches('.minus-btn')) {
                    let qty = parseInt(qtySpan.textContent);
                    if (qty > 1) qtySpan.textContent = qty - 1;
                } else if (e.target.matches('.remove-btn')) {
                    item.remove(); // hapus elemen dari DOM
                }
                updateTotal();
            });

            // Event delegation untuk checkbox
            document.addEventListener('change', function(e) {
                if (e.target.matches('.product-check')) {
                    const allChecked = document.querySelectorAll('.product-check:checked').length ===
                        document.querySelectorAll('.product-check').length;
                    document.getElementById("selectAll").checked = allChecked;
                    updateTotal();
                }
            });

            // Select all checkbox
            document.getElementById("selectAll").addEventListener("change", function() {
                const checked = this.checked;
                document.querySelectorAll(".product-check").forEach(cb => cb.checked = checked);
                updateTotal();
            });

            // Render cart awal
            renderCart();
        });
    </script>



    @include('sweetalert::alert')
@endsection
