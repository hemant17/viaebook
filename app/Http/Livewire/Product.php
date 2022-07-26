<?php
namespace App\Http\Livewire;

use App\Jobs\ProcessProductApi;
use App\Models\Product as ModelsProduct;
use App\Models\Widget;
use Livewire\Component;
use Livewire\WithPagination;
class Product extends Component
{
    use WithPagination;
    public $visibleModalForm = false;
    public $confirmDeleteModal = false;
    public $data = [];
    public $widget_id;
    public $widgets;
    public $modelId;
    
    protected $rules = [
        'data.name' => 'required',
        'data.widget_id' => 'required'
    ];

    protected $messages = [
        'data.name.required' => 'The Name cannot be empty.',
        'data.widget_id.required' => 'The Widget is Required.',
    ];

    public function mount()
    {
        $this->resetPage();
    }

    public function createOrUpdate()
    {
        $data = $this->validate();
        $product = ModelsProduct::updateOrCreate(['id' => $this->modelId], $data['data'] );
        ProcessProductApi::dispatch($product);
        $this->visibleModalForm = false;
        $this->reset();
    }

    public function delete()
    {
        ModelsProduct::destroy($this->modelId);
        $this->confirmDeleteModal = false;
    }

    public function showUpdateModal($id)
    {
        $this->resetValidation();
        $this->reset();
        $this->modelId = $id;
        $this->widgets = Widget::all();
        $this->visibleModalForm = true;
        $this->loadModel();
    }
    public function showDeleteModal($id)
    {
        $this->modelId = $id;
        $this->confirmDeleteModal = true;
    }
    public function loadModel()
    {
        $this->data = ModelsProduct::findOrFail($this->modelId);
    }
 
    public function showModal()
    {
        $this->resetValidation();
        $this->reset();
        $this->widgets = Widget::all();
        $this->visibleModalForm = true;
    }
    public function render()
    {
        return view('livewire.product', [
            'products' => ModelsProduct::with('Widget')->orderBy('created_at', 'desc')->paginate(5),
        ]);
    }
}