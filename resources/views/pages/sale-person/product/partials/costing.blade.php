<style>
/* =========================================
       GLOBAL COMPACT UI
    ========================================== */

.card {
    border-radius: 10px;
    border: 1px solid #e5e7eb;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
    overflow: hidden;
}

.card-header {
    background: #f8fafc !important;
    padding: 10px 14px;
    border-bottom: 1px solid #e5e7eb;
}

.card-body {
    padding: 12px;
}

.border.rounded {
    border: 1px solid #e5e7eb !important;
    border-radius: 10px !important;
    background: #fff;
    padding: 12px !important;
    margin-bottom: 12px !important;
}

/* =========================================
       TYPOGRAPHY
    ========================================== */

label,
.table th,
.table td,
.form-control,
.form-control-sm,
select,
input {
    font-size: 11px !important;
    font-weight: 500;
}

label {
    margin-bottom: 3px;
    color: #374151;
}

h5,
.card-header h5 {
    font-size: 14px;
    font-weight: 700;
    margin: 0;
}

h6 {
    font-size: 12px;
    font-weight: 700;
    margin-bottom: 10px !important;
    color: #1f2937;
}

/* =========================================
       FORM CONTROLS
    ========================================== */

.form-control,
.form-control-sm {
    height: 30px !important;
    padding: 4px 8px !important;
    border-radius: 6px !important;
    border: 1px solid #d1d5db !important;
    box-shadow: none !important;
}

.form-control:focus,
.form-control-sm:focus {
    border-color: #2563eb !important;
    box-shadow: 0 0 0 2px rgba(37, 99, 235, 0.08) !important;
}

/* =========================================
       TABLE DESIGN
    ========================================== */

.table {
    margin-bottom: 0;
}

.table thead th {
    background: #f3f4f6;
    color: #111827;
    font-size: 11px;
    font-weight: 700;
    padding: 7px 6px !important;
    white-space: nowrap;
    vertical-align: middle;
}

.table td {
    padding: 5px !important;
    vertical-align: middle !important;
}

.table-bordered th,
.table-bordered td {
    border: 1px solid #e5e7eb !important;
}

.table-responsive {
    border-radius: 8px;
    overflow: hidden;
    margin-bottom: 12px;
}

/* =========================================
       BUTTONS
    ========================================== */

.btn {
    border-radius: 6px;
    font-size: 11px;
    font-weight: 600;
    padding: 5px 10px;
}

.btn-sm {
    padding: 4px 8px !important;
    font-size: 10px !important;
    line-height: 1.2;
}

.btn-primary {
    background: #2563eb;
    border-color: #2563eb;
}

.btn-danger {
    background: #dc2626;
    border-color: #dc2626;
}

/* =========================================
       SUMMARY SECTION
    ========================================== */

.summary-box {
    background: #f9fafb;
    border: 1px solid #e5e7eb;
    border-radius: 8px;
    padding: 10px;
}

/* =========================================
       SPACING
    ========================================== */

.row {
    margin-bottom: 8px;
}

.mt-3 {
    margin-top: 12px !important;
}

.mb-3 {
    margin-bottom: 10px !important;
}

.p-3 {
    padding: 12px !important;
}

/* =========================================
       RESPONSIVE
    ========================================== */

@media (max-width: 768px) {

    .form-control,
    .form-control-sm {
        min-width: 90px;
    }

    .btn-sm {
        width: 100%;
    }

}
</style>


