<?php // Version : 1.0 ?>
<!-- CREATE NEW SERVER -->
<div id="server_modal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><strong><span class="glyphicon glyphicon-hdd"></span></strong> Project Loader</h4>
      </div>
      <div class="modal-body">
        <p>
          <h5>Load Project</h5>
          <form action="/action.php" method="post">
            <input type="hidden" name="action" value="load_project" />
            <div class="input-group" style="margin-top: 5px;">
              <select class="form-control input-sm" name="args[project]" id="select_<?php echo $config['Name']; ?>">
                <option>-- Select Team Project -- </option>
                <?php foreach($databases as $project) : ?>
                  <option value="<?php echo $project; ?>"><strong><span class="glyphicon glyphicon-globe"></span></strong>Team Project : <?php echo $project; ?></option>
                <?php endforeach; ?>
              </select>
              <span class="input-group-btn">
                <input type="submit" value="Load Team" class="btn btn-success btn-sm"></input>
              </span>
            </div>
          </form>
          <form action="/action.php" method="post">
            <input type="hidden" name="action" value="local_load_project" />
            <div class="input-group" style="margin-top: 5px;">
              <select class="form-control input-sm" name="args[load_project]" id="select_<?php echo $config['Name']; ?>">
                <option>-- Select Local Project --</option>
                <?php foreach($databases as $project_local) : ?>
                  <option value="<?php echo $project_local; ?>"><strong><span class="glyphicon glyphicon-user"></span></strong>Local Project : <?php echo $project_local; ?></option>
                <?php endforeach; ?>
              </select>
              <span class="input-group-btn">
                <input type="submit" value="Load Local" class="btn btn-success btn-sm"></input>
              </span>
            </div>
          </form>
          <hr />
          <h5>New Custom eBase Server</h5>
          <form action="/action.php" method="post">
            <input type="hidden" name="action" value="ebase_custom_project" />
            <div class="col-xs-12 col-sm-6" style="padding: 0 5px 0 0;">
              <input type="text" class="form-control input-sm" id="database" name="args[virtualhost]" placeholder="Host Name">
            </div>
            <div class="col-xs-12 col-sm-6" style="padding: 0 0 5px 0;">
              <select class="form-control input-sm" name="args[database]" id="select_<?php echo $config['Name']; ?>">
                <option>No Database</option>
                <?php foreach($databases as $database) : ?>
                  <option value="<?php echo $database; ?>"><?php echo $database; ?></option>
                <?php endforeach; ?>
              </select>
            </div>
            <span class="input-group-btn">
              <input type="submit" value="Create" class="btn btn-success btn-sm pull-right" style="margin-top: 5px;"></input>
            </span>
          </form>
          <hr />
          <h5>New Custom Server</h5>
          <form action="/action.php" method="post">
            <input type="hidden" name="action" value="custom_project" />
            <div class="col-xs-12 col-sm-6" style="padding: 0 5px 0 0;">
              <input type="text" class="form-control input-sm" id="database" name="args[virtualhost]" placeholder="Host Name">
            </div>
            <div class="col-xs-12 col-sm-6" style="padding: 0 0 5px 0;">
              <input type="text" class="form-control input-sm" id="database" name="args[database]" placeholder="Database Name">
              </select>
            </div>
            <span class="input-group-btn">
              <input type="submit" value="Create" class="btn btn-success btn-sm pull-right" style="margin-top: 5px;"></input>
            </span>
          </form>
          <hr />
        </p>
      </div>
      <div class="modal-footer">
      </div>
    </div>
  </div>
</div>

<!-- CREATE NEW DATABASE -->
<div id="database_modal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><strong><span class="glyphicon glyphicon-task"></span></strong>Database Manager</h4>
      </div>
      <div class="modal-body">
        <p>
          <h5>Create DB</h5>
          <p>
            <form action="/action.php" method="post">
              <input type="hidden" name="action" value="create_database" />
              <div class="input-group">
              <input type="text" class="form-control input-sm" id="database" name="args[database]" placeholder="Database Name">
                <span class="input-group-btn">
                  <input type="submit" value="Create" class="btn btn-success btn-sm"></input>
                </span>
              </div>
            </form>
          </p>
          <hr />


          <h5>Create DB and Load SQL file</h5>
          <p>
            <form action="/action.php" method="post">
              <input type="hidden" name="action" value="load_database" />
              <input type="hidden" name="args[virtualhost]" value="<?php echo $config['Name']; ?>" />

              <div class="input-group">
                <label class="input-group-btn">
                  <span class="btn btn-default input-sm">
                    Browse&hellip; <input id="my-file-selector" type="file" name="args[filename]" style="display:none;" onchange="$('#upload-file-info').val($(this).val());">
                  </span>
                </label>
                <input type="text" class="form-control input-sm" id="upload-file-info" readonly placeholder="-- Select SQL file --">
              </div>
              <div class="input-group" style="margin-top: 5px;">
                <input type="text" class="form-control input-sm" name="args[database]" id="database" placeholder="Enter Database Name or leave blank for system generated name">
                <span class="input-group-btn">
                  <input type="submit" value="Create" class="btn btn-success btn-sm"></input>
                </span>
              </div>
            </form>
          </p>
          <hr />


          <h5>Upadate DB with SQL File</h5>
          <p>
            <form action="/action.php" method="post">
              <input type="hidden" name="action" value="clear_cache" />
              <input type="hidden" name="args[virtualhost]" value="<?php echo $config['Name']; ?>" />

              <div class="input-group">
                <label class="input-group-btn">
                  <span class="btn btn-default input-sm">
                    Browse&hellip; <input id="my-file-selector" type="file" name="args[filename]" style="display:none;" onchange="$('#upload-file-info').val($(this).val());">
                  </span>
                </label>
                <input type="text" class="form-control input-sm" id="upload-file-info" readonly placeholder="-- Select SQL file --">
              </div>
              <div class="input-group" style="margin-top: 5px;">
                <select class="form-control input-sm" name="args[database]" id="select_<?php echo $config['Name']; ?>">
                  <option>No Database</option>
                  <?php foreach($databases as $database) : ?>
                    <?php ($config['Database']['database'] == $database) ? $active = 'selected value' : $active = ''; ?>
                    <?php ($config['Database']['database'] == $database) ? $disabled = ' disabled ' : $disabled = ''; ?>
                    <option value="<?php echo $database; ?>"<?php echo $disabled . $active;?>><?php echo $database; ?></option>
                  <?php endforeach; ?>
                </select>
                <span class="input-group-btn">
                  <input type="submit" value="Update" class="btn btn-success btn-sm"></input>
                </span>
              </div>
            </form>
          </p>
          <hr />


          <h5>Delete DB</h5>
          <p>
            <form action="/action.php" method="post">
              <input type="hidden" name="action" value="delete_database" />
              <div class="input-group">
                <select class="form-control input-sm" name="args[database]" id="select_<?php echo $config['Name']; ?>">
                  <option>Select Database</option>
                  <?php foreach($databases as $database) : ?>
                    <option value="<?php echo $database; ?>"<?php echo $disabled . $active;?>><?php echo $database; ?></option>
                  <?php endforeach; ?>
                </select>
                <span class="input-group-btn">
                  <input type="submit" value="Delete" class="btn btn-danger btn-sm"></input>
                </span>
              </div>
            </form>
          </p>
        </p>
      </div>
      <div class="modal-footer">

      </div>
    </div>

  </div>
</div>