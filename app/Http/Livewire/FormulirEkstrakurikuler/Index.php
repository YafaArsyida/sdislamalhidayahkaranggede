<?php

namespace App\Http\Livewire\FormulirEkstrakurikuler;

use App\Models\Ekstrakurikuler;
use App\Models\Jenjang;
use App\Models\PenempatanEkstrakurikuler;
use App\Models\PenempatanSiswa;
use App\Models\Siswa;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    public $selectedJenjang, $ms_siswa_id, $ms_ekstrakurikuler_id;
    public $selectedEkstrakurikuler = null;
    public $siswaSelected = null;

    public $search = '';
    public $nama_siswa = null;
    public $nama_kelas = null;
    public $nama_jenjang = null;

    public function updatedSelectedJenjang()
    {
        $this->dispatchBrowserEvent('alertify-success', ['message' => 'Memperbarui...']);
    }

    public function mount()
    {
        // Tetapkan nilai pertama dari data yang tersedia jika ada
        $firstJenjang = Jenjang::whereIn('ms_jenjang_id', function ($query) {
            $query->select('ms_jenjang_id')
                ->from('ms_akses_jenjang')
                ->where('ms_pengguna_id', Auth::id());
        })->where('status', 'Aktif')->first();

        $this->selectedJenjang = $firstJenjang->ms_jenjang_id ?? null;
        $this->nama_jenjang = $firstJenjang->nama_jenjang ?? '';
    }

    public function siswaSelected($ms_penempatan_siswa_id)
    {
        $penempatan = PenempatanSiswa::with(['ms_siswa', 'ms_kelas'])->find($ms_penempatan_siswa_id);

        if ($penempatan) {
            $this->siswaSelected = $penempatan->ms_siswa->ms_siswa_id;
            $this->nama_siswa = $penempatan->ms_siswa->nama_siswa;
            $this->nama_kelas = $penempatan->ms_kelas->nama_kelas ?? '-';

            $this->search = ''; // Kosongkan input pencarian
        }
    }

    public function daftar()
    {
        if (empty($this->siswaSelected)) {
            $this->dispatchBrowserEvent('alertify-error', ['message' => 'Pilih Siswa.']);
            return;
        }

        if (empty($this->selectedJenjang)) {
            $this->dispatchBrowserEvent('alertify-error', ['message' => 'Pilih Jenjang']);
            return;
        }
        if (empty($this->selectedEkstrakurikuler)) {
            $this->dispatchBrowserEvent('alertify-error', ['message' => 'Pilih Ekstrakurikuler.']);
            return;
        }

        // Cek apakah siswa sudah terdaftar di ekstrakurikuler yang sama
        $exists = PenempatanEkstrakurikuler::where([
            'ms_ekstrakurikuler_id' => $this->selectedEkstrakurikuler,
            'ms_siswa_id' => $this->siswaSelected,
            'ms_jenjang_id' => $this->selectedJenjang,
        ])->exists();

        if ($exists) {
            $this->dispatchBrowserEvent('alertify-success', ['message' => 'Siswa sudah terdaftar dalam ekstrakurikuler ini.']);
            return;
        }

        // Ambil data ekstrakurikuler untuk cek kuota
        $ekstra = Ekstrakurikuler::find($this->selectedEkstrakurikuler);

        if ($ekstra) {
            $kuota = (int) $ekstra->kuota;
            $terisi = $ekstra->total_penempatan_siswa();
            $tersedia = max($kuota - $terisi, 0);

            if ($tersedia <= 0) {
                $this->dispatchBrowserEvent('alertify-error', ['message' => 'Kuota ekstrakurikuler sudah penuh.']);
                return;
            }
        }

        // Simpan ke database
        PenempatanEkstrakurikuler::create([
            'ms_ekstrakurikuler_id' => $this->selectedEkstrakurikuler,
            'ms_siswa_id' => $this->siswaSelected,
            'ms_jenjang_id' => $this->selectedJenjang,
        ]);

        // Reset input
        $this->siswaSelected = null;
        $this->selectedEkstrakurikuler = null;
        $this->nama_siswa = null;
        $this->nama_kelas = null;

        $this->dispatchBrowserEvent('alertify-success', ['message' => 'Pendaftaran berhasil disimpan.']);
    }
    public function render()
    {
        $select_ekstrakurikuler = Ekstrakurikuler::where('ms_jenjang_id', $this->selectedJenjang)
            ->get();

        $siswas = collect();

        if ($this->selectedJenjang && $this->search) {
            $siswas = PenempatanSiswa::with([
                'ms_siswa.ms_educard',
                'ms_kelas',
                'ms_siswa',
            ])
                ->where('ms_jenjang_id', $this->selectedJenjang)
                ->where(function ($query) {
                    $query->whereHas('ms_siswa', function ($q) {
                        $q->where('nama_siswa', 'like', '%' . $this->search . '%');
                    });
                })
                ->limit(10)
                ->get();
        }
        return view('livewire.formulir-ekstrakurikuler.index', [
            'select_jenjang' => Jenjang::where('status', 'Aktif')->get(),

            'select_ekstrakurikuler' => $select_ekstrakurikuler,
            'siswa' => $siswas
        ]);
    }
}