<!-- <div class="card mt-3"> -->



    <!-- <div class="card-body"> -->

        <!-- =====================================
             INVENTORY COSTS
        ====================================== -->


        <div class="border rounded p-3 mb-4">

            <div class="d-flex justify-content-between align-items-center mb-3">

                <h6 class="font-weight-bold text-primary mb-0">
                    Inventory Cost Summary
                </h6>

            </div>

            <div class="table-responsive">

                <table class="table table-bordered table-sm">

                    <thead class="thead-light">

                        <tr>

                            <th width="25%">Type</th>
                            <th width="20%">Total Qty</th>
                            <th width="20%">Total Cost</th>
                            <!-- <th width="35%">Source</th> -->

                        </tr>

                    </thead>

                    <tbody>

                        <!-- INGREDIENT -->
                        <tr>

                            <td>
                                Raw Material / Ingredient
                            </td>

                            <td>

                                <input type="text" id="ingredientQtyDisplay"
                                    class="form-control form-control-sm bg-light" readonly>

                            </td>

                            <td>

                                <input type="text" id="ingredientCostDisplay"
                                    class="form-control form-control-sm bg-light" readonly>

                            </td>

                            <!-- <td>
                                Ingredient Batch Table
                            </td> -->

                        </tr>
                        <tr>

                            <td>
                                Packaging Material
                            </td>

                            <td>

                                <input type="text" id="packagingQtyDisplay"
                                    class="form-control form-control-sm bg-light" readonly>

                            </td>

                            <td>

                                <input type="text" id="packagingCostDisplay"
                                    class="form-control form-control-sm bg-light" readonly>

                            </td>

                            <!-- <td>
                                Packaging Details Section
                            </td> -->

                        </tr>

                    </tbody>

                    <tfoot>

                        <tr>

                            <th colspan="2" class="text-right">
                                Total Inventory Cost
                            </th>

                            <th>

                                <input type="text" id="totalInventoryCostDisplay"
                                    class="form-control form-control-sm bg-light font-weight-bold" readonly>

                            </th>

                            <th></th>

                        </tr>

                    </tfoot>

                </table>

            </div>

        </div>
        <!-- =====================================
            NON INVENTORY COSTS
        ===================================== -->

        <div class="border rounded p-3 mb-4">

            <div class="d-flex justify-content-between align-items-center mb-3">

                <h6 class="font-weight-bold text-primary mb-0">
                    Non Inventory Costs
                </h6>

                <button type="button" class="btn btn-primary btn-sm" id="addNonInventoryRow">
                    Add Cost Head
                </button>

            </div>

            <div class="table-responsive">

                <table class="table table-bordered table-sm" id="nonInventoryTable">

                    <thead class="thead-light">

                        <tr>
                            <th width="30%">Cost Head</th>
                            <th width="30%">Amount</th>
                            <th width="20%">Action</th>
                        </tr>

                    </thead>

                    <tbody>

                        <tr>

                            <td>

                                <select name="cost_head[]" class="form-control non-inventory-cost">

                                    <option value="">
                                        Select Cost Head
                                    </option>

                                    <option value="Direct Labour">
                                        Direct Labour
                                    </option>

                                    <option value="Machine Usage">
                                        Machine Usage
                                    </option>

                                    <option value="Electricity">
                                        Electricity
                                    </option>

                                    <option value="Water Consumption">
                                        Water Consumption
                                    </option>

                                    <option value="Quality Control">
                                        Quality Control
                                    </option>

                                    <option value="Production Supervision">
                                        Production Supervision
                                    </option>

                                    <option value="Factory Rent Allocation">
                                        Factory Rent Allocation
                                    </option>

                                    <option value="Office Salary Allocation">
                                        Office Salary Allocation
                                    </option>

                                    <option value="Maintenance">
                                        Maintenance
                                    </option>

                                    <option value="Insurance">
                                        Insurance
                                    </option>

                                    <option value="Warehouse Cost">
                                        Warehouse Cost
                                    </option>

                                    <option value="Admin Overheads">
                                        Admin Overheads
                                    </option>

                                    <option value="Consumables">
                                        Consumables
                                    </option>

                                </select>

                            </td>

                            <td>

                                <input type="number" step="0.01" name="cost_amount[]"
                                    class="form-control non-inventory-amount" placeholder="0.00">

                            </td>

                            <td>

                                <button type="button" class="btn btn-danger btn-sm remove-row">
                                    Remove
                                </button>

                            </td>

                        </tr>

                    </tbody>

                    <tfoot>

                        <tr>

                            <th class="text-right">
                                Total Non Inventory Cost
                            </th>

                            <th>
                                ₹ <span id="nonInventoryTotal">0.00</span>
                            </th>

                            <th></th>

                        </tr>

                    </tfoot>

                </table>

            </div>

        </div>
        <!-- =====================================
             COST SUMMARY
        ====================================== -->

        <div class="border rounded p-3">

            <h6 class="font-weight-bold mb-3">
                Cost Summary
            </h6>

            <div class="row">

                <div class="col-md-3">
                    <label>Inventory Cost</label>
                    <input type="number" readonly id="inventoryCost" class="form-control">
                </div>

                <div class="col-md-3">
                    <label>Non Inventory Cost</label>
                    <input type="number" readonly id="nonInventoryCost" class="form-control">
                </div>

                <div class="col-md-3">
                    <label>Total Manufacturing Cost</label>
                    <input type="number" readonly id="totalManufacturingCost" class="form-control">
                </div>

                <div class="col-md-3">
                    <label>Margin (%)</label>
                    <input type="number" id="marginPercentage" class="form-control" value="25">
                </div>

                <div class="col-md-3">
                    <label>Suggested Selling Price</label>
                    <input type="number" readonly id="sellingPrice" class="form-control">
                </div>
            </div>

            <div class="row mt-3">



            </div>

        </div>

    <!-- </div> -->

