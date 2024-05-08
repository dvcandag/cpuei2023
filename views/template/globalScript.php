<script src="<?=URL?>public/assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
<script src="<?=URL?>public/assets/js/bootstrap.bundle.min.js"></script>
    
<script src="<?=URL?>public/assets/js/mazer.js"></script>
<script src="<?=URL?>public/assets/vendors/jquery/jquery.min.js"></script>
<script src="<?=URL?>public/lobibox/lobibox.min.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		base_url = "<?php echo URL; ?>";
		$(document).on('click', '#CloseSession', function() {
			$.ajax({
				url: base_url+'login/cerrarSession',
				type: 'POST',
				dataType: 'JSON',
				data: {estado: true},
			})
			.done(function(data) {
				if (data.status) {
					window.location = "login/index";
				}
			})
			.fail(function() {
				console.log("error");
			});
			
		});
	});
</script>
