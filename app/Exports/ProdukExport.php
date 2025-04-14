<?php

namespace App\Exports;

use App\Models\Produk;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class ProdukExport implements FromCollection, WithHeadings, WithColumnFormatting
{
    /**
     * Mengambil data produk untuk diekspor.
     *
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Produk::all()->map(function ($produk) {
            return [
                'id' => $produk->id,
                'title' => $produk->title,
                'description' => $produk->description,
                'price' => $produk->price,
                'stock' => $produk->stock,
                'image' => $produk->image, // Menambahkan gambar (nama file)
            ];
        });
    }

    /**
     * Menentukan header kolom Excel.
     *
     * @return array
     */
    public function headings(): array
    {
        return [
            'ID',
            'Nama Produk',
            'Deskripsi',
            'Harga',
            'Stok',
            'Gambar',
        ];
    }

    /**
     * Menentukan format kolom (misalnya untuk harga).
     *
     * @return array
     */
    public function columnFormats(): array
    {
        return [
            'D' => NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1, // Format harga
        ];
    }
}
