@extends('layout.sidebar')
@section('content')

<div class="container mt-5 mb-5 pb-5" style="margin-left: 240px;"> {{-- offset dari sidebar --}}
    <h4 class="fw-bold text-center mb-4">Form Pembelian</h4>

    <form action="{{ route('petugas.pembelian.detail') }}" method="POST">
        @csrf

        {{-- Daftar Produk --}}
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4 g-4">
            @foreach ($produks as $produk)
            <div class="col">
                <div class="card h-100 p-2">
                    <label style="cursor: pointer;">
                        <input type="checkbox" name="produk[{{ $produk->id }}][pilih]" value="{{$produk->id}}" class="form-check-input me-2 produk-checkbox"
                               data-id="{{ $produk->id }}"
                               data-price="{{ $produk->price }}">
                        <img src="{{ asset('storage/produks/' . $produk->image) }}" class="card-img-top" alt="{{ $produk->title }}" style="height: 150px; object-fit: cover;">
                    </label>
                    <div class="card-body text-center">
                        <h5 class="card-title">{{ $produk->title }}</h5>
                        <p class="card-text mb-1">Stok: {{ $produk->stock }}</p>
                        <p class="card-text">Harga: Rp. {{ number_format($produk->price, 0, ',', '.') }}</p>
                        <div class="input-group mt-2 justify-content-center">
                            <button type="button" class="btn btn-outline-secondary btn-kurang" data-id="{{ $produk->id }}">−</button>
                            <input type="number" name="produk[{{ $produk->id }}][jumlah]" id="jumlah-{{ $produk->id }}" class="form-control text-center mx-1 jumlah-input" value="1" min="1" style="max-width: 60px;" disabled>
                            <button type="button" class="btn btn-outline-secondary btn-tambah" data-id="{{ $produk->id }}">+</button>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        {{-- Footer Subtotal dan Submit --}}
        <div class="fixed-bottom bg-white p-3 border-top shadow">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-6 text-start mb-2 mb-md-0">
                        <strong>Sub Total: Rp. <span id="subtotal">0</span></strong>
                    </div>
                    <div class="col-md-6 text-end">
                        <button type="submit" class="btn btn-primary w-100 rounded-pill">Beli Sekarang</button>
                    </div>
                </div>
            </div>
        </div>
        <input type="hidden" name="total_payment" id="total_payment_input" value="0">

    </form>
</div>

{{-- JavaScript --}}
<script>
    function updateSubtotal() {
        let subtotal = 0;
        document.querySelectorAll('.produk-checkbox').forEach(cb => {
            const id = cb.dataset.id;
            const price = parseInt(cb.dataset.price);
            const jumlahInput = document.getElementById('jumlah-' + id);
            const jumlah = parseInt(jumlahInput.value || 0);

            if (cb.checked) {
                subtotal += price * jumlah;
            }
        });
        document.getElementById('subtotal').innerText = subtotal.toLocaleString();
    }

    // Toggle checkbox aktifkan jumlah
    document.querySelectorAll('.produk-checkbox').forEach(cb => {
        cb.addEventListener('change', () => {
            const id = cb.dataset.id;
            const jumlahInput = document.getElementById('jumlah-' + id);
            jumlahInput.disabled = !cb.checked;
            updateSubtotal();
        });
    });

    // Tombol tambah
    document.querySelectorAll('.btn-tambah').forEach(btn => {
        btn.addEventListener('click', () => {
            const id = btn.dataset.id;
            const input = document.getElementById('jumlah-' + id);
            let val = parseInt(input.value || 1);
            input.value = val + 1;
            updateSubtotal();
        });
    });

    // Tombol kurang
    document.querySelectorAll('.btn-kurang').forEach(btn => {
        btn.addEventListener('click', () => {
            const id = btn.dataset.id;
            const input = document.getElementById('jumlah-' + id);
            let val = parseInt(input.value || 1);
            if (val > 1) {
                input.value = val - 1;
                updateSubtotal();
            }
        });
    });

    // Update saat input jumlah diketik manual
    document.querySelectorAll('.jumlah-input').forEach(input => {
        input.addEventListener('input', () => {
            updateSubtotal();
        });
    });
</script>

@endsection
