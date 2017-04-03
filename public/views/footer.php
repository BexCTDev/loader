<?php // Version : 1.0 ?>
      <footer>
        <p class="pull-right">&copy; <?php echo date('Y', time()); ?></p>
        <p>
        <?php
          echo '<pre>';
          print_r($config);
          print_r(array_slice(get_defined_constants(), -15, 15, true));
          echo '</pre>';
        ?>
        </p>
      </footer>
    </div> <!-- /container -->       
    <script>window.jQuery || document.write('<script src="static/js/vendor/jquery-1.11.2.min.js"><\/script>')</script>

    <script src="static/js/vendor/bootstrap.min.js"></script>

    <script src="static/js/main.js"></script>
    <script>
      $('.label-default').on('click', function() {
        $(this).find('span').closest('.chevron_toggleable').toggleClass('glyphicon-chevron-down glyphicon-chevron-up');
      });

    </script>
  </body>
</html>