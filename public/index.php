<?php // Version : 1.0 ?>
<?php
include("views/header.php"); 
include("views/nav.php"); 
?>
<div class="container">

	<table class="table table-condensed" style="font-size:10pt;">
		<thead>
			<tr>
				<th>Server</th>
				<th style="text-align:center">Ports</th>
				<th>Tasks</th>
				<th>SVN</th>
				<th>Database</th>
				<th>DB Loaded</th>
				<th>Change DB</th>
				<th>Clear Logs</th>
				<th>Clear Cache</th>

			</tr>
		</thead>
		<tbody>
			<?php foreach ($apache_data as $config) : ?>
			<tr>
				<td><div class="label label-default label-sm clickable" style="margin:-5px 5px 0 0" data-toggle="collapse" id="2" data-target=".<?php echo $config['Name']; ?>"><span class="chevron_toggleable glyphicon glyphicon-chevron-down"></span></div><?php echo ucfirst($config['Name']); ?></td>
				<td style="text-align:center">
					<?php foreach ($config['Ports'] as $port => $status) : ?>
						<?php ($status == 1) ? $label = 'success' : $label = 'danger'; ?>
						<span class="label label-<?php echo $label; ?>"><?php echo $port; ?></span>
					<?php endforeach; ?>
				</td>
				<td>T07050</td>
				<td>/trunk</td>
				<td><?php echo ($config['Database']['database']) ? $config['Database']['database'] : 'No DB Selected' ; ?></td>
				<td>Jan 10 2017</td>
				<td>
					<div class="input-group">
						<form action="/action.php" method="post">
							<input type="hidden" name="action" value="change_database" />
							<input type="hidden" name="args[virtualhost]" value="<?php echo $config['Name']; ?>" />
							<div class="input-group">
								<select class="form-control input-sm" name="args[database]" id="select_<?php echo $config['Name']; ?>">
									<option>No Database</option>
									<?php foreach($databases as $database) : ?>
										<?php ($config['Database']['database'] == $database) ? $active = 'selected value' : $active = ''; ?>
										<?php ($config['Database']['database'] == $database) ? $disabled = ' disabled ' : $disabled = ''; ?>
										<option value="<?php echo $database; ?>"<?php echo $disabled . $active;?>><?php echo $database; ?></option>
									<?php endforeach; ?>
								</select>
								<span class="input-group-btn">
									<input type="submit" value="Submit" class="btn btn-warning btn-sm">Change DB</input>
								</span>
							</div>
						</form>
					</div>
				</td>
				<td>
					<form action="/action.php" method="post">
						<input type="hidden" name="action" value="clear_cache" />
						<input type="hidden" name="args[virtualhost]" value="<?php echo $config['Name']; ?>" />
						<input type="submit" value="Clear Cache" class="btn btn-primary btn-sm"></input>
					</form>
				</td>
				<td>
					<form action="/action.php" method="post">
						<input type="hidden" name="action" value="clear_logs" />
						<input type="hidden" name="args[virtualhost]" value="<?php echo $config['Name']; ?>" />
						<input type="submit" value="Clear Logs" class="btn btn-primary btn-sm"></input>
					</form>
				</td>

			</tr>
			<tr id="serverInfo" class="collapse out <?php echo $config['Name']; ?>">
				<td colspan="8">
					<h5>Server 1</h5>
					<div class="">
						<?php echo '<pre>'; ?>
						<?php print_r($config);?>
						<?php echo '</pre>'; ?>
					</div>
					<button class="btn btn-danger btn-sm">X Delete</button>
				</td>
			</tr>
		<?php endforeach; ?>
		</tbody>
	</table>
	<hr>
	<?php include("views/index-modal.php"); ?>	
	<?php include("views/footer.php"); ?>