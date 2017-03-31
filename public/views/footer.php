<?php // Version : 1.0 ?>
      <footer>
        <p>&copy;</p>
      </footer>
    </div> <!-- /container -->       
    <script>window.jQuery || document.write('<script src="src/js/vendor/jquery-1.11.2.min.js"><\/script>')</script>

    <script src="src/js/vendor/bootstrap.min.js"></script>

    <script src="src/js/main.js"></script>
    <script>
      $('.label-default').on('click', function() {
        $(this).find('span').closest('.chevron_toggleable').toggleClass('glyphicon-chevron-down glyphicon-chevron-up');
      });

    </script>
  </body>
</html>