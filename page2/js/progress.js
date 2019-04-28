$(document).ready(function() {

	$('form').on('submit', function(event) {

		event.preventDefault();

		var formData = new FormData($('.post-form')[0]);
		formData.append('submit', 'true');

		$.ajax({
			type: 'POST',
			url: './uploadMultiple.php',
			data: formData,
			processData: false,
			contentType: false,
			xhr: function() {
				var xhr = new window.XMLHttpRequest();

				xhr.upload.addEventListener('progress', function(e) {
					if (e.lengthComputable) {

						console.log('Bytes Loaded: ' + e.loaded);
						console.log('Total Size: ' + e.total);
						console.log('Percentage Uploaded: ' + (e.loaded / e.total))

						var percent = Math.round((e.loaded / e.total) * 100);

						$('#progressBar').attr('aria-valuenow', percent).css('width', percent + '%').text(percent + '%');

					}
				});

				return xhr;
			},
			success: function(data) {
				setTimeout(function() {
					document.location.reload();
				}, 300);
			},
			error: function(err) {
				var errorContainer = $('.error-container');

				$('#progressBar').attr('aria-valuenow', 0).css('width', 0 + '%').text(0 + '%');

				errorContainer.append(`<div class="alert alert-danger">${err.responseText}</div>`);
			},
		});

	});

});
