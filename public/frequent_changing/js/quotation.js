$(document).ready(function () {
    "use strict";
    let inputField = $("#button_click_type");
    let baseUrl = $("#hidden_base_url").val();
    let removedFiles = [];
    
    $(document).on("click", ".print_invoice", function () {
        viewChallan($(this).attr("data-id"));
    });

    function viewChallan(id) {
        open(
            baseUrl + "print-quotation/" + id,
            "Print Quotation",
            "width=1600,height=550"
        );
        newWindow.focus();
        newWindow.onload = function () {
            newWindow.document.body.insertAdjacentHTML("afterbegin");
        };
    }
    $(document).on("click", "#download_btn", function(){
        inputField.val('download');
        $(this).attr('type', 'submit');
        $(this).click();
    });

    $(document).on("click", "#email_btn", function () {
        inputField.val("email");
        $(this).attr("type", "submit");
        $(this).click();
    });

    $(document).on("click", "#print_btn", function () {
        inputField.val("print");
        $(this).attr("type", "submit");
        $(this).click();
    });

    // Handle remove file button click
    $(document).on('click', '.remove-file-btn', function(e) {
        e.preventDefault();
        e.stopPropagation();
        
        let fileName = $(this).data('filename');
        let fileId = $(this).data('fileid');
        let filePreviewItem = $(this).closest('.file-preview-item');
        let fileInput = $('#file_button')[0];
        
        // Check if it's an existing file from database (no fileId or fileId doesn't start with 'new_file_')
        if (!fileId || !fileId.startsWith('new_file_')) {
            // It's an existing file from database - track for server-side removal
            if (fileName && removedFiles.indexOf(fileName) === -1) {
                removedFiles.push(fileName);
            }
            // Update hidden input for existing files
            $('#removed_files').val(removedFiles.join(','));
        } else {
            // It's a newly selected file - remove from file input
            if (fileInput && fileInput.files && fileInput.files.length > 0) {
                let dt = new DataTransfer();
                let files = Array.from(fileInput.files);
                
                // Remove the file that matches (we'll clear all new files for simplicity)
                // Since we can't directly match by fileId, we'll clear the input
                // when a new file preview is removed
                fileInput.value = '';
            }
        }
        
        // Remove the preview element
        filePreviewItem.fadeOut(300, function() {
            $(this).remove();
            
            // Check if all previews are removed, then clear file input
            let remainingPreviews = $('.file-preview-item').length;
            if (remainingPreviews === 0 && fileInput) {
                fileInput.value = '';
            }
        });
    });
});
