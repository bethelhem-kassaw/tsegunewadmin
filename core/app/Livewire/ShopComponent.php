<?php

namespace App\Livewire;

use App\Helper\ProductFilters;
use Livewire\Component;
use App\Models\Product;
use App\Models\SubCategory;
use App\Models\Wishlist;
use Livewire\WithPagination;

class ShopComponent extends Component
{
    protected $products;
    protected $paginationTheme = 'bootstrap';
    public $subCategorys;
    public $filters = ['main_category_id' => null, 'sub_category_id' => null, 'price' => null, 'name' => null];
    public $viewType = 'list';
    public $price_filter = ['priceMin' => '300', 'priceMax' => '3000'];

    use WithPagination;
    public function mount($main = null, $id = null)
    {
        if ($main == 'search') {
            $this->filters['name'] = $id;
            $this->subCategorys = SubCategory::all();
        } else if ($id != null && $main == null) {
            $this->subCategorys = SubCategory::where('main_category_id', $id)->get();
            $this->filters['main_category_id'] = $id;
        } else if ($id != null && $main != null) {
            $this->subCategorys = SubCategory::where('main_category_id', $id)->get();
            $this->filters['sub_category_id'] = $id;
        } else {
            $this->subCategorys = SubCategory::all();
        }
    }
    public function wishlit($product_id)
    {
        if (!auth()->check()) {
            return redirect('login');
        }
        Wishlist::create(['user_id' => auth()->user()->id, 'product_id' => $product_id]);
    }
    public function toggleView($type = 'list')
    {
        $this->viewType = $type;
        $this->render();
    }
    public function mainCategory($id)
    {
        $this->filters['main_category_id'] = $id;
        $this->filters['sub_category_id'] = null;
    }
    public function subcategory($id)
    {
        $this->filters['sub_category_id'] = $id;
    }
    public function priceFilter()
    {
        // dd($this->price_filter);
        $this->filters['price'] = $this->price_filter;
    }
    public $isModalOpen = false;

    public function openModal()
    {
        $this->isModalOpen = true;
    }

    public function closeModal()
    {
        $this->isModalOpen = false;
    }
    public function applyFilters()
    {
        // Update filters, then close the modal
        $this->filters['price'] = $this->price_filter;
        $this->filters['sub_category_id'] = $this->filters['sub_category_id'];
        $this->closeModal(); // Close modal only after filters are applied
    }
    public function render(ProductFilters $filtersClass)
    {
        $filtersClass->userInputs = $this->filters;
        $products = Product::filter($filtersClass)->paginate(12);
        $subCategorys = $this->subCategorys;
        $this->products = $products;
        return view('livewire.shop-component', compact(['products', 'subCategorys']))
            ->layout('layouts.customer.app');
    }
}
