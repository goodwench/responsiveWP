<div class="footer-container">
            <footer class="wrapper">
               
            </footer>
        </div>        
        <!-- Javascript below here -->
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
        <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.9.1.js"><\/script>')</script>      

       <!--  Google Analtyics Script -->
        <script>
            var _gaq=[['_setAccount','UA-XXXXX-X'],['_trackPageview']];
            (function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];
            g.src=('https:'==location.protocol?'//ssl':'//www')+'.google-analytics.com/ga.js';
            s.parentNode.insertBefore(g,s)}(document,'script'));
        </script>
        <?php
           /* Always have wp_footer() just before the closing </body>
            * tag of your theme, or you will break many plugins, which
            * generally use this hook to reference JavaScript files.
            */
            wp_footer();
        ?>
    </body>
</html>