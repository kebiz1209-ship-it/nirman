<div class="card shadow-sm border-0 mt-3">

    <div class="card-header bg-light d-flex justify-content-between align-items-center">
        <h5 class="mb-0">
            <i class="fa fa-layer-group text-primary"></i>
            Formula Builder
        </h5>

        <button class="btn btn-primary btn-sm">
            <i class="fa fa-plus"></i>
            Add Compound
        </button>
    </div>

    <div class="card-body">

        <!-- Compound 1 -->

        <div class="card border mb-4">

            <div class="card-header bg-white">

                <div class="row align-items-center">

                    <div class="col-md-3">
                        <label class="small text-muted mb-1">Compound Name</label>
                        <input type="text"
                               class="form-control"
                               value="Compound A">
                    </div>

                    <div class="col-md-3">
                        <label class="small text-muted mb-1">Type</label>
                        <select class="form-control">
                            <option selected>Secret Compound</option>
                            <option>Base Blend</option>
                            <option>Active Blend</option>
                        </select>
                    </div>

                    <div class="col-md-2">
                        <label class="small text-muted mb-1">Visibility</label>
                        <select class="form-control">
                            <option selected>Restricted</option>
                            <option>Open</option>
                            <option>Confidential</option>
                        </select>
                    </div>

                    <div class="col-md-2">
                        <label class="small text-muted mb-1">Masking</label>
                        <select class="form-control">
                            <option selected>Yes</option>
                            <option>No</option>
                        </select>
                    </div>

                    <div class="col-md-2 text-end">
                        <label class="small d-block">&nbsp;</label>
                        <button class="btn btn-danger btn-sm">
                            <i class="fa fa-trash"></i>
                        </button>
                    </div>

                </div>

            </div>

            <div class="card-body">

                <div class="d-flex justify-content-between align-items-center mb-2">

                    <h6 class="mb-0">
                        Ingredients
                    </h6>

                    <button class="btn btn-success btn-sm">
                        <i class="fa fa-plus"></i>
                        Add Ingredient
                    </button>

                </div>

                <div class="table-responsive">

                    <table class="table table-bordered align-middle">

                        <thead class="table-light">

                        <tr>
                            <th width="30%">Ingredient</th>
                            <th width="15%">Role</th>
                            <th width="10%">Qty</th>
                            <th width="10%">UOM</th>
                            <th width="10%">%</th>
                            <th width="15%">Visible</th>
                            <th width="10%">Action</th>
                        </tr>

                        </thead>

                        <tbody>

                        <tr>
                            <td>
                                <select class="form-control">
                                    <option selected>Water</option>
                                </select>
                            </td>
                            <td>
                                <select class="form-control">
                                    <option selected>Base</option>
                                </select>
                            </td>
                            <td>
                                <input class="form-control" value="400">
                            </td>
                            <td>
                                <input class="form-control" value="KG">
                            </td>
                            <td>
                                <input class="form-control" value="40">
                            </td>
                            <td>
                                <select class="form-control">
                                    <option selected>Yes</option>
                                </select>
                            </td>
                            <td class="text-center">
                                <button class="btn btn-outline-danger btn-sm">
                                    ×
                                </button>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <select class="form-control">
                                    <option selected>Special Active X</option>
                                </select>
                            </td>
                            <td>
                                <select class="form-control">
                                    <option selected>Active</option>
                                </select>
                            </td>
                            <td>
                                <input class="form-control" value="250">
                            </td>
                            <td>
                                <input class="form-control" value="KG">
                            </td>
                            <td>
                                <input class="form-control" value="25">
                            </td>
                            <td>
                                <select class="form-control">
                                    <option selected>No</option>
                                </select>
                            </td>
                            <td class="text-center">
                                <button class="btn btn-outline-danger btn-sm">
                                    ×
                                </button>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <select class="form-control">
                                    <option selected>Stabilizer</option>
                                </select>
                            </td>
                            <td>
                                <select class="form-control">
                                    <option selected>Additive</option>
                                </select>
                            </td>
                            <td>
                                <input class="form-control" value="350">
                            </td>
                            <td>
                                <input class="form-control" value="KG">
                            </td>
                            <td>
                                <input class="form-control" value="35">
                            </td>
                            <td>
                                <select class="form-control">
                                    <option selected>No</option>
                                </select>
                            </td>
                            <td class="text-center">
                                <button class="btn btn-outline-danger btn-sm">
                                    ×
                                </button>
                            </td>
                        </tr>

                        </tbody>

                        <tfoot class="table-light">
                        <tr>
                            <th colspan="4" class="text-end">
                                Total
                            </th>
                            <th>100%</th>
                            <th colspan="2"></th>
                        </tr>
                        </tfoot>

                    </table>

                </div>

            </div>

        </div>

        <!-- Final Formula Summary -->

        <div class="card border">

            <div class="card-header bg-light">
                <h6 class="mb-0">
                    Final Formula Composition
                </h6>
            </div>

            <div class="card-body p-0">

                <table class="table table-bordered mb-0">

                    <thead class="table-light">

                    <tr>
                        <th>Component</th>
                        <th width="20%">Type</th>
                        <th width="20%">Contribution %</th>
                    </tr>

                    </thead>

                    <tbody>

                    <tr>
                        <td>Compound A</td>
                        <td>Secret Compound</td>
                        <td>60%</td>
                    </tr>

                    <tr>
                        <td>Compound B</td>
                        <td>Base Blend</td>
                        <td>35%</td>
                    </tr>

                    <tr>
                        <td>Lemon Fragrance</td>
                        <td>Direct Ingredient</td>
                        <td>5%</td>
                    </tr>

                    </tbody>

                    <tfoot class="table-light">

                    <tr>
                        <th colspan="2" class="text-end">
                            Grand Total
                        </th>
                        <th>
                            100%
                        </th>
                    </tr>

                    </tfoot>

                </table>

            </div>

        </div>

    </div>

