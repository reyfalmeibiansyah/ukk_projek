@extends('layout.sidebar')

@section('content')
<div class="container py-4" style="margin-left: 130px;">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-3">
            <li class="breadcrumb-item">Pembayaran</li>
        </ol>
    </nav>

    <h2 class="fw-bold mb-4">Pembayaran</h2>

    <div class="bg-white shadow-sm rounded-4 p-4">
        <div class="d-flex justify-content-between mb-4">
            <div>
                <a href="#" class="btn btn-primary">Unduh</a>
                <a href="#" class="btn btn-secondary">Kembali</a>
            </div>
            <div class="text-end">
                <small>Invoice – #</small><br>
                <small>tanggal</small>
            </div>
        </div>

        <table class="table table-borderless">
            <thead class="border-bottom">
                <tr>
                    <th>Produk</th>
                    <th>Harga</th>
                    <th>Quantity</th>
                    <th class="text-end">Sub Total</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>title</td>
                    <td>Rp. harga</td>
                    <td>pembelian</td>
                    <td class="text-end">Rp.harga total</td>
                </tr>
            </tbody>
        </table>

        <div class="row bg-light rounded-3 p-3 mt-4">
            <div class="col-md-4">
                <div class="fw-semibold small text-muted">POIN DIGUNAKAN</div>
                <div class="fw-bold">point</div>
            </div>
            <div class="col-md-4">
                <div class="fw-semibold small text-muted">KASIR</div>
                <div class="fw-bold">dibuat oleh</div>
            </div>
            <div class="col-md-4 text-end">
                <div class="fw-semibold small text-muted">KEMBALIAN</div>
                <div class="fw-bold">Rp.kembalian</div>
            </div>
        </div>

        <div class="d-flex justify-content-end mt-4">
            <div class="bg-dark text-white rounded-4 p-4 text-end" style="min-width: 200px;">
                <div class="fw-semibold small">TOTAL</div>
                <h4 class="fw-bold">Rp. total harga</h4>
            </div>
        </div>
    </div>
</div>
@endsection
