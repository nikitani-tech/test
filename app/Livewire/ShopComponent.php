<?php

declare(strict_types=1);

namespace App\Livewire;

use App\Models\Product;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Livewire\Component;
use Livewire\WithPagination;

class ShopComponent extends Component
{
    use WithPagination;
    protected $updatesQueryString = ['sort_by', 'asc', 'page'];
    public string $sort_by = 'product_name';

    public string $asc = '1';

    public string $search_request = '';

    public function render(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $query = Product::with('media');

        if (!empty($this->search_request)) {
            $query->where(function ($q) {
                $q->where('product_name', 'like', '%' . $this->search_request . '%')
                    ->orWhere('sku', 'like', '%' . $this->search_request . '%');
            });
        }

        $products = $query
            ->orderBy($this->sort_by, $this->asc ? 'asc' : 'desc')
            ->paginate(15);

        return view('livewire.shop-component', ['products' => $products]);
    }
}
