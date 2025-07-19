<?php

namespace App\Http\Livewire\TahunAjar;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\TahunAjar as TahunAjarModel;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap'; // Gunakan tema Bootstrap

    public $search = '';
    public $selectedStatus = null;

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingSelectedStatus()
    {
        $this->resetPage();
    }

    protected $listeners = ['refreshTahunAjars' => '$refresh']; // Gunakan Livewire refresh untuk memuat ulang data

    public function toggleStatus($tahunId, $status)
    {
        $tahun_ajar = TahunAjarModel::find($tahunId);

        if ($tahun_ajar) {
            $tahun_ajar->status = $status ? 'Aktif' : 'Tidak Aktif';
            $tahun_ajar->save();

            $this->dispatchBrowserEvent('alertify-success', ['message' => 'Status berhasil diubah!']);
            $this->emit('refreshTahunAjars');
        } else {
            $this->dispatchBrowserEvent('alertify-error', ['message' => 'Gagal mengubah status. Data tidak ditemukan.']);
        }
    }

    public function render()
    {
        $query = TahunAjarModel::query();

        if ($this->selectedStatus) {
            $query->where('status', $this->selectedStatus);
        }

        $tahunajars = $query->where(function ($query) {
            $query->where('nama_tahun_ajar', 'like', '%' . $this->search . '%')
                ->orWhere('deskripsi', 'like', '%' . $this->search . '%');
        })
            ->orderBy('urutan', 'ASC')
            ->paginate(5);
        return view('livewire.tahun-ajar.index', [
            'tahunajars' => $tahunajars,
        ]);
    }
}
