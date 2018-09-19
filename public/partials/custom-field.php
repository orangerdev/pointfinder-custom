<div class="pfsubmit-title pfsubmit-inner-sub-image">STORES &amp; SERVICES</div>
<section class="pfsubmit-inner pfitemimgcontainer pferrorcontainer pfsubmit-inner-sub-image">
    <div class="pfuploadedimages"></div>
    <section class="pfsubmit-inner-sub">
        <div id="pfdropzoneupload-location" class="dropzone">
            <div class="dz-default dz-message">
                <span>
                    Drop files here to upload!
                    <br>You can add up to
                    <div class="pfuploaddrzonenum">10</div>
                    image(s) (Max. File Size: 2MB per image)
                </span>
            </div>
        </div>
        <input type="hidden" class="pfuploadimagesrc-loc" name="pfuploadimagesrc-loc" id="pfuploadimagesrc-loc" />
        <a id="pf-ajax-fileuploadformopen-loc" class="button pfmyitempagebuttonsex dz-clickable" style="width:100%">
            <i class="pfadmicon-glyph-512"></i> Click to select photos
        </a>
    </section>
</section>
<script type="text/javascript">
(function($) {
"use strict";
	$(function(){
		$.drzoneuploadlimit = 10;
		var myDropzone_location = new Dropzone("div#pfdropzoneupload-location", {
			url: theme_scriptspf.ajaxurl,
			params: {
		      action: "pfget_imageupload",
		      security: "<?php echo wp_create_nonce('pfget_imageupload'); ?>",

		    },
			autoProcessQueue: true,
			acceptedFiles:"image/*",
			maxFilesize: 2,
			maxFiles: $.drzoneuploadlimit,
			parallelUploads:1,
			uploadMultiple: false,
			addRemoveLinks:true,
			dictDefaultMessage: "Drop files here to upload!<br/>You can add up to <div class='pfuploaddrzonenum'>{0}</div> image(s) (Max. File Size: 2MB per image) ".format($.drzoneuploadlimit),
			dictFallbackMessage: "Your browser does not support drag and drop file upload",
			dictInvalidFileType: "Unsupported file type",
			dictFileTooBig: "File size is too big. (Max file size: 2mb)",
			dictCancelUpload: "",
			dictRemoveFile: "Remove",
			dictMaxFilesExceeded: "Max file exceeded",
			clickable: "#pf-ajax-fileuploadformopen-loc"
		});

		Dropzone.autoDiscover = false;

		var uploadeditems = new Array();

		myDropzone_location.on("success", function(file,responseText) {
			var obj = [];
			$.each(responseText, function(index, element) {
				obj[index] = element;
			});

			if (obj.process == "up" && obj.id.length != 0) {
				file._removeLink.id = obj.id;
				uploadeditems.push(obj.id);
				$("#pfuploadimagesrc-loc").val(uploadeditems);
			}

		});

		myDropzone_location.on("totaluploadprogress",function(uploadProgress,totalBytes,totalBytesSent){

			if (uploadProgress > 0 ) {
				$("#pf-ajax-uploaditem-button").val("Please Wait for Image Upload...");
				$("#pf-ajax-uploaditem-button").attr("disabled", true);
			}
			if(totalBytes == 0) {
				$("#pf-ajax-uploaditem-button").attr("disabled", false);
				$("#pf-ajax-uploaditem-button").val("Submit Shop");
			}
		});

		myDropzone_location.on("removedfile", function(file) {
		    if (file.upload.progress != 0) {
				if(file._removeLink.id.length != 0){
					var removeditem = file._removeLink.id;
					removeditem.replace('"', "");
					$.ajax({
					    type: "POST",
					    dataType: "json",
					    url: theme_scriptspf.ajaxurl,
					    data: {
					        action: "pfget_imageupload",
			      			security: "1b7a5e7fa8",
			      			iid:removeditem
					    }
					});
					for(var i = uploadeditems.length; i--;) {
				          if(uploadeditems[i] == removeditem) {
				              uploadeditems.splice(i, 1);
				          }
				      }

					$("#pfuploadimagesrc-loc").val(uploadeditems);

					$("#pf-ajax-uploaditem-button").attr("disabled", false);
					$("#pf-ajax-uploaditem-button").val("Submit Shop");
				}
		    }
		});


		myDropzone_location.on("queuecomplete",function(file){
			$("#pf-ajax-uploaditem-button").attr("disabled", false);
			$("#pf-ajax-uploaditem-button").val("Submit Shop");
		});

	});

})(jQuery);
</script>