<!-- </div> -->

<script>
$(document).on('click', '#addNonInventoryRow', function() {

    let row = `
    <tr>

        <td>

            <select name="cost_head[]"
                    class="form-control non-inventory-cost">

                <option value="">Select Cost Head</option>

                <option value="Direct Labour">Direct Labour</option>
                <option value="Machine Usage">Machine Usage</option>
                <option value="Electricity">Electricity</option>
                <option value="Water Consumption">Water Consumption</option>
                <option value="Quality Control">Quality Control</option>
                <option value="Production Supervision">Production Supervision</option>
                <option value="Factory Rent Allocation">Factory Rent Allocation</option>
                <option value="Office Salary Allocation">Office Salary Allocation</option>
                <option value="Maintenance">Maintenance</option>
                <option value="Insurance">Insurance</option>
                <option value="Warehouse Cost">Warehouse Cost</option>
                <option value="Admin Overheads">Admin Overheads</option>
                <option value="Consumables">Consumables</option>

            </select>

        </td>

        <td>

            <input type="number"
                   step="0.01"
                   name="cost_amount[]"
                   class="form-control non-inventory-amount"
                   placeholder="0.00">

        </td>

        <td>

            <button type="button"
                    class="btn btn-danger btn-sm remove-row">
                Remove
            </button>

        </td>

    </tr>
    `;

    $('#nonInventoryTable tbody').append(row);

});


$(document).on('click', '.remove-row', function() {

    $(this).closest('tr').remove();

    calculateNonInventory();

});


$(document).on('keyup change',
    '.non-inventory-amount',
    function() {

        calculateNonInventory();

    });


function calculateNonInventory() {
    let total = 0;

    $('.non-inventory-amount').each(function() {

        total += parseFloat($(this).val()) || 0;

    });

    $('#nonInventoryTotal').text(total.toFixed(2));

    $('#nonInventoryCost').val(total.toFixed(2));

}
</script>


<script>
/* =====================================
   INVENTORY SUMMARY
===================================== */

function updateInventorySummary() {

    let ingredientQty = 0;
    let ingredientCost = 0;

    $('.quantity').each(function() {

        ingredientQty += parseFloat($(this).val()) || 0;

    });

    $('.ingredient-cost').each(function() {

        ingredientCost += parseFloat($(this).val()) || 0;

    });



    let packagingQty = 0;
    let packagingCost = 0;

    $('input[name*="[fill_quantity]"]').each(function() {

        packagingQty += parseFloat($(this).val()) || 0;

    });

    $('input[name*="[in_batch]"]').each(function() {

        packagingCost += parseFloat($(this).val()) || 0;

    });



    let totalInventory =
        ingredientCost + packagingCost;



    $('#ingredientQtyDisplay').val(ingredientQty);

    $('#ingredientCostDisplay').val(
        '₹ ' + ingredientCost.toFixed(2)
    );



    $('#packagingQtyDisplay').val(packagingQty);

    $('#packagingCostDisplay').val(
        '₹ ' + packagingCost.toFixed(2)
    );



    $('#totalInventoryCostDisplay').val(
        '₹ ' + totalInventory.toFixed(2)
    );

}



/* =====================================
   LIVE UPDATE
===================================== */

$(document).on(
    'keyup change',
    '.quantity, .ingredient-cost, input[name*="[fill_quantity]"], input[name*="[in_batch]"]',
    function() {

        updateInventorySummary();

    }
);



/* =====================================
   INITIAL LOAD
===================================== */

updateInventorySummary();
</script>