<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Widget as ProductWidget;
use App\Enum\WidgetEnum;
use Livewire\WithPagination;

class Widget extends Component
{
    use WithPagination;

    public $visibleModalForm = false;
    public $confirmDeleteModal = false;
    public $modelId;
    public $name;
    protected $rules = [
        'name' => 'required',
    ];

    public function mount()
    {
        $this->resetPage();
    }

    public function createOrUpdate()
    {
        $this->validate();
        ProductWidget::updateOrCreate(['id' => $this->modelId], $this->modelData());
        $this->visibleModalForm = false;
        $this->reset();
    }

    public function showUpdateModal($id)
    {
        $this->reset();
        $this->modelId = $id;
        $this->visibleModalForm = true;
        $data = ProductWidget::findOrFail($this->modelId);
        $this->name = $data->name;
    }

    public function showDeleteModal($id)
    {
        $this->modelId = $id;
        $this->confirmDeleteModal = true;
    }

    public function delete()
    {
        ProductWidget::destroy($this->modelId);
        $this->confirmDeleteModal = false;
    }

    public function modelData()
    {
        return [
            'name' => $this->name,
            'status' => WidgetEnum::ACTIVE
        ];
    }

    public function render()
    {
        return view('livewire.Widget', [
            'widgets' => ProductWidget::paginate(5)
        ]);
    }
}
