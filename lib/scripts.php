<?php include(__DIR__.'/../roots/lib/scripts.php');

# Add the special GDS Analytics code
add_action('wp_footer', function() {
  ?>

<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
   
  ga('create', 'UA-40442074-1', 'blog.gov.uk');
  ga('send', 'pageview');
</script>

  <?php
}, 20);
