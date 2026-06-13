<!-- <div class="card mt-3"> -->
    <div class="card-body">

        <!-- Formula Basic Details -->
        <div class="border rounded p-3 mb-4">
            <h6 class="font-weight-bold mb-3">Formula Basic Details</h6>

            <div class="row">

                <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12">
                    <div class="form-group mb-0">
                        <label>Formula Code *</label>
                        <input type="text"
                               name="formula_code"
                               class="form-control"
                               required>
                    </div>
                </div>

                <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12">
                    <div class="form-group mb-0">
                        <label>Formula Name *</label>
                        <input type="text"
                               name="formula_name"
                               class="form-control"
                               required>
                    </div>
                </div>

                <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12">
                    <div class="form-group mb-0">
                        <label>Formula Version</label>
                        <input type="text"
                               name="formula_version"
                               class="form-control"
                               placeholder="e.g. V1.0">
                    </div>
                </div>

            </div>
        </div>

        <!-- Approval Status -->
        <div class="border rounded p-3 mb-4">
            <h6 class="font-weight-bold mb-3">Approval Status</h6>

            <div class="checkbox-grid">

                <div class="checkbox-box">
                    <input type="radio"
                           name="approval_status"
                           id="draft"
                           value="Draft"
                           checked>
                    <label for="draft">Draft</label>
                </div>

                <div class="checkbox-box">
                    <input type="radio"
                           name="approval_status"
                           id="review"
                           value="Review">
                    <label for="review">Review</label>
                </div>

                <div class="checkbox-box">
                    <input type="radio"
                           name="approval_status"
                           id="approved"
                           value="Approved">
                    <label for="approved">Approved</label>
                </div>

                <div class="checkbox-box">
                    <input type="radio"
                           name="approval_status"
                           id="rejected"
                           value="Rejected">
                    <label for="rejected">Rejected</label>
                </div>
                <div class="checkbox-box">
                    <input type="radio"
                           name="approval_status"
                           id="ipbased"
                           value="IP Based">
                    <label for="ipbased">IP Based</label>
                </div>

            </div>
        </div>

        <!-- Effective Dates -->
        <div class="border rounded p-3 mb-4">
            <h6 class="font-weight-bold mb-3">Effective Dates</h6>

            <div class="row">

                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                    <div class="form-group mb-0">
                        <label>Effective From</label>
                        <input type="date"
                               name="effective_from"
                               class="form-control">
                    </div>
                </div>

                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                    <div class="form-group mb-0">
                        <label>Effective To</label>
                        <input type="date"
                               name="effective_to"
                               class="form-control">
                    </div>
                </div>

            </div>
        </div>

        <!-- Formula Type -->
        <div class="border rounded p-3 mb-4">
            <h6 class="font-weight-bold mb-3">Formula Type</h6>

            <div class="checkbox-grid">

                <div class="checkbox-box">
                    <input type="radio"
                           name="formula_type"
                           id="standard_formula"
                           value="Standard"
                           checked>
                    <label for="standard_formula">Standard</label>
                </div>

                <div class="checkbox-box">
                    <input type="radio"
                           name="formula_type"
                           id="client_formula"
                           value="Client Formula">
                    <label for="client_formula">Client Formula</label>
                </div>

                <div class="checkbox-box">
                    <input type="radio"
                           name="formula_type"
                           id="customized_formula"
                           value="Customized">
                    <label for="customized_formula">Customized</label>
                </div>

            </div>
        </div>

        <!-- Confidentiality Level -->
        <div class="border rounded p-3 mb-4">
            <h6 class="font-weight-bold mb-3">Confidentiality Level</h6>

            <div class="checkbox-grid">

                <div class="checkbox-box">
                    <input type="radio"
                           name="confidentiality_level"
                           id="open_level"
                           value="Open"
                           checked>
                    <label for="open_level">Open</label>
                </div>

                <div class="checkbox-box">
                    <input type="radio"
                           name="confidentiality_level"
                           id="restricted_level"
                           value="Restricted">
                    <label for="restricted_level">Restricted</label>
                </div>

                <div class="checkbox-box">
                    <input type="radio"
                           name="confidentiality_level"
                           id="confidential_level"
                           value="Confidential">
                    <label for="confidential_level">Confidential</label>
                </div>

                <div class="checkbox-box">
                    <input type="radio"
                           name="confidentiality_level"
                           id="trade_secret_level"
                           value="Trade Secret">
                    <label for="trade_secret_level">Trade Secret</label>
                </div>

            </div>
        </div>

        <!-- Formula Masking -->
        <div class="border rounded p-3 mb-4">
            <h6 class="font-weight-bold mb-3">Formula Masking Enabled</h6>

            <div class="checkbox-grid">

                <div class="checkbox-box">
                    <input type="radio"
                           name="formula_masking_enabled"
                           id="masking_yes"
                           value="Yes">
                    <label for="masking_yes">Yes</label>
                </div>

                <div class="checkbox-box">
                    <input type="radio"
                           name="formula_masking_enabled"
                           id="masking_no"
                           value="No"
                           checked>
                    <label for="masking_no">No</label>
                </div>

            </div>
        </div>

        <!-- Action Buttons -->
        <div class="border rounded p-3">
            <h6 class="font-weight-bold mb-3">Formula Actions</h6>

            <div class="d-flex flex-wrap">

                <button type="button"
                        class="btn btn-primary mr-2 mb-2"
                        id="addFormulaVersion">
                    Add Formula Version
                </button>

                <button type="button"
                        class="btn btn-warning mr-2 mb-2"
                        id="cloneFormula">
                    Clone Formula
                </button>

                <button type="button"
                        class="btn btn-info mb-2"
                        id="compareVersions">
                    Compare Versions
                </button>

            </div>
        </div>

    </div>
<!-- </div> -->