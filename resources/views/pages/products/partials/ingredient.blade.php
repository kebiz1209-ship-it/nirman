<style>
.batch-row label {
    font-size: 11px;
    font-weight: 600;
    margin-bottom: 3px;
}

.batch-row .form-control,
.batch-row .form-control-sm {
    font-size: 11px !important;
    font-weight: 500;
    height: 30px;
    padding: 4px 8px;
}

.batch-section {
    background: #f8f9fa;
    border: 1px solid #dee2e6;
    border-radius: 6px;
    padding: 15px;
    margin-bottom: 20px;
}

.batch-section-title {
    font-size: 14px;
    font-weight: 700;
    margin-bottom: 12px;
    color: #333;
}

.batch-field label {
    font-size: 11px;
    font-weight: 600;
    margin-bottom: 4px;
    display: block;
}

.batch-field .form-control,
.batch-field .form-select {
    height: 30px;
    font-size: 11px;
    font-weight: 500;
    padding: 4px 8px;
}
</style>


<div class="card mt-3">



    <div class="card-body">

        <!-- Batch Information -->



        <!-- Batch Information -->
        <div class="batch-section">

            <div class="batch-section-title">
                Batch Information
            </div>


            <div class="row align-items-end">


                <!-- Total Batch Qty -->
                <div class="col-md-3 batch-field">

                    <label>
                        Total Qty in Batch
                    </label>

                    <input type="number" id="total_batch_qty" name="total_batch_qty" class="form-control" value="1000">

                </div>



                <!-- Adjustment -->
                <div class="col-md-3 batch-field">

                    <label>
                        Adjustment Type
                    </label>

                    <select id="adjustment_type" name="adjustment_type" class="form-control">

                        <option value="same">
                            Same
                        </option>

                        <option value="increase">
                            Increase
                        </option>

                        <option value="decrease">
                            Decrease
                        </option>

                    </select>

                </div>



                <!-- Adjustment Qty -->
                <div class="col-md-3 batch-field">

                    <label>
                        Adjustment Qty
                    </label>

                    <input type="text" id="adjustment_qty" name="adjustment_qty" class="form-control"
                        placeholder="Eg: 20%">

                </div>




                <!-- Concurrent Batch -->
                <div class="col-md-3 batch-field">

                    <label>
                        Concurrent Batch Production
                    </label>

                    <input type="number" id="concurrent_batch_qty" name="concurrent_batch_qty" class="form-control"
                        value="1000">

                </div>



            </div>


        </div>



        <div class="card-header d-flex justify-content-between align-items-center">

            <button type="button" class="btn btn-primary btn-sm" id="addIngredient">
                + Add Ingredient
            </button>

        </div>

        <!-- Ingredient Table -->
        <div class="table-responsive">

            <table class="table table-bordered table-striped">

                <thead>
                    <tr>
                        <th width="60">Seq</th>
                        <th>Code</th>
                        <th>Ingredient</th>
                        <th>Role</th>
                        <th>Qty</th>
                        <th>Unit</th>
                        <th>%</th>
                        <th>Cost / Batch</th>
                        <th>Visible on label</th>
                        <th width="120">Action</th>
                    </tr>
                </thead>

                <tbody id="ingredientTableBody">

                    <tr>

                        <td class="seq">1</td>

                        <td>
                            <input type="text" name="ingredient_code[]" class="form-control" value="ING001">
                        </td>

                        <td>
                            <input type="text" name="ingredient_name[]" class="form-control" value="Water">
                        </td>

                        <td>
                            <select name="ingredient_role[]" class="form-control">
                                <option value="Base" selected>Base</option>
                                <option value="Active">Active</option>
                                <option value="Preservative">Preservative</option>
                                <option value="Stabilizer">Stabilizer</option>
                            </select>
                        </td>

                        <td>
                            <input type="number" name="quantity[]" class="form-control quantity" value="800">
                        </td>

                        <td>
                            <input type="text" name="unit[]" class="form-control" value="gm">
                        </td>

                        <td>
                            <input type="number" name="percentage[]" class="form-control" value="80">
                        </td>

                        <td>
                            <input type="number" name="ingredient_cost[]" class="form-control ingredient-cost"
                                value="0">
                        </td>

                        <td>
                            <select name="visible[]" class="form-control">
                                <option value="Yes" selected>Yes</option>
                                <option value="No">No</option>
                            </select>
                        </td>

                        <td>
                            <button type="button" class="btn btn-danger btn-sm removeRow">
                                Remove
                            </button>
                        </td>

                    </tr>

                </tbody>

                <!-- Footer -->
                <tfoot>

                    <tr>

                        <th colspan="7" class="text-right">
                            Total Cost
                        </th>

                        <th>
                            <input type="number" id="table_total_cost" class="form-control bg-light" readonly>
                        </th>

                        <th colspan="2"></th>

                    </tr>

                </tfoot>

            </table>

        </div>

    </div>

</div>

<script>
// Add Ingredient Row
$(document).on('click', '#addIngredient', function() {

    let rowCount = $('#ingredientTableBody tr').length + 1;

    let row = `
            <tr>

                <td class="seq">${rowCount}</td>

                <td>
                    <input type="text"
                           name="ingredient_code[]"
                           class="form-control">
                </td>

                <td>
                    <input type="text"
                           name="ingredient_name[]"
                           class="form-control">
                </td>

                <td>
                    <select name="ingredient_role[]"
                            class="form-control">
                        <option value="Base">Base</option>
                        <option value="Active">Active</option>
                        <option value="Preservative">Preservative</option>
                        <option value="Stabilizer">Stabilizer</option>
                    </select>
                </td>

                <td>
                    <input type="number"
                           name="quantity[]"
                           class="form-control quantity"
                           value="0">
                </td>

                <td>
                    <input type="text"
                           name="unit[]"
                           class="form-control">
                </td>

                <td>
                    <input type="number"
                           name="percentage[]"
                           class="form-control"
                           value="0">
                </td>

                <td>
                    <input type="number"
                           name="ingredient_cost[]"
                           class="form-control ingredient-cost"
                           value="0">
                </td>

                <td>
                    <select name="visible[]"
                            class="form-control">
                        <option value="Yes">Yes</option>
                        <option value="No">No</option>
                    </select>
                </td>

                <td>
                    <button type="button"
                            class="btn btn-danger btn-sm removeRow">
                        Remove
                    </button>
                </td>

            </tr>
        `;

    $('#ingredientTableBody').append(row);

});

// Remove Row
$(document).on('click', '.removeRow', function() {

    $(this).closest('tr').remove();

    updateSequence();

    calculateTotalCost();

});

// Update Sequence
function updateSequence() {

    $('#ingredientTableBody tr').each(function(index) {

        $(this).find('.seq').text(index + 1);

    });

}

// Calculate Final Product Quantity
function calculateFinalQty() {

    let totalQty = parseFloat($('#total_batch_qty').val()) || 0;

    let adjustmentType = $('#adjustment_type').val();

    let adjustmentQty = parseFloat($('#adjustment_qty').val()) || 0;

    let finalQty = totalQty;

    if (adjustmentType === 'increase') {

        finalQty = totalQty + adjustmentQty;

    } else if (adjustmentType === 'decrease') {

        finalQty = totalQty - adjustmentQty;

    }

    $('#final_product_qty').val(finalQty);

}

// Calculate Ingredient Total Cost
function calculateTotalCost() {

    let total = 0;

    $('.ingredient-cost').each(function() {

        total += parseFloat($(this).val()) || 0;

    });

    $('#table_total_cost').val(total);

    $('#grand_total_cost').val(total);

}

// Trigger Quantity Calculation
$(document).on('keyup change',
    '#total_batch_qty, #adjustment_type, #adjustment_qty',
    function() {

        calculateFinalQty();

    }
);

// Trigger Cost Calculation
$(document).on('keyup change',
    '.ingredient-cost',
    function() {

        calculateTotalCost();

    }
);

// Initial Load
calculateFinalQty();

calculateTotalCost();
</script>