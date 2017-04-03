<?php // Version : 1.0 ?>
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">eBase Loader .::.:</a>
    </div>
    <div id="navbar" class="navbar-collapse collapse">
      <!-- Trigger the modal with a button -->
      <ul class="nav navbar-nav navbar-right">
        <li><a href="#" data-toggle="modal" data-target="#server_modal"><strong><span class="glyphicon glyphicon-hdd"></span></strong> Project</a></li>
        <li><a href="#" data-toggle="modal" data-target="#database_modal"><strong><span class="glyphicon glyphicon-tasks"></span></strong> Database</a></li>
      </ul>
      
    </div><!--/.navbar-collapse -->
  </div>
</nav>
<?php
// DISPLAY MESSAGES 
if(isset($_SESSION['message'])) {
  echo '<div class="container">' . $_SESSION['message'] .'</div>';
  unset($_SESSION['message']);
}
?>