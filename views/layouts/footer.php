</div>
<script src="/template/js/functions.js"></script>
<script>
	$("select#sorting").change(function() {
		var option = $(this).find('option:selected');
		window.location.href = option.data("url");
	});
</script>
</body>
</html>