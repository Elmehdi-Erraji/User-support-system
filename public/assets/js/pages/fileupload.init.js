(function($) {
    "use strict";

    function FileUpload() {
        this.$body = $('body');
    }

    FileUpload.prototype.init = function() {
        Dropzone.autoDiscover = false;

        $('[data-plugin="dropzone"]').each(function() {
            var $this = $(this),
                url = $this.attr("action"),
                previewsContainer = $this.data("previewsContainer"),
                options = {
                    url: url
                };

            if (previewsContainer) {
                options.previewsContainer = previewsContainer;
            }

            var uploadPreviewTemplate = $this.data("uploadPreviewTemplate");
            if (uploadPreviewTemplate) {
                options.previewTemplate = $(uploadPreviewTemplate).html();
            }

            $this.dropzone(options);
        });
    }

    // Check if jQuery is defined before assigning FileUpload
    if (typeof $ !== 'undefined') {
        $.FileUpload = new FileUpload();
        $.FileUpload.Constructor = FileUpload;

        $(function() {
            $.FileUpload.init();
        });
    } else {
        console.error("jQuery is not defined. Make sure it is properly included before this script.");
    }

})(window.jQuery);
