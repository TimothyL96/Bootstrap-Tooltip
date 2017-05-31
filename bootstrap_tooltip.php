<script>
	$(function ()
	{
		$('[data-toggle="tooltip"]').tooltip();

		$("#txtremark").keyup(function ()
		{
			$("#txtremark").val() != "";
			setTimeout(function ()
			{
				$("#txtremark").tooltip('hide');
			}, 1500);
		});
		
		$('#txtremark').on('blur', function ()
		{
			setTimeout(function (){
				if ($("#txtremark").attr('aria-describedby'))
					$("#txtremark").tooltip('hide');
			}, 500);
		});
		
		$('#submitBtn').on('mousedown', function (e)
		{
			e.preventDefault();
		});
		
		$('#submitBtn').on('click', function ()
		{
			if ($("#txtremark").val() === "")
			{
				if (!$("#txtremark").attr('aria-describedby'))
					$("#txtremark").tooltip('show');
				$("#txtremark").focus();
				return false;
			}
			var $btn = $(this).button('loading');
			$("#cancelBtn").prop('disabled', true);
			// business logic...
			$.ajax({
				url: "product_addremark.php",
				method: "POST",
				data: {
					remark: $("#txtremark").val(),
					productID: $("#product").val(),
					supplier: $("#supplier").val()
				}
			})
				.done(function(data)
				{
					if (data == true)
					{
						setTimeout(
							function ()
							{
								$('#submitBtn').text('E-mail sent');
							}, 2000
						);
						setTimeout(
							function ()
							{
								$('#editGroupNameModal').modal('hide');
								$("#txtremark").val("");
								$('#submitBtn').button('reset');
								$('#cancelBtn').prop('disabled', false);
							}, 5000
						);
					}
					if (data == false)
					{
						alert("ERROR. Code 0x00012.");
						$('#submitBtn').button('reset');
						$('#cancelBtn').prop('disabled', false);
					}
				});
		})
	})
</script>