		</div>
	</div>
	<div class="clear"></div>
</div>
<script src="des/msc-script.js"></script>
<script src="des/home.js"></script>
<?php if (isset($_SESSION['alert'])) {
		echo $_SESSION['alert'];
		unset($_SESSION['alert']);
} ?>
</body>
</html>