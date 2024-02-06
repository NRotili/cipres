<?php

namespace App\Http\Livewire\Panel;

use App\Models\Catalogue;
use Livewire\Component;
use Livewire\WithPagination;

class CataloguesIndex extends Component
{

    use WithPagination;
    protected $paginationTheme= "bootstrap";

    public $search;

    public function updatingSearch()
    {
        $this->resetPage();
    }
    
    public function render()
    {

        $catalogues = Catalogue::where('nombre','LIKE','%' . $this->search . '%')
                ->latest('id')
                ->paginate();

        return view('livewire.panel.catalogues-index', compact('catalogues'));
    }
}
