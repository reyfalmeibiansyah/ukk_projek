<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: sans-serif; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { padding: 8px; border: 1px solid #ccc; text-align: left; }
        th { background-color: #f2f2f2; }
        .text-end { text-align: right; }
        .mt-3 { margin-top: 1rem; }
        .mt-5 { margin-top: 2rem; }
    </style>
</head>
<body>
    <h3>Indo April</h3>
    <p>Member Status:</p>
    <p>No. HP:</p>
    <p>Bergabung Sejak: </p>
    <p>Poin Member:</p>

    <table>
        <thead>
            <tr>
                <th>Nama Produk</th>
                <th>QTY</th>
                <th>Harga</th>
                <th>Sub Total</th>
            </tr>
        </thead>
        <tbody>
            {{-- @foreach ($penjualan->detailPenjualan as $detail) --}}
                <tr>
                    <td>nama produk</td>
                    <td>>qty</td>
                    <td>Rp.harga</td>
                    <td>Rp.harga banyak</td>
                </tr>
            {{-- @endforeach --}}
        </tbody>
    </table>

    <table class="mt-3">
        <tr>
            <td>Poin Digunakan</td>
            <td>:</td>
            <td>point digunakan</td>
            <td class="text-end"><strong>Total Harga</strong></td>
            <td class="text-end">Rp. harga</td>
        </tr>
        <tr>
            <td colspan="3"></td>
            <td class="text-end"><strong>Harga Setelah Poin</strong></td>
            <td class="text-end">Rp.harga</td>
        </tr>
        <tr>
            <td colspan="3"></td>
            <td class="text-end"><strong>Total Kembalian</strong></td>
            <td class="text-end">Rp.kembalian</td>
        </tr>
    </table>

    <p class="mt-5">dibuat | oleh</p>
    <p><strong>Terima kasih atas pembelian Anda!</strong></p>
</body>
</html>
