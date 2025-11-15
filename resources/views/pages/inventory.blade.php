@extends('dashboard')
@section('content')
    <div class="container-fluid py-5 mt-5">
        <h3 class="fw-semibold m-3">Inventory</h3>
        <div class="row">
            <div class="col-sm-4">
                <input type="search" name="search_inventory" class="form-control form-control-sm rounded-4"
                    placeholder="search..." id="searchInventory">
            </div>
            <div class="col-sm-4">
    <a href="{{ url('/inventory-report-pdf') }}" target="_blank"
       class="btn btn-transparent border border-secondary float-end btn-sm fw-semibold text-sm">
        <i class="fas fa-upload"></i>
    </a>
</div>

            <div class="col-sm-4">
                <button data-bs-target='#new-inventory-item' data-bs-toggle='modal' style="background: #20536B;"
                    class="text-white btn border border-secondary float-left btn-sm fw-semibold lead text-sm"><i
                        class="fas fa-plus"></i> Add Item</button>
            </div>
            <div class="container-fluid rounded-5 bg-light mt-5">
                <div class="row p-2 rounded-5">
                    <div class="col-sm-2">
                        <span class="fw-semibold text-muted small">Product Name</span>
                    </div>
                    <div class="col-sm-2">
                        <span class="fw-semibold text-muted small">Category</span>
                    </div>
                    <div class="col-sm-2">
                        <span class="fw-semibold text-muted small">On Hand</span>
                    </div>
                    <div class="col-sm-2">
                        <span class="fw-semibold text-muted small">Unit Price</span>
                    </div>
                    <div class="col-sm-2">
                        <span class="fw-semibold text-muted small">Status</span>
                    </div>
                    <div class="col-sm-2">
                        <span class="fw-semibold text-muted small">Time Stamps</span>
                    </div>
                </div>
            </div>
            <div class="container-fluid mt-2 rounded-4">
                <div class="row p-2 rounded-5 bg-white" id="inventoryList">
                    @foreach ($inventory as $items)
                        @php
                            $maxStock = $items->max_stock ?? 100;
                            $lowStockThreshold = $maxStock * 0.15;
                            $isOutOfStock = $items->on_hand == 0;
                            $isLowStock = !$isOutOfStock && $items->on_hand <= $lowStockThreshold;
                        @endphp

                        <div class="row inventory-row bg-light mt-1">
                            <div class="col-sm-2">
                                <span class="fw-semibold text-muted small">{{ $items->item_name }}</span>
                            </div>
                            <div class="col-sm-2">
                                <span class="fw-semibold text-muted small">{{ $items->category }}</span>
                            </div>
                            <div class="col-sm-2">
                                <span
                                    class="fw-semibold small {{ $isOutOfStock ? 'text-danger fw-bold' : ($isLowStock ? 'text-warning fw-semibold' : 'text-muted') }}">
                                    {{ $items->on_hand }}
                                </span>
                            </div>
                            <div class="col-sm-2">
                                {{-- <span class="fw-semibold text-muted small">{{ $items->price }}</span> --}}
                                <span class="fw-semibold text-muted small">{{ number_format($items->price, 2) }}</span>
                            </div>
                            <div class="col-sm-2">
                                @if ($isOutOfStock)
                                    <small class="text-danger fw-bold small">Out of Stock</small>
                                @elseif($isLowStock)
                                    <small class="text-warning fw-semibold">Low</small>
                                @else
                                    <small class="text-info fw-semibold">In Stock</small>
                                @endif
                            </div>
                            
                            <div class="col-sm-2">
                                <span
                                    class="fw-semibold small fw-bold text-muted">
                                    {{ $items->created_at->timezone('Asia/Manila')->format('F j, Y g:i A') }}


                                </span>
                            </div>
                            
                        </div>
                    @endforeach
                </div>
            </div>

        </div>
        @include('modals.new-inventory-item-modal')
    </div>
@endsection
