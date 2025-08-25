@extends('dashboard')
@section('content')
    <div class="container-fluid py-5 mt-5">
        <h3 class="fw-semibold m-3">Inventory</h3>
        <div class="row">
            <div class="col-sm-4">
                <input type="search" name="search_inventory" class="form-control form-control-sm rounded-4"
                    placeholder="search..." id="">
            </div>
            <div class="col-sm-4">
                <button class="btn btn-transparent border border-secondary float-right btn-sm fw-semibold lead text-sm"><i
                        class="fas fa-upload"></i> Export</button>
            </div>
            <div class="col-sm-4">
                <button data-bs-target='#new-inventory-item' data-bs-toggle='modal' style="background: #20536B;"
                    class="text-white btn border border-secondary float-left btn-sm fw-semibold lead text-sm"><i
                        class="fas fa-plus"></i> Add Item</button>
            </div>
            <div class="container-fluid rounded-5 bg-light mt-5">
                <div class="row p-2 rounded-5">
                    <div class="col-sm-3">
                        <span class="lead text-muted text-md">Product Name</span>
                    </div>
                    <div class="col-sm-3">
                        <span class="lead text-muted text-md">Category</span>
                    </div>
                    <div class="col-sm-3">
                        <span class="lead text-muted text-md">On Hand</span>
                    </div>
                    <div class="col-sm-3">
                        <span class="lead text-muted text-md">Status</span>
                    </div>
                </div>
            </div>
            <div class="container-fluid mt-2 rounded-4 bg-light">
                <div class="row p-2 rounded-5">
                    @foreach ($inventory as $items)
                        @php
                            $maxStock = $items->max_stock ?? 100; // fallback if no max_stock column
                            $lowStockThreshold = $maxStock * 0.15;
                            $isOutOfStock = $items->on_hand == 0;
                            $isLowStock = !$isOutOfStock && $items->on_hand <= $lowStockThreshold;
                        @endphp

                        <div class="col-sm-3">
                            <span class="lead text-muted text-md">{{ $items->item_name }}</span>
                        </div>
                        <div class="col-sm-3">
                            <span class="lead text-muted text-md">{{ $items->category }}</span>
                        </div>
                        <div class="col-sm-3">
                            <span
                                class="lead text-md {{ $isOutOfStock ? 'text-danger fw-bold' : ($isLowStock ? 'text-warning fw-semibold' : 'text-muted') }}">
                                {{ $items->on_hand }}
                            </span>
                        </div>
                        <div class="col-sm-3">
                            @if ($isOutOfStock)
                                <small class="text-danger fw-bold">Out of Stock</small>
                            @elseif($isLowStock)
                                <small class="text-warning fw-semibold">Low</small>
                            @else
                                <small class="text-info fw-semibold">In Stock</small>
                            @endif
                        </div>
                    @endforeach


                </div>
            </div>
        </div>
        @include('modals.new-inventory-item-modal')
    </div>
@endsection