</div>

<script>
    $(document).ready(function () {

    $(document).on('click', '.btn-primary', function () {

        let compound = `
        <div class="card border mb-4 compound-card">

            <div class="card-header bg-white">

                <div class="row align-items-center">

                    <div class="col-md-3">
                        <label class="small text-muted mb-1">Compound Name</label>
                        <input type="text" class="form-control" value="New Compound">
                    </div>

                    <div class="col-md-3">
                        <label class="small text-muted mb-1">Type</label>
                        <select class="form-control">
                            <option>Secret Compound</option>
                            <option selected>Base Blend</option>
                            <option>Active Blend</option>
                        </select>
                    </div>

                    <div class="col-md-2">
                        <label class="small text-muted mb-1">Visibility</label>
                        <select class="form-control">
                            <option>Open</option>
                            <option selected>Restricted</option>
                            <option>Confidential</option>
                        </select>
                    </div>

                    <div class="col-md-2">
                        <label class="small text-muted mb-1">Masking</label>
                        <select class="form-control">
                            <option>No</option>
                            <option selected>Yes</option>
                        </select>
                    </div>

                    <div class="col-md-2 text-end">
                        <label class="small d-block">&nbsp;</label>
                        <button class="btn btn-danger btn-sm removeCompound">
                            <i class="fa fa-trash"></i>
                        </button>
                    </div>

                </div>

            </div>

            <div class="card-body">

                <div class="d-flex justify-content-between align-items-center mb-2">

                    <h6 class="mb-0">Ingredients</h6>

                    <button class="btn btn-success btn-sm addIngredient">
                        <i class="fa fa-plus"></i>
                        Add Ingredient
                    </button>

                </div>

                <table class="table table-bordered ingredientTable">

                    <thead class="table-light">
                        <tr>
                            <th>Ingredient</th>
                            <th>Role</th>
                            <th>Qty</th>
                            <th>UOM</th>
                            <th>%</th>
                            <th>Visible</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>

                        <tr>

                            <td>
                                <input class="form-control" value="Raw Material">
                            </td>

                            <td>
                                <select class="form-control">
                                    <option selected>Base</option>
                                    <option>Active</option>
                                    <option>Additive</option>
                                </select>
                            </td>

                            <td>
                                <input class="form-control" value="100">
                            </td>

                            <td>
                                <input class="form-control" value="KG">
                            </td>

                            <td>
                                <input class="form-control" value="100">
                            </td>

                            <td>
                                <select class="form-control">
                                    <option selected>Yes</option>
                                    <option>No</option>
                                </select>
                            </td>

                            <td class="text-center">
                                <button class="btn btn-outline-danger btn-sm removeIngredient">
                                    ×
                                </button>
                            </td>

                        </tr>

                    </tbody>

                </table>

            </div>

        </div>`;

        $('.card-body > .card.border:last').before(compound);

    });


    $(document).on('click', '.removeCompound', function () {

        if ($('.compound-card').length > 1) {
            $(this).closest('.compound-card').remove();
        }

    });


    $(document).on('click', '.addIngredient', function () {

        let row = `
        <tr>

            <td>
                <input class="form-control" value="New Ingredient">
            </td>

            <td>
                <select class="form-control">
                    <option selected>Base</option>
                    <option>Active</option>
                    <option>Additive</option>
                </select>
            </td>

            <td>
                <input class="form-control" value="100">
            </td>

            <td>
                <input class="form-control" value="KG">
            </td>

            <td>
                <input class="form-control" value="10">
            </td>

            <td>
                <select class="form-control">
                    <option selected>Yes</option>
                    <option>No</option>
                </select>
            </td>

            <td class="text-center">
                <button class="btn btn-outline-danger btn-sm removeIngredient">
                    ×
                </button>
            </td>

        </tr>`;

        $(this)
            .closest('.card-body')
            .find('.ingredientTable tbody')
            .append(row);

    });

    $(document).on('click', '.removeIngredient', function () {

        let tbody = $(this).closest('tbody');

        if (tbody.find('tr').length > 1) {
            $(this).closest('tr').remove();
        }

    });

});
</script>