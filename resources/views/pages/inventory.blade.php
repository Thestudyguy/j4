@extends('dashboard')
@section('content')
<div class="container py-5 mt-5">
    <h5 class="fw-semibold m-3"><i class="fas fa-boxes-stacked me-2 text-primary"></i>Inventory</h5>

    <div class="table-responsive shadow rounded">
        <table class="table table-hover table-bordered align-middle small">
            <thead class="text-center table-light">
                <tr>
                    <th>#</th>
                    <th>Item Name</th>
                    <th>Category</th>
                    <th>Qty</th>
                    <th>Unit</th>
                    <th>Status</th>
                    <th>Last Updated</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody class="text-center">
                <tr>
                    <th>1</th>
                    <td class="text-start">Dental Gloves</td>
                    <td>Protective Gear</td>
                    <td>200</td>
                    <td>Boxes</td>
                    <td><span class="badge bg-success"><i class="fas fa-circle me-1 small"></i>In Stock</span></td>
                    <td>July 28, 2025</td>
                    <td>
                        <a href="#" class="text-primary me-2" title="View"><i class="fas fa-eye"></i></a>
                        <a href="#" class="text-warning me-2" title="Edit"><i class="fas fa-pen"></i></a>
                        <a href="#" class="text-danger" title="Delete"><i class="fas fa-trash"></i></a>
                    </td>
                </tr>
                <tr>
                    <th>2</th>
                    <td class="text-start">Face Masks</td>
                    <td>Protective Gear</td>
                    <td>50</td>
                    <td>Boxes</td>
                    <td><span class="badge bg-warning text-dark"><i class="fas fa-circle me-1 small"></i>Low</span></td>
                    <td>July 25, 2025</td>
                    <td>
                        <a href="#" class="text-primary me-2"><i class="fas fa-eye"></i></a>
                        <a href="#" class="text-warning me-2"><i class="fas fa-pen"></i></a>
                        <a href="#" class="text-danger"><i class="fas fa-trash"></i></a>
                    </td>
                </tr>
                <tr>
                    <th>3</th>
                    <td class="text-start">Dental Mirror</td>
                    <td>Instruments</td>
                    <td>30</td>
                    <td>Pieces</td>
                    <td><span class="badge bg-success"><i class="fas fa-circle me-1 small"></i>In Stock</span></td>
                    <td>July 26, 2025</td>
                    <td>
                        <a href="#" class="text-primary me-2"><i class="fas fa-eye"></i></a>
                        <a href="#" class="text-warning me-2"><i class="fas fa-pen"></i></a>
                        <a href="#" class="text-danger"><i class="fas fa-trash"></i></a>
                    </td>
                </tr>
                <tr>
                    <th>4</th>
                    <td class="text-start">Composite Resin</td>
                    <td>Restorative</td>
                    <td>10</td>
                    <td>Syringes</td>
                    <td><span class="badge bg-danger"><i class="fas fa-circle me-1 small"></i>Out</span></td>
                    <td>July 23, 2025</td>
                    <td>
                        <a href="#" class="text-primary me-2"><i class="fas fa-eye"></i></a>
                        <a href="#" class="text-warning me-2"><i class="fas fa-pen"></i></a>
                        <a href="#" class="text-danger"><i class="fas fa-trash"></i></a>
                    </td>
                </tr>
                <tr>
                    <th>5</th>
                    <td class="text-start">Dental Floss</td>
                    <td>Consumables</td>
                    <td>120</td>
                    <td>Rolls</td>
                    <td><span class="badge bg-success"><i class="fas fa-circle me-1 small"></i>In Stock</span></td>
                    <td>July 28, 2025</td>
                    <td>
                        <a href="#" class="text-primary me-2"><i class="fas fa-eye"></i></a>
                        <a href="#" class="text-warning me-2"><i class="fas fa-pen"></i></a>
                        <a href="#" class="text-danger"><i class="fas fa-trash"></i></a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection
