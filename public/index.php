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
				<th>DB Loaded</th>
				<th>Database</th>
				<th colspan="2">Clear</th>

			</tr>
		</thead>
		<tbody>
			<?php foreach ($apache_data as $config) : ?>
			<tr>
				<td id="hostname">
					<button tylpe="button" class="btn btn-default btn-xs" style="margin:-5px 5px 0 0" data-toggle="collapse" id="2" data-target=".<?php echo $config['Name']; ?>">
						<span class="chevron_toggleable glyphicon glyphicon-cog"></span>
					</button>
					<button tylpe="button" class="btn btn-default btn-xs" style="margin:-5px 5px 0 0" data-toggle="collapse" id="2" data-target=".<?php echo $config['Name']; ?>_notes">
						<span class="chevron_toggleable glyphicon glyphicon-edit"></span>
					</button>
					<?php echo ucfirst($config['Name']); ?>
				</td>
				<td id="ports" style="text-align:center">
					<?php foreach ($config['Ports'] as $port => $status) : ?>
						<?php ($status == 1) ? $label = 'success' : $label = 'danger'; ?>
						<span class="label label-<?php echo $label; ?>"><?php echo $port; ?></span>
					<?php endforeach; ?>
				</td>
				<td id="task">T07050</td>
				<td id="svn">/trunk</td>
				<td id="db-loaded-date">Jan 10 2017</td>
				<td id="database">
					<div class="input-group">
						<form action="/action.php" method="post">
							<input type="hidden" name="action" value="change_database" />
							<input type="hidden" name="args[virtualhost]" value="<?php echo $config['Name']; ?>" />
							<div class="input-group">
								<select class="form-control input-sm" name="args[database]" id="select_<?php echo $config['Name']; ?>">
									<option>-- No Database --</option>
									<?php foreach($databases as $database) : ?>
										<?php echo "'".trim($config['Database']['database']) ."'=='". $database ."'"; ?>
										<?php (trim($config['Database']['database']) == $database) ? $active = ' selected value' : $active = ''; ?>
										<option value="<?php echo $database; ?>"<?php echo $active;?>><?php echo $database; ?></option>
									<?php endforeach; ?>
								</select>
								<span class="input-group-btn">
									<input type="submit" value="Submit" class="btn btn-success btn-sm">Change DB</input>
								</span>
							</div>
						</form>
					</div>
				</td>
				<td id="clear-cache">
					<form action="/action.php" method="post">
						<input type="hidden" name="action" value="clear_cache" />
						<input type="hidden" name="args[virtualhost]" value="<?php echo $config['Name']; ?>" />
						<input type="hidden" name="args[path]" value="<?php echo PATH_HTDOCS_ROOT . $config['Name'] . '/cache' ?>" />
						<input type="submit" value="Cache" class="btn btn-warning btn-sm"></input>
					</form>
				</td>
				<td id="clear-logs">
					<form action="/action.php" method="post">
						<input type="hidden" name="action" value="clear_logs" />
						<input type="hidden" name="args[virtualhost]" value="<?php echo $config['Name']; ?>" />
						<input type="hidden" name="args[path]" value="<?php echo PATH_HTDOCS_ROOT . $config['Name'] . '/logs/ebase.log' ?>" />
						<input type="submit" value="Logs" class="btn btn-warning btn-sm"></input>
					</form>
				</td>

			</tr>
			<tr id="serverInfo" class="collapse out <?php echo $config['Name']; ?>_notes">
				<td colspan="8" style="padding:0px">
				NOTES : stores in vh json
				</td>
			</tr>
			<tr id="serverInfo" class="collapse out <?php echo $config['Name']; ?>">
				<td colspan="8" style="padding:0px">
					<div class="container" style="margin-bottom:10px;padding: 10px 0;background-color:#f6f6f6;">


										<div class="col-sm-3">Application Name</div>
										<div class="col-sm-9"><?php echo $config['Name'] ;?></div>



										<div class="col-sm-3">Document Root</div>
										<div class="col-sm-9"><?php echo $config['DocumentRoot'] ;?></div>



										<div class="col-sm-3">Server Root</div>
										<div class="col-sm-9"><?php echo $config['ServerRoot'] ;?></div>

										
									<?php foreach ($config['Servers'] as $port => $server) : ?>
										<div class="col-sm-12" style="border-top:1px solid #ccc;margin:10px 0;"></div>
											<?php ($config['Ports'][$port]  == 1) ? $online_status ='alert-success' : $online_status = 'alert-danger';?>
											<div class="col-sm-1" style="padding:0 10px;">
												<div class="col-sm-12 <?php echo $online_status;?>"  style="padding:0px; text-align: center;">
													<?php echo $port; ?>
												</div>
											</div>
											<div class="col-sm-11">
												<?php foreach ($server as $key => $value) : ?>
													<div class="col-sm-2"><?php echo $key; ?></div>
													<div class="col-sm-8">
														<?php if(strpos($value, '.log')) : ?> 
															<?php echo "..apache/" . $value; ?>
														<?php else : ?>
															<?php echo $value; ?>
														<?php endif; ?>
													</div>
													<div class="col-sm-2">
														<?php if(strpos($value, '.log')) : ?> 
															<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
																<input type="hidden" name="vh_name" value="<?php echo $config['Name'];?>">
																<input type="hidden" name="clear_cache" value="1">

																<input class="btn btn-warning pull-right input-sm" type="submit" name="submit" value="Clear Log">
													
															</form>
														<?php endif; ?>
													</div>
												<div class="col-sm-12" style="border-top:1px solid #dedede;margin:5px ;"></div>
												<?php endforeach; ?>
											</div>
									<?php endforeach; ?>
									<div class="col-sm-12" style="border-top:1px solid #999;padding-top: 10px;background-color:#505050;">
									<button class="btn btn-danger" style="margin-right:20px;margin-bottom:10px;">X Delete</button>
									</div>

					</div>
								
				</td>
			</tr>
		<?php endforeach; ?>
		</tbody>
	</table>
	<hr>
	<?php include("views/index-modal.php"); ?>	
	<?php include("views/footer.php"); ?>