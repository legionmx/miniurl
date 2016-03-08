<?php
/*** footer.php -- Contains all the content that should be displayed at the top of each page ***
*/
?>

	<footer class="footer">
      <div class="container">
        <p class="text-muted">Nemo pervenit qui non legitimat certaverit</p>
      </div>
    </footer>

	<!-- JQuery and Bootstrap-->
	<script src="//code.jquery.com/jquery-1.12.0.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
	<!-- Own scripts -->
	<?php
	if(isset($ownFinalScripts)){
		foreach ($ownFinalScripts as $finalScript) {
	?>
			<script type="text/javascript" src="<?php echo $finalScript;?>"></script>
	<?php
		}
	}
	?>
	<!-- Other scripts--> 
	<script type="text/javascript" src="/js/jquery.bxslider.min.js"></script>
	<script src="/js/owl.carousel.min.js"></script>
</body>
</html>