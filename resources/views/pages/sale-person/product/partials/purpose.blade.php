<!-- =========================================
     FORMULA INGREDIENTS
========================================= -->

<div class="card mt-3">
    <div class="card-header d-flex justify-content-between align-items-center">
        <button type="button"
                class="btn btn-primary btn-sm"
                id="addIngredient">
            + Add Ingredient
        </button>
    </div>

    <div class="card-body">

        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th width="60">Seq</th>
                        <th>Code</th>
                        <th>Ingredient</th>
                        <th>Role</th>
                        <th>Qty</th>
                        <th>%</th>
                        <th>Visible</th>
                        <th width="120">Action</th>
                    </tr>
                </thead>

                <tbody id="ingredientTableBody">

                    <tr>
                        <td>1</td>
                        <td>
                            <input type="text"
                                   name="ingredient_code[]"
                                   class="form-control"
                                   value="ING001">
                        </td>

                        <td>
                            <input type="text"
                                   name="ingredient_name[]"
                                   class="form-control"
                                   value="Water">
                        </td>

                        <td>
                            <select name="ingredient_role[]"
                                    class="form-control">
                                <option value="Base" selected>Base</option>
                                <option value="Active">Active</option>
                                <option value="Preservative">Preservative</option>
                                <option value="Stabilizer">Stabilizer</option>
                            </select>
                        </td>

                        <td>
                            <input type="number"
                                   name="quantity[]"
                                   class="form-control"
                                   value="800">
                        </td>

                        <td>
                            <input type="number"
                                   name="percentage[]"
                                   class="form-control"
                                   value="80">
                        </td>

                        <td>
                            <select name="visible[]"
                                    class="form-control">
                                <option value="Yes" selected>Yes</option>
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

                    <tr>
                        <td>2</td>
                        <td>
                            <input type="text"
                                   name="ingredient_code[]"
                                   class="form-control"
                                   value="ING002">
                        </td>

                        <td>
                            <input type="text"
                                   name="ingredient_name[]"
                                   class="form-control"
                                   value="Aloe Vera">
                        </td>

                        <td>
                            <select name="ingredient_role[]"
                                    class="form-control">
                                <option value="Base">Base</option>
                                <option value="Active" selected>Active</option>
                                <option value="Preservative">Preservative</option>
                                <option value="Stabilizer">Stabilizer</option>
                            </select>
                        </td>

                        <td>
                            <input type="number"
                                   name="quantity[]"
                                   class="form-control"
                                   value="100">
                        </td>

                        <td>
                            <input type="number"
                                   name="percentage[]"
                                   class="form-control"
                                   value="10">
                        </td>

                        <td>
                            <select name="visible[]"
                                    class="form-control">
                                <option value="Yes" selected>Yes</option>
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

                    <tr>
                        <td>3</td>
                        <td>
                            <input type="text"
                                   name="ingredient_code[]"
                                   class="form-control"
                                   value="ING003">
                        </td>

                        <td>
                            <input type="text"
                                   name="ingredient_name[]"
                                   class="form-control"
                                   value="Neem">
                        </td>

                        <td>
                            <select name="ingredient_role[]"
                                    class="form-control">
                                <option value="Base">Base</option>
                                <option value="Active" selected>Active</option>
                                <option value="Preservative">Preservative</option>
                                <option value="Stabilizer">Stabilizer</option>
                            </select>
                        </td>

                        <td>
                            <input type="number"
                                   name="quantity[]"
                                   class="form-control"
                                   value="50">
                        </td>

                        <td>
                            <input type="number"
                                   name="percentage[]"
                                   class="form-control"
                                   value="5">
                        </td>

                        <td>
                            <select name="visible[]"
                                    class="form-control">
                                <option value="Yes">Yes</option>
                                <option value="No" selected>No</option>
                            </select>
                        </td>

                        <td>
                            <button type="button"
                                    class="btn btn-danger btn-sm removeRow">
                                Remove
                            </button>
                        </td>
                    </tr>

                </tbody>
            </table>
        </div>

    </div>
</div>


<script>
    $(document).on('click', '#addIngredient', function () {

    var rowCount = $('#ingredientTableBody tr').length + 1;

    var row = `
        <tr>
            <td>${rowCount}</td>
            <td><input type="text" name="ingredient_code[]" class="form-control"></td>
            <td><input type="text" name="ingredient_name[]" class="form-control"></td>
            <td>
                <select name="ingredient_role[]" class="form-control">
                    <option value="Base">Base</option>
                    <option value="Active">Active</option>
                    <option value="Preservative">Preservative</option>
                    <option value="Stabilizer">Stabilizer</option>
                </select>
            </td>
            <td><input type="number" name="quantity[]" class="form-control"></td>
            <td><input type="number" name="percentage[]" class="form-control"></td>
            <td>
                <select name="visible[]" class="form-control">
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

$(document).on('click', '.removeRow', function () {
    $(this).closest('tr').remove();
});
</script>