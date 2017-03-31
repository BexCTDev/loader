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
        <?php echo '<pre>'; ?>
        <?php print_r($config);?>
        <?php echo '</pre>'; ?>
      <tr>
        <td><div class="label label-default label-sm clickable" style="margin:-5px 5px 0 0" data-toggle="collapse" id="2" data-target=".server1"><span class="chevron_toggleable glyphicon glyphicon-chevron-down"></span></div>ebase</td>
        <td style="text-align:center"><label class="label label-success">80</label> | <label class="label label-success">443</label></td>
        <td>T07050</td>
        <td>/trunk</td>
        <td>dms_db</td>
        <td>Jan 10 2017</td>
        <td>
          <div class="input-group">
            <select class="form-control input-sm" id="sel1">
              <option disabled selected value> -- select an database -- </option>
              <option>client1_db</option>
              <option>client2_db</option>
              <option>client3_db</option>
              <option>client4_db</option>
            </select>
            <span class="input-group-btn">
              <button class="btn btn-warning btn-sm">Change DB</button>
            </span>
          </div>
        </td>
        <td><button class="btn btn-primary btn-sm">Clear Logs</button></td>
        <td><button class="btn btn-primary btn-sm">Clear Cache</button></td>

      </tr>
      <tr id="serverInfo" class="collapse out server1">
        <td colspan="8">
          <h5>Server 1</h5>
          <div class=""></div>
          <button class="btn btn-danger btn-sm">X Delete</button>
        </td>
      </tr>
    <?php endforeach; ?>
    </tbody>
  </table>
  <hr>
  <?php include("views/index-modal.php"); ?>              
  <?php include("views/footer.php"); ?>