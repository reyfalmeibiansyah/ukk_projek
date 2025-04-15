@extends('layout.sidebar')

@section('content')
<div class="container py-4" style="margin-left: 130px;">
    <h3 class="fw-bold mb-4">Penjualan</h3>

    <div class="mx-auto" style="max-width: 900px;">
        <div class="bg-white rounded-4 shadow-sm p-4">
            <div class="row align-items-stretch">
                {{-- Kiri: Ringkasan Produk --}}
                <div class="col-md-6 mb-4 mb-md-0 d-flex flex-column justify-content-between"
                     style="background-color: #f8f9fa; border: 1px solid #ddd; border-radius: 10px;">
                    <div>
                        <h5 class="fw-bold mb-3">Ringkasan Produk</h5>
                        @foreach ($selectedProducts as $product)
                            <div class="d-flex justify-content-between border-bottom py-2">
                                <div>
                                    <p class="mb-0 fw-semibold">{{ $product['nama_produk'] }}</p>
                                    <small class="text-muted">Rp. {{ number_format($product['harga_produk']) }} x {{ $product['qty'] }}</small>
                                </div>
                                <p class="fw-semibold mb-0">Rp. {{ number_format($product['sub_total']) }}</p>
                            </div>
                        @endforeach

                        <div class="d-flex justify-content-between mt-3">
                            <h6 class="fw-semibold">Total</h6>
                            <h5 class="fw-bold">Rp. {{ number_format($total_payment) }}</h5>
                        </div>
                    </div>
                </div>

                {{-- Kanan: Form Member --}}
                <div class="col-md-6">
                    <form action="{{ route('petugas.pembelian.storeStep2') }}" method="POST">
                        @csrf
                        <input type="hidden" name="total_payment" id="total_payment_input" value="{{ $total_payment }}">
                        <input type="hidden" name="customer_phone" value="{{ request('customer_phone') }}">
                        <input type="hidden" name="potongan_poin" id="potongan_poin" value="0">

                        <h5 class="fw-bold mb-3">Data Member</h5>

                        <div class="mb-3">
                            <label class="form-label">Nama Member</label>
                            <input type="text" name="nama_member" class="form-control" placeholder="Masukkan nama member" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Poin</label>
                            <input type="text" name="points" value="{{ $point ?? 0 }}" class="form-control bg-light" readonly>
                        </div>

                        @if ($member)
                            @if ($member->points > 0)
                                <div class="mb-3">
                                    <p class="mb-1"><strong>Poin Saat Ini:</strong> {{ $member->points }}</p>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="point_used" id="point_used" value="1">
                                        <label class="form-check-label" for="point_used">
                                            Gunakan poin untuk potongan harga
                                        </label>
                                    </div>
                                </div>
                            @else
                                <p class="text-muted small">Belum memiliki poin.</p>
                            @endif
                        @else
                            <p class="text-danger small">Member baru — poin dimulai dari 0.</p>
                        @endif

                        <button type="submit" class="btn btn-primary w-100">Selanjutnya</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function () {
    const checkbox = document.getElementById('point_used');
    const totalBayarDisplay = document.getElementById('total_bayar_display');
    const totalPaymentInput = document.getElementById('total_payment_input');
    const potonganInput = document.getElementById('potongan_poin');
    const poinMember = {{ $member->points ?? 0 }};
    const totalPayment = {{ $total_payment }};

    checkbox?.addEventListener('change', function () {
        let potongan = poinMember;
        let totalSetelahPotongan = totalPayment - potongan;

        if (totalSetelahPotongan < 0) {
            potongan = totalPayment;
            totalSetelahPotongan = 0;
        }

        if (this.checked) {
            totalBayarDisplay.textContent = new Intl.NumberFormat('id-ID').format(totalSetelahPotongan);
            potonganInput.value = potongan;
            totalPaymentInput.value = totalSetelahPotongan;
        } else {
            totalBayarDisplay.textContent = new Intl.NumberFormat('id-ID').format(totalPayment);
            potonganInput.value = 0;
            totalPaymentInput.value = totalPayment;
        }
    });
});
</script>
@endsection
