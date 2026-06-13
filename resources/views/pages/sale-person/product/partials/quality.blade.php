<!-- =========================================
     PRODUCT SPECIFICATIONS
========================================= -->


<style>
.custom-row {
    display: flex;
    flex-wrap: wrap;
    margin-left: -5px;
    margin-right: -5px;
}

.col-5-custom {
    width: 20%;
    padding: 0 5px;
    box-sizing: border-box;
}

@media (max-width: 992px) {
    .col-5-custom {
        width: 33.33%;
    }
}

@media (max-width: 768px) {
    .col-5-custom {
        width: 50%;
    }
}

@media (max-width: 576px) {
    .col-5-custom {
        width: 100%;
    }
}
</style>

<!-- <div class="card mt-3"> -->
    <div class="card-body">

        <!-- BASIC SPECIFICATIONS -->
        <div class="border rounded p-3 mb-4">
            <h6 class="font-weight-bold mb-3">Physical & Chemical Specifications</h6>

            <div class="custom-row">

                <div class="col-5-custom">
                    <div class="form-group">
                        <label>Appearance</label>
                        <input type="text"
                               name="appearance"
                               class="form-control"
                               placeholder="e.g. Liquid, Powder">
                    </div>
                </div>

                <div class="col-5-custom">
                    <div class="form-group">
                        <label>Color</label>
                        <input type="text"
                               name="color"
                               class="form-control">
                    </div>
                </div>

                <div class="col-5-custom">
                    <div class="form-group">
                        <label>Odor</label>
                        <input type="text"
                               name="odor"
                               class="form-control">
                    </div>
                </div>

                <div class="col-5-custom">
                    <div class="form-group">
                        <label>pH Range</label>
                        <input type="text"
                               name="ph_range"
                               class="form-control"
                               placeholder="e.g. 5.5 - 7.0">
                    </div>
                </div>

                 <div class="col-5-custom">
                    <div class="form-group">
                        <label>Viscosity</label>
                        <input type="text"
                               name="viscosity"
                               class="form-control">
                    </div>
                </div>

            </div>

            <div class="custom-row">


                <div class="col-5-custom">
                    <div class="form-group">
                        <label>Density</label>
                        <input type="text"
                               name="density"
                               class="form-control">
                    </div>
                </div>


                <div class="col-5-custom">
                    <div class="form-group">
                        <label>Moisture (%)</label>
                        <input type="number"
                               step="0.01"
                               name="moisture_percent"
                               class="form-control">
                    </div>
                </div>

                <div class="col-5-custom">
                    <div class="form-group">
                        <label>Shelf Life</label>
                        <input type="text"
                               name="shelf_life"
                               class="form-control"
                               placeholder="e.g. 24 Months">
                    </div>
                </div>

                <div class="col-5-custom">
                    <div class="form-group">
                        <label>Storage Condition</label>
                        <input type="text"
                               name="storage_condition"
                               class="form-control"
                               placeholder="e.g. Store in cool & dry place">
                    </div>
                </div>




            </div>

           

        </div>

        <!-- QUALITY TESTS -->
        <div class="border rounded p-3">

            <h6 class="font-weight-bold mb-3">Quality Tests</h6>

            <div class="checkbox-grid">

                <div class="checkbox-box">
                    <input type="checkbox"
                           name="quality_tests[]"
                           id="appearance_test"
                           value="Appearance">
                    <label for="appearance_test">Appearance</label>
                </div>

                <div class="checkbox-box">
                    <input type="checkbox"
                           name="quality_tests[]"
                           id="assay_test"
                           value="Assay">
                    <label for="assay_test">Assay</label>
                </div>

                <div class="checkbox-box">
                    <input type="checkbox"
                           name="quality_tests[]"
                           id="microbiology_test"
                           value="Microbiology">
                    <label for="microbiology_test">Microbiology</label>
                </div>

                <div class="checkbox-box">
                    <input type="checkbox"
                           name="quality_tests[]"
                           id="stability_test"
                           value="Stability">
                    <label for="stability_test">Stability</label>
                </div>

                <div class="checkbox-box">
                    <input type="checkbox"
                           name="quality_tests[]"
                           id="density_test"
                           value="Density">
                    <label for="density_test">Density</label>
                </div>
                <div class="checkbox-box">
                    <input type="checkbox"
                           name="quality_tests[]"
                           id="third_party_qc"
                           value="third_party_qc">
                    <label for="third_party_qc  ">3rd party QC</label>
                </div>

            </div>

        </div>

    </div>
<!-- </div> -->