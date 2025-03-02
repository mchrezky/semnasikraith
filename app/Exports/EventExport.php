<?php

namespace App\Exports;

use App\Models\Table\Event;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class EventExport implements FromCollection, WithHeadings, WithStyles, WithColumnFormatting
{
    // Constructor untuk menerima parameter
    public function __construct($date, $semnasId)
    {
        if ($date) {
            $dates = explode(' to ', $date);
            $this->startDate = $dates[0];
            $this->endDate = $dates[1];
        } else {
            $this->startDate = null;
            $this->endDate = null;
        }

        $this->semnasId = $semnasId;
    }

    /**
     * Membuat koleksi data untuk diekspor.
     *
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $query = Event::select(
            'event.id',
            'event.writer1 as event_writter1',
            'users.tipe_user as user_tipe_user',
            'users.no_telp as user_no_telp',
            'event.email1 as event_email1',
            'users.institusi_asal as user_institusi_asal',
            'users.alamat as user_alamat',
            'event.title as event_title',
            'event.konfirmasi_bayar as event_konfirmasi_bayar',
            'event.review as event_review',
            'categories.name as categories_name',
        )
            ->join('users', 'event.id_user', '=', 'users.id')
            ->join('categories', 'event.category', '=', 'categories.id')
            ->join('event_list', 'event.event_list', '=', 'event_list.id')
            ->join('ms_semnas', 'event_list.semnas_id', '=', 'ms_semnas.id');

        // Jika startDate dan endDate ada, filter data menggunakan whereBetween
        if ($this->startDate !== null && $this->endDate !== null) {
            $query->whereBetween('event.created_at', [$this->startDate, $this->endDate]);
        }

        // Filter berdasarkan semnas_id jika ada
        if ($this->semnasId !== null) {
            $query->where('ms_semnas.id', '=', $this->semnasId);
        }

        $data = $query->get();

        $data->transform(function ($item, $key) {
            $item->id = $key + 1;

            $item->event_konfirmasi_bayar = $item->event_konfirmasi_bayar == 1
                ? 'Pending'
                : ($item->event_konfirmasi_bayar == 2
                    ? 'Dibayar'
                    : ($item->event_konfirmasi_bayar == 3
                        ? 'Berhasil Dikonfirmasi'
                        : 'Status Tidak Dikenal'));

            return $item;
        });

        return $data;
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
            'Nama',
            'Tipe User',
            'No Telp',
            'Email',
            'Institusi',
            'Alamat',
            'Judul',
            'Status Pembayaran',
            'Status Review',
            'Jenis Paper',
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
        $sheet->getStyle('A1:K1')->getFont()->setBold(true);
        $sheet->getStyle('A1:K1')->getFont()->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_WHITE);
        $sheet->getStyle('A1:K1')->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB('4CAF50'); // Green header

        // Menambahkan border pada setiap cell
        $sheet->getStyle('A1:K' . $sheet->getHighestRow())
            ->getBorders()
            ->getAllBorders()
            ->setBorderStyle(Border::BORDER_THIN);

        // Menambahkan alignment pada kolom
        $sheet->getStyle('A1:K' . $sheet->getHighestRow())
            ->getAlignment()
            ->setHorizontal(Alignment::HORIZONTAL_CENTER)
            ->setVertical(Alignment::VERTICAL_CENTER);

        // Mengatur lebar kolom otomatis
        foreach (range('A', 'K') as $column) {
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
