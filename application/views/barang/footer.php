    </div>
    
    <script type="text/javascript" src="<?php echo base_url('assets/jquery/jquery-2.1.4.min.js') ?>"></script>
	<script src="<?php echo base_url(); ?>/assets/bootstrap/js/bootstrap.min.js"></script>
	<script src="<?php echo base_url(); ?>/assets/jquery/jquery-2.1.4.min.js"></script>
	<script type="text/javascript" charset="utf8" src="<?php echo base_url(); ?>/assets/DataTables/datatables.js"></script>
	<script type="text/javascript" charset="utf8" src="<?php echo base_url(); ?>/assets/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
	
	<script>
		$(document).ready( function () {
			$('#dataTables').DataTable();
		} );

		$('#datepicker1').datepicker({});
		$('#datepicker2').datepicker({});
	</script>
</body>
</html>
