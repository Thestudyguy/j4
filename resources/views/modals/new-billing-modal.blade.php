<div class="modal fade" id="new-billing" data-bs-backdrop="static">
    <div class="modal-dialog modal-center modal-lg">
        <div class="modal-content rounded-0">
            <div class="modal-header">
                <h4 class="fw-normal">New Billing</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body position-relative">
                <form action="" class="new-billing-form">
                    <label for="patient" class="lead">Select Appointment</label>
                    <select name="patient" id="appointment" class="form-control">
                        <option value="" selected hidden>select appointment</option>
                        @foreach ($appointments as $item)
                            <option value="{{ $item->id }}">{{ $item->FirstName }} {{ $item->LastName }} - {{ $item->Service }}({{ $item->date }}, {{ $item->time }})</option>
                        @endforeach
                    </select>
                    {{-- <label for="appointment">Select patient appointment</label>
                    <select name="" class="prep-appt-selection form-control" id="">
                        <option value="" class="muted" selected hidden>select a patient first</option>
                    </select> --}}
                    <hr>
                    <div class="row">
                        <div class="col-sm-10">
                            <span class="lg fw-semibold lead">Billing Items</span>
                        </div>
                        <div class="col-sm-2">
                            <input type="search" name="" id="search-items" placeholder="search..."
                                class="form-control sm">
                            {{-- <button class="btn btn-primary btn-sm">
                                <i class="fas-fa-plus"></i><span class="sm">Add Item</span>
                            </button> --}}
                        </div>
                    </div>
                    <div style="max-height: 250px; overflow-y: auto;">
                        <table class="table table-bordered">
                            <thead>
                                <th>Item Name</th>
                                <th>Available</th>
                                <th>Quantity</th>
                                <th>Unit Price</th>
                            </thead>
                            <tbody>
                                @foreach ($inventory as $item)
                                    <tr id="{{ $item->id }}">
                                        <td>
                                            <select class="form-control" name="items-{{ $item->id }}"
                                                id="">
                                                <option value="{{ $item->id }}" selected>{{ $item->item_name }}
                                                </option>
                                                <option value="{{ $item->id }}">{{ $item->item_name }}</option>
                                            </select>
                                        </td>
                                        <td>{{ $item->on_hand }}</td>
                                        <td><input class="form-control" type="number" name="quantity"
                                                id="item-quantity" value="1" max="{{ $item->on_hand }}"></td>
                                        <td>{{ $item->price }}</td>
                                        <td>
                                            <button
                                                class="btn btn-primary btn-sm add-item-{{ $item->id }} item-btn"
                                                data-id="{{ $item->id }}" data-itemname="{{ $item->item_name }}"
                                                data-price="{{ $item->price }}">
                                                <i class="fas-fa-plus"></i><span class="sm">Add Item</span>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <hr>
                    <span class="lg fw-semibold lead">Items Selected</span>
                    <table class="table table-bordered mt-2" id="billing-table">
                        <thead>
                            <tr>
                                <th>Qty</th>
                                <th>Item</th>
                                <th>Unit Price</th>
                                <th>Total</th>
                                {{-- <th>Total</th> --}}
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </form>

            </div>
            <div class="modal-footer">
                <button type="submit" class="btn save-new-billing rounded-0"
                    style="background: #063D58; border-radius: 0px; color: whitesmoke;">{{ __('Save') }}</button>
                <button type="button" class="btn btn-secondary rounded-0"
                    data-bs-dismiss="modal">{{ __('Cancel') }}</button>
            </div>
        </div>
    </div>
</div>
