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
      <a class="navbar-brand" href="#">eBase Loader :: Local Servers</a>
    </div>
    <div id="navbar" class="navbar-collapse collapse">
      <!-- Trigger the modal with a button -->
      <button type="button" class="btn btn-success btn-sm" style="float:right;margin-top:10px" data-toggle="modal" data-target="#myModal"><strong ><span class="glyphicon glyphicon-plus-sign"></span></strong> New Server</button>
      <button type="button" class="btn btn-success btn-sm" style="float:right;margin:10px 10px 0 0" data-toggle="modal" data-target="#updateModal"><strong ><span class="glyphicon glyphicon-plus-sign"></span></strong> New Database</button>
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