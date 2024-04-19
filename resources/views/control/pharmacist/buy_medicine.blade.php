@extends('control.layout._app')
@section('content')
    <div class="card">
        @include('auth.message')
        @include('auth.error')
        <h5 style="text-align:center;" class="card-title alert alert-success">New Purchase</h5>
        <div class="card-body">
            <!-- Multi Columns Form -->
            <form class="row g-3" action="{{ url('_pharmacist/buy_medicine') }}" method="POST">
                @csrf
                <h6 style="text-align:center;" class="card-title alert alert-info mt-2">Select Medicines</h6>
                <div class="col-md-12" style="border: 2px solid grey; padding:1rem;">
                    <button id="addRow" type="button" class="btn btn-info">Add <i
                            class="bi bi-plus-circle-fill"></i></button>
                    <table class="table table-striped" id="inputTable">
                        <thead>
                            <tr>
                                <th>Medicaments<sup style="color:red;">*</sup></th>
                                <th>Lot No<sup style="color:red;">*</sup></th>
                                <th>Purchase Price<sup style="color:red;">*</sup></th>
                                <th>Sale Price<sup style="color:red;">*</sup></th>
                                <th>Quantity<sup style="color:red;">*</sup></th>
                                <th>Tax</th>
                                <th>Amount<sup style="color:red;">*</sup></th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
                <h6 style="text-align:center;" class="card-title alert alert-info mt-2">Memo</h6>
                <div class="col-md-12" style="border: 2px solid grey; padding:1rem;">
                    <div class="row">
                        <div class="col-md-7">
                            <label for="inputNote" class="form-label">Note</label>
                            <textarea class="form-control" id="inputNote" name="notes" style="height: 100px"></textarea>
                        </div>
                        <div class="col-md-5">
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="inputDiscount" class="form-label">Discount</label>
                                    <input type="number" class="form-control" id="inputDiscount" name="discount"
                                        value="0">
                                </div>
                                <div class="col-md-12">
                                    <label for="inputNet" class="form-label">Net<sup style="color:red;">*</sup></label>
                                    <input type="number" class="form-control" id="inputNet" name="net" readonly>
                                </div>
                                <div class="col-md-12">
                                    <label for="inputMethod" class="form-label">Payment Method<sup
                                            style="color:red;">*</sup></label>
                                    <select class="form-select" name="payment_method">
                                        <option value="cash">Cash</option>
                                        <option value="cheque">Cheque</option>
                                        <option value="credit_card">Credit Card</option>
                                        <option value="online">Online</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Purchase</button>
                </div>
                <!-- End Multi Columns Form -->
            </form>
        </div>
    </div>

    <script>
        // Wait for the DOM to be fully loaded
        document.addEventListener('DOMContentLoaded', function() {
            // Function to handle changing medicine selection
            function handleMedicineChange(selectElement) {
                const medicineId = selectElement.value;

                // Make AJAX request to fetch prices
                fetch(`/_pharmacist/getMedicinePrices/${medicineId}`)
                    .then(response => response.json())
                    .then(data => {
                        // Update purchase_price and sale_price fields with fetched prices
                        const row = selectElement.closest('tr');
                        row.querySelector('[name="purchase_price[]"]').value = data.buying_price;
                        row.querySelector('[name="sale_price[]"]').value = data.selling_price;

                        // Recalculate total amount
                        calculateTotalAmount(row);
                        // Recalculate net
                        calculateNet();
                    })
                    .catch(error => {
                        console.error('Error fetching medicine prices:', error);
                    });
            }

            // Function to calculate total amount
            function calculateTotalAmount(row) {
                const quantity = parseFloat(row.querySelector('.quantity').value);
                const purchasePrice = parseFloat(row.querySelector('[name="purchase_price[]"]').value);
                let tax = row.querySelector('.tax').value.trim();
                tax = tax === '' ? 0 : parseFloat(tax);

                const totalAmount = quantity * purchasePrice * (1 + tax / 100);

                row.querySelector('[name="amount[]"]').value = totalAmount.toFixed(2);

                // Recalculate net
                calculateNet();
            }

            // Function to calculate net
            function calculateNet() {
                let total = 0;
                const rows = document.querySelectorAll('#inputTable tbody tr');
                rows.forEach(row => {
                    const amount = parseFloat(row.querySelector('[name="amount[]"]').value) || 0;
                    total += amount;
                });

                const discount = parseFloat(document.getElementById('inputDiscount').value) || 0;
                const net = total - discount;

                document.getElementById('inputNet').value = net.toFixed(2);
            }

            // Function to add event listener for changing medicine selection
            function addMedicineChangeEventListener(selectElement) {
                selectElement.addEventListener('change', function() {
                    handleMedicineChange(this);
                });
            }

            // Get all medicine select elements
            const medicineSelects = document.querySelectorAll('select[name="medicine_id[]"]');

            // Add event listener to each medicine select element
            medicineSelects.forEach(addMedicineChangeEventListener);

            // Get the 'Add' button
            const addRowBtn = document.getElementById('addRow');

            // Add event listener to the 'Add' button
            addRowBtn.addEventListener('click', function() {
                // Get the table body where new rows will be appended
                const tableBody = document.querySelector('#inputTable tbody');

                // Create a new row element
                const newRow = document.createElement('tr');

                // Define the HTML content of the new row, including the "Select" option
                newRow.innerHTML = `
                    <td>
                        <select class="form-select" name="medicine_id[]">
                            <option value="0">Select</option>
                            @foreach ($getMedicine as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <input type="number" class="form-control" name="lot_no[]" required>
                    </td>
                    <td>
                        <input type="number" class="form-control" name="purchase_price[]" readonly>
                    </td>
                    <td>
                        <input type="number" class="form-control" name="sale_price[]" readonly>
                    </td>
                    <td>
                        <input type="number" class="form-control quantity" name="quantity[]" value="0">
                    </td>
                    <td>
                        <input type="number" class="form-control tax" name="tax[]" value="0">
                    </td>
                    <td>
                        <input type="number" class="form-control" name="amount[]" readonly>
                    </td>
                    <td>
                        <button class="btn btn-outline-danger removeRow">Remove</button>
                    </td>
                `;

                // Append the new row to the table body
                tableBody.appendChild(newRow);

                // Add event listener for changing medicine selection to the new select element
                addMedicineChangeEventListener(newRow.querySelector('select[name="medicine_id[]"]'));

                // Add event listeners for quantity and tax input fields
                newRow.querySelector('.quantity').addEventListener('input', function() {
                    calculateTotalAmount(newRow);
                });

                newRow.querySelector('.tax').addEventListener('input', function() {
                    calculateTotalAmount(newRow);
                });
            });

            // Event delegation for removing rows
            document.addEventListener('click', function(event) {
                // Check if the clicked element is a remove button
                if (event.target.classList.contains('removeRow')) {
                    // Get the parent row of the remove button
                    const rowToRemove = event.target.closest('tr');

                    // Remove the parent row from the table body
                    rowToRemove.remove();

                    // Recalculate net
                    calculateNet();
                }
            });

            // Event listener for discount input field
            document.getElementById('inputDiscount').addEventListener('input', function() {
                calculateNet();
            });
        });
    </script>
@endsection
