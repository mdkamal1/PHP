<html>
<head>
	<link rel="stylesheet" href="style.css">

</head>
<body>
	<div class="container">
		<div class="calendar">
			<?php 
				$days=['Su','Mo','Tu','We','Th','Fr','Sa'];
				$months = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];
				$sel_month=date("M");
				$sel_year=date("Y");

				if(isset($_POST['submit'])){
					$sel_month=$_POST['month'];
					$sel_year=$_POST['year'];
				}

				$selected_month= $sel_year."-".$sel_month;
			?>
			<div class="today"><a href=""><?php echo date('l,F d,Y');?></a></div>
			<div class="month-name">
				<form action="" method="POST">
					<select name="month">
						<?php foreach ($months as $month) { ?>
							<option value="<?php echo $month; ?>" <?php if($month==$sel_month){echo 'selected';} ?>>
								<?php echo $month; ?>
							</option>
						<?php } ?>
					</select>
					<select name="year">
						<?php for( $y=2018;$y > 1970 ;$y-- ) { ?>
							<option value="<?php echo $y; ?>" <?php if($y==$sel_year){echo 'selected';} ?>>
								<?php echo $y; ?>
							</option>
						<?php } ?>
					</select>
					<input type="submit" name="submit" value="Go">
				</form>
			</div>
			<div class="month">		
				<div class="month-day"><?php foreach ($days as $day)  
					{  ?>
					<div class="date"><?php echo $day;?></div>
				<?php } ?>				
				<div class="month-date">
					<?php for ($i=0; $i < date("w",strtotime($selected_month."-01")); $i++) 
						{  ?>
						<div class="date"> </div>
					<?php }
						for ($i=1; $i <= date('t',strtotime($selected_month)) ; $i++) 
						{  ?>
						<div class="date <?php if(($i==date('d')) && ($selected_month==date('Y-M'))){echo 'active';}?>">
							<?php echo $i;?>
						</div>
					<?php } ?>
				</div>
			</div>
		</div>	
	</div>
</body>
</html>
