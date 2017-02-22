<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div id="datepicker">
	
</div>
<script>
$( "#datepicker" ).datepicker({
    numberOfMonths: 12,
    minDate: new Date(2017, 1 -1, 1),
    maxDate: new Date(2017, 12 -1, 31),
    showButtonPanel: true
});
</script>