<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Route;

class Searchdropdown extends Component
{
    public $query = '';
    public $list_data = [];
    public $highlightIndex = 0;
    public $currentUrl;

    

    public function mount($data)

    {
        
        $this->reset();
        $this->list_data = $data;
        $page = explode('.', Route::currentRouteName())[0];
        $page = str_replace('-', ' ', $page);
        $page = ucwords($page);
        $page = str_replace(' ', '', $page); 
        if ($page == 'SetoranSampah') {
            $this->currentUrl = 'JenisSampah';
        } else if ($page == 'JadwalPengambilan') {
            $this->currentUrl = 'TipeSetoran';
        } else if ($page == 'Penjualan') {
            $this->currentUrl = 'TipeSetoran';
        }else{
            $this->currentUrl = $page;
        }
    }

    
    public function resetFields ()

    {

        $this->query = '';

        $this->list_data = [];

        $this->highlightIndex = 0;
        dd($this->query);
    }

    
    public function incrementHighlight()

    {

        if ($this->highlightIndex === count($this->list_data) - 1) {

            $this->highlightIndex = 0;

            return;

        }

        $this->highlightIndex++;

    }

    
    public function decrementHighlight()

    {

        if ($this->highlightIndex === 0) {

            $this->highlightIndex = count($this->list_data) - 1;

            return;

        }

        $this->highlightIndex--;

    }

    
    public function selectContact()

    {

        $data = $this->list_data[$this->highlightIndex] ?? null;

        if ($data) {

            $this->redirect(route('show-contact', $data['id']));

        }

    }

    
    public function updatedQuery()

    {   
        dd($this->query);
        $field = 'id';
        $modelClass = app("App\Models\\$this->currentUrl");
        if ($this->currentUrl == 'JenisSampah') {
            $field = 'id_jenis_sampah';
        }else if ($this->currentUrl == 'TipeSetoran') {
            $field = 'id_tipe_setoran';
        }
        dd($field);
        $this->list_data = $modelClass::where($field, 'like', '%' . $this->query . '%')

            ->get()

            ->toArray();

    }


    
    public function render()
    {
        return view('livewire.searchdropdown');
    }
}

