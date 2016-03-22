			
		<footer>
			<p>&copy; Учебный проект. Федор Юрков 2016г.</p>
		</footer>

	</div>

		<script src="/templates/js/jquery.js"></script>
		<script>
			$(document).ready(function(){
				$(".add-to-cart").click(function () {
					var id = $(this).attr("data-id");
					$.post("/cart/add/"+id, {}, function (data) {
						$("#cart-count").html(data);
					});
					return false;
				});
			});
		</script>
	</body>
</html>