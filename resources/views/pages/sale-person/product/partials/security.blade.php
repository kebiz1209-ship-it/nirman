<!-- =========================================
     SECURITY & PERMISSIONS
========================================= -->

<div class="card mt-3">
    <div class="card-body">

        <!-- Confidentiality Level -->
        <div class="border rounded p-3 mb-4">
            <h6 class="font-weight-bold mb-3">Confidentiality Level</h6>

            <div class="checkbox-grid">

                <div class="checkbox-box">
                    <input type="radio"
                           name="confidentiality_level"
                           id="open"
                           value="Open"
                           checked>
                    <label for="open">Open</label>
                </div>

                <div class="checkbox-box">
                    <input type="radio"
                           name="confidentiality_level"
                           id="restricted"
                           value="Restricted">
                    <label for="restricted">Restricted</label>
                </div>

                <div class="checkbox-box">
                    <input type="radio"
                           name="confidentiality_level"
                           id="confidential"
                           value="Confidential">
                    <label for="confidential">Confidential</label>
                </div>

                <div class="checkbox-box">
                    <input type="radio"
                           name="confidentiality_level"
                           id="trade_secret"
                           value="Trade Secret">
                    <label for="trade_secret">Trade Secret</label>
                </div>

            </div>
        </div>

        <!-- Formula Masking -->
        <div class="border rounded p-3 mb-4">
            <h6 class="font-weight-bold mb-3">Formula Masking Enabled</h6>

            <div class="checkbox-grid">

                <div class="checkbox-box">
                    <input type="radio"
                           name="formula_masking"
                           id="masking_yes"
                           value="Yes">
                    <label for="masking_yes">Yes</label>
                </div>

                <div class="checkbox-box">
                    <input type="radio"
                           name="formula_masking"
                           id="masking_no"
                           value="No"
                           checked>
                    <label for="masking_no">No</label>
                </div>

            </div>
        </div>

        <!-- Allowed Roles -->
        <div class="border rounded p-3 mb-4">
            <h6 class="font-weight-bold mb-3">Allowed Roles</h6>

            <div class="checkbox-grid">

                <div class="checkbox-box">
                    <input type="checkbox"
                           name="allowed_roles[]"
                           id="director"
                           value="Director"
                           checked>
                    <label for="director">Director</label>
                </div>

                <div class="checkbox-box">
                    <input type="checkbox"
                           name="allowed_roles[]"
                           id="rnd_head"
                           value="R&D Head"
                           checked>
                    <label for="rnd_head">R&D Head</label>
                </div>

                <div class="checkbox-box">
                    <input type="checkbox"
                           name="allowed_roles[]"
                           id="production_manager"
                           value="Production Manager"
                           checked>
                    <label for="production_manager">Production Manager</label>
                </div>

                <div class="checkbox-box">
                    <input type="checkbox"
                           name="allowed_roles[]"
                           id="qa_manager"
                           value="QA Manager"
                           checked>
                    <label for="qa_manager">QA Manager</label>
                </div>

                <div class="checkbox-box">
                    <input type="checkbox"
                           name="allowed_roles[]"
                           id="sales_team"
                           value="Sales Team">
                    <label for="sales_team">Sales Team</label>
                </div>

                <div class="checkbox-box">
                    <input type="checkbox"
                           name="allowed_roles[]"
                           id="operator"
                           value="Operator">
                    <label for="operator">Operator</label>
                </div>

            </div>
        </div>

        <!-- Permissions -->
        <div class="border rounded p-3">
            <h6 class="font-weight-bold mb-3">Permissions</h6>

            <div class="checkbox-grid">

                <div class="checkbox-box">
                    <input type="checkbox"
                           name="permissions[]"
                           id="view_formula"
                           value="View Formula"
                           checked>
                    <label for="view_formula">View Formula</label>
                </div>

                <div class="checkbox-box">
                    <input type="checkbox"
                           name="permissions[]"
                           id="edit_formula"
                           value="Edit Formula">
                    <label for="edit_formula">Edit Formula</label>
                </div>

                <div class="checkbox-box">
                    <input type="checkbox"
                           name="permissions[]"
                           id="approve_formula"
                           value="Approve Formula">
                    <label for="approve_formula">Approve Formula</label>
                </div>

                <div class="checkbox-box">
                    <input type="checkbox"
                           name="permissions[]"
                           id="print_formula"
                           value="Print Formula">
                    <label for="print_formula">Print Formula</label>
                </div>

                <div class="checkbox-box">
                    <input type="checkbox"
                           name="permissions[]"
                           id="export_formula"
                           value="Export Formula">
                    <label for="export_formula">Export Formula</label>
                </div>

            </div>
        </div>

    </div>
</div>