$(document).ready(function () {
    "use strict";
    let baseURL = $("#hidden_base_url").val();
    $(document).on("change", ".image_preview", function () {
        let files = $(this)[0].files;
        let container = $(".image-preview-container");
        // Don't clear existing files - only add new ones

        $.each(files, function (index, file) {
            let reader = new FileReader();
            reader.onload = function (e) {
                let fileExtension = file.name.split(".").pop().toLowerCase();
                let fileId = 'new_file_' + Date.now() + '_' + index;
                let previewHtml = '';
                
                if (
                    fileExtension === "png" ||
                    fileExtension === "jpg" ||
                    fileExtension === "jpeg" ||
                    fileExtension === "gif"
                ) {
                    previewHtml = `
                        <div class="file-preview-item d-inline-block position-relative me-2 mb-2" data-filename="${file.name}" data-fileid="${fileId}">
                            <img src="${e.target.result}" alt="Image Preview ${index + 1}" class="img-thumbnail" width="100px">
                            <button type="button" class="btn btn-sm btn-danger remove-file-btn position-absolute" 
                                    style="top: -5px; right: -5px; padding: 2px 6px; border-radius: 50%; z-index: 10; width: 24px; height: 24px; line-height: 1;"
                                    data-filename="${file.name}" data-fileid="${fileId}" title="Remove">
                                <i class="fa fa-times" style="font-size: 12px;"></i>
                            </button>
                        </div>
                    `;
                } else if (fileExtension === "pdf") {
                    previewHtml = `
                        <div class="file-preview-item d-inline-block position-relative me-2 mb-2" data-filename="${file.name}" data-fileid="${fileId}">
                            <a class="text-decoration-none" href="${e.target.result}" target="_blank">
                                <img src="${baseURL}assets/images/pdf.png" alt="PDF Preview" class="img-thumbnail" width="100px">
                            </a>
                            <button type="button" class="btn btn-sm btn-danger remove-file-btn position-absolute" 
                                    style="top: -5px; right: -5px; padding: 2px 6px; border-radius: 50%; z-index: 10; width: 24px; height: 24px; line-height: 1;"
                                    data-filename="${file.name}" data-fileid="${fileId}" title="Remove">
                                <i class="fa fa-times" style="font-size: 12px;"></i>
                            </button>
                        </div>
                    `;
                } else if (fileExtension === "doc" || fileExtension === "docx") {
                    previewHtml = `
                        <div class="file-preview-item d-inline-block position-relative me-2 mb-2" data-filename="${file.name}" data-fileid="${fileId}">
                            <a class="text-decoration-none" href="${e.target.result}" target="_blank">
                                <img src="${baseURL}assets/images/word.png" alt="Word Preview" class="img-thumbnail" width="100px">
                            </a>
                            <button type="button" class="btn btn-sm btn-danger remove-file-btn position-absolute" 
                                    style="top: -5px; right: -5px; padding: 2px 6px; border-radius: 50%; z-index: 10; width: 24px; height: 24px; line-height: 1;"
                                    data-filename="${file.name}" data-fileid="${fileId}" title="Remove">
                                <i class="fa fa-times" style="font-size: 12px;"></i>
                            </button>
                        </div>
                    `;
                } else {
                    previewHtml = `<p>Unsupported file format.</p>`;
                }
                
                container.append(previewHtml);
            };
            reader.readAsDataURL(file);
        });
    });
});
