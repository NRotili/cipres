<?php

namespace App\Livewire\Panel\Whatsapp\Configuraciones;

use App\Models\Configuracione;
use Barryvdh\Debugbar\Facades\Debugbar;
use Barryvdh\Debugbar\Twig\Extension\Debug;
use Livewire\Component;
use Livewire\WithPagination;

class ConfiguracionesIndex extends Component
{
    use WithPagination;
    protected $paginationTheme= "bootstrap";

    public $nombre, $valor;
    public $configuracionModal;
    public $isNew = true;

    public function render()
    {
        $config = Configuracione::orderBy('nombre', 'asc')->paginate(10);
        return view('livewire.panel.whatsapp.configuraciones.configuraciones-index', compact('config'));
    }


    //editarDato
    public function editarDato(Configuracione $configuracione)
    {
        Debugbar::info('EditarDatos');
        $this->isNew = false;
        $this->configuracionModal = $configuracione;
        $this->nombre = $configuracione->nombre;
        $this->valor = $configuracione->valor;
    }

    //limpiar
    public function limpiar()
    {
        $this->nombre = '';
        $this->valor = '';
        $this->isNew = false;
    }

    //guardarConfig
    public function guardarConfig()
    {
        Debugbar::info('GuardarConfig');
        Debugbar::info($this->isNew);
        $this->validate([
            'nombre' => 'required',
            'valor' => 'required'
        ]);

        Debugbar::info('Validado');

        if ($this->isNew) {
            Debugbar::info('Se ha creado un nuevo registro');
            Configuracione::create([
                'nombre' => $this->nombre,
                'valor' => $this->valor
            ]);

        } else {
            $this->configuracionModal->update([
                'nombre' => $this->nombre,
                'valor' => $this->valor
            ]);
        }

        $this->limpiar();
        $this->render();
    }
}
