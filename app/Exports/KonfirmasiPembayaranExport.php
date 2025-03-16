<?php

namespace App\Exports;

use App\Models\Table\Pembayaran;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class KonfirmasiPembayaranExport implements FromCollection, WithHeadings, WithStyles, WithColumnFormatting
{
    // Constructor untuk menerima parameter
    public function __construct($date)
    {
        if ($date) {
            $dates = explode(' to ', $date);
            $this->startDate = $dates[0];
            $this->endDate = $dates[1];
        } else {
            $this->startDate = null;
            $this->endDate = null;
        }
    }

    /**
     * Membuat koleksi data untuk diekspor.
     *
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $query = Pembayaran::select(
            'pembayaran.id',
            'pembayaran.created_at',
            'users.name as user_name',
            'users.tipe_user as user_tipe_user',
            'users.institusi_asal as user_institusi_asal',
            'pembayaran.jumlah',
            'pembayaran.note',
            'pembayaran.tgl_bayar',
            'pembayaran.status'
        )
            ->join('users', 'pembayaran.id_user', '=', 'users.id');

        // Jika ada filter tanggal, tambahkan kondisi
        if ($this->startDate !== null && $this->endDate !== null) {
            $query->whereBetween('pembayaran.created_at', [$this->startDate, $this->endDate]);
        }

        $data = $query->get();

        // Tambahkan nomor urut
        return $data->map(function ($item, $index) {
            return [
                'no' => $index + 1,  // Kolom No
                'inv_no' => $item->id,
                'inv_date' => $item->created_at,
                'name' => $item->user_name,
                'tipe_user' => $item->user_tipe_user,
                'institusi_asal' => $item->user_institusi_asal,
                'jumlah' => $item->jumlah,
                'note' => $item->note,
                'tgl_bayar' => $item->tgl_bayar,
                'status' => $item->status == 1 ? 'Pending' : ($item->status == 2 ? 'Dibayar' : ($item->status == 3 ? 'Berhasil Dibayar' : 'Status Tidak Dikenal'))
            ];
        });
    }

    /**
     * Menentukan heading atau header kolom pada file Excel.
     *
     * @return array
     */
    public function headings(): array
    {
        return [
            'No',
            'Inv No',
            'Inv Date',
            'Name',
            'Tipe User',
            'Institusi Asal',
            'Jumlah',
            'Note',
            'Tgl Bayar',
            'Status',
        ];
    }

    /**
     * Menambahkan styling pada kolom di Excel.
     *
     * @return array
     */
    public function styles($sheet)
    {
        // Styling header
        $sheet->getStyle('A1:J1')->getFont()->setBold(true);
        $sheet->getStyle('A1:J1')->getFont()->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_WHITE);
        $sheet->getStyle('A1:J1')->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB('4CAF50'); // Green header

        // Menambahkan border pada setiap cell
        $sheet->getStyle('A1:J' . $sheet->getHighestRow())
            ->getBorders()
            ->getAllBorders()
            ->setBorderStyle(Border::BORDER_THIN);

        // Menambahkan alignment pada kolom
        $sheet->getStyle('A1:J' . $sheet->getHighestRow())
            ->getAlignment()
            ->setHorizontal(Alignment::HORIZONTAL_CENTER)
            ->setVertical(Alignment::VERTICAL_CENTER);

        // Mengatur lebar kolom otomatis
        foreach (range('A', 'J') as $column) {
            $sheet->getColumnDimension($column)->setAutoSize(true);
        }

        return [];
    }

    /**
     * Menambahkan format pada kolom tertentu (misalnya format angka atau tanggal)
     *
     * @return array
     */
    public function columnFormats(): array
    {
        return [
            'A' => NumberFormat::FORMAT_NUMBER,
            // Anda dapat menambahkan format lain untuk kolom tertentu
        ];
    }
}
