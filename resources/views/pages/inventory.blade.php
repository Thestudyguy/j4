@extends('dashboard')
@section('content')
<div class="container-fluid py-5 mt-5">
<div class="container-fluid py-4 mt-4">
    <div class="loader-container inventory-page visually-hidden">
            <div class="loader"></div>
        </div>
    <h3 class="fw-semibold mb-3">Inventory</h3>

    <div class="row mb-3">
        <div class="col-sm-4">
            <input type="search" name="search_inventory" class="form-control form-control-sm rounded-4"
                placeholder="Search inventory..." id="searchInventory">
        </div>
        <div class="col-sm-8 text-end">
            <a href="{{ url('/inventory-report-pdf') }}" target="_blank"
               class="btn btn-outline-secondary btn-sm me-2">
                <i class="fas fa-upload"></i> Export PDF
            </a>
            <button data-bs-toggle="modal" data-bs-target="#new-inventory-item"
                    class="btn btn-primary btn-sm">
                <i class="fas fa-plus"></i> Add Item
            </button>
        </div>
    </div>

    <div class="table-responsive shadow-sm rounded-3 bg-white">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light">
                <tr>
                    <th class="small text-center">Product Name</th>
                    <th class="small text-center">Category</th>
                    <th class="small text-center">On Hand</th>
                    <th class="small text-center">Unit Price</th>
                    <th class="small text-center">Manufacturer</th>
                    <th class="small text-center">Expiration Date</th>
                    <th class="small text-center">Status</th>
                    <th class="small text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($inventory as $items)
                    @php
                        $maxStock = $items->max_stock ?? 100;
                        $lowStockThreshold = $maxStock * 0.15;
                        $isOutOfStock = $items->on_hand == 0;
                        $isLowStock = !$isOutOfStock && $items->on_hand <= $lowStockThreshold;
                    @endphp
                    <tr>
                        <td class="text-center small">{{ $items->item_name }}</td>
                        <td class="text-center small">{{ $items->category }}</td>
                        <td class="text-center small {{ $isOutOfStock ? 'text-danger fw-bold' : ($isLowStock ? 'text-warning fw-semibold' : 'text-muted') }}">
                            {{ $items->on_hand }}
                        </td>
                        <td class="text-center small">{{ number_format($items->price, 2) }}</td>
                        <td class="text-center small">{{ $items->manufactured_by }}</td>
                        <td class="text-center small">{{ $items->expiration_date }}</td>
                        <td class="text-center">
                            @if ($isOutOfStock)
                                <span class="badge bg-danger small">Out of Stock</span>
                            @elseif($isLowStock)
                                <span class="badge bg-warning text-dark small">Low</span>
                            @else
                                <span class="badge bg-info text-dark small">In Stock</span>
                            @endif
                        </td>
                        <td class="text-center">
                            <span class="badge bg-primary cursor-pointer small" style="cursor: pointer;"
                                  data-bs-toggle="modal"
                                  data-bs-target="#edit-inventory-{{ $items->id }}">
                                <i class="fas fa-edit fa-sm"></i>
                            </span>
                            <span class="badge bg-danger cursor-pointer small" style="cursor: pointer;"
                                  onclick="" data-bs-target="#remove-item-{{$items->id}}"
                                   data-bs-toggle="modal">
                                <i class="fas fa-trash-alt fa-sm"></i>
                            </span>
                        </td>
                    </tr>
                    @include('modals.remove-inventory-item')
                    @include('modals.edit-inventory-item')
                @endforeach
            </tbody>
        </table>
    </div>
</div>

    @include('modals.new-inventory-item-modal')
</div>
@endsection
