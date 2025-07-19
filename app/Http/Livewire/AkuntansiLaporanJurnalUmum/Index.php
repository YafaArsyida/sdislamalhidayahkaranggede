<?php

namespace App\Http\Livewire\AkuntansiLaporanJurnalUmum;

use App\Models\AkuntansiJurnalDetail;
use App\Models\TahunAjar;
use Livewire\Component;

class Index extends Component
{
    public $selectedJenjang = null;
    public $selectedTahunAjar = null;
    public $selectedBulan = null;
    public $startDate = null;
    public $endDate = null;

    public $search = '';

    protected $listeners = [
        'parameterUpdated' => 'updateParameters',
    ];

    public function updatingSearch()
    {
        $this->emitSelf('$refresh'); //ringan
    }

    public function updateParameters($jenjang, $tahunAjar)
    {
        // Update nilai selectedJenjang dan selectedTahunAjar
        $this->selectedJenjang = $jenjang;
        $this->selectedTahunAjar = $tahunAjar;
    }

    public function updateBulan($bulan)
    {
        $this->selectedBulan = $bulan;
    }

    public function render()
    {
        // $select_bulan = [];
        // if ($this->selectedTahunAjar) {
        //     $tahunAjar = TahunAjar::find($this->selectedTahunAjar);
        //     $tanggal_mulai = $tahunAjar->tanggal_mulai;
        //     $tanggal_akhir = $tahunAjar->tanggal_selesai;

        //     $start = new \DateTime($tanggal_mulai);
        //     $end = new \DateTime($tanggal_akhir);
        //     $end->modify('last day of this month'); // Modifikasi akhir bulan

        //     $select_bulan = [];
        //     while ($start <= $end) {
        //         $bulanIndonesia = \App\Http\Controllers\HelperController::formatTanggalIndonesia(
        //             $start->format('Y-m-d'),
        //             'F Y' // Format hanya bulan dan tahun
        //         );
        //         $select_bulan[] = [
        //             'value' => $start->format('m'), // Bulan dalam format angka (01, 02, ...)
        //             'name' => $bulanIndonesia,  // Nama bulan dan tahun dalam bahasa Indonesia
        //         ];
        //         $start->modify('+1 month'); // Pindah ke bulan berikutnya
        //     }
        // }

        $transaksiJurnal = AkuntansiJurnalDetail::with('akuntansi_rekening', 'ms_pengguna')
            ->where('ms_tahun_ajaran_id', $this->selectedTahunAjar)
            ->where('ms_jenjang_id', $this->selectedJenjang)
            // ->when($this->selectedBulan, function ($query) {
            //     $query->whereMonth('tanggal_transaksi', $this->selectedBulan);
            // })
            ->when($this->startDate && $this->endDate, function ($query) {
                $query->whereBetween('tanggal_transaksi', [$this->startDate, $this->endDate]);
            })
            ->when($this->search, function ($query) {
                $query->where('deskripsi', 'like', '%' . $this->search . '%');
            })
            ->orderBy('tanggal_transaksi')
            ->get()
            ->groupBy(['deskripsi', 'nominal']);

        $this->dispatchBrowserEvent('alertify-success', ['message' => 'Memperbarui...']);

        return view('livewire.akuntansi-laporan-jurnal-umum.index', [
            // 'select_bulan' => $select_bulan,
            'transaksiJurnal' => $transaksiJurnal,
        ]);
    }
}
