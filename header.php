<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title><?php is_front_page() ? bloginfo('description') : wp_title(''); ?> | <?php bloginfo('name'); ?></title>
        <meta name="description" content="A nifty Wordpress theme built from HTML5Boilerplate. Mobile-first Responsive.">
        <meta name="viewport" content="width=device-width">
        
        <link rel="stylesheet" href="css/main.css">
        <link href="img/_icons/favicon.ico" rel="shortcut icon" />
        <link rel="apple-touch-icon" href="img/_icons/apple-touch-icon.png" />
        <link rel="apple-touch-icon" sizes="72x72" href="img/_icons/apple-touch-icon-72x72-precomposed.png" />
        <link rel="apple-touch-icon" sizes="114x114" href="img/_icons/apple-touch-icon-114x114-precomposed.png" />
        <link rel="apple-touch-icon" sizes="144x144" href="img/_icons/apple-touch-icon-144x144-precomposed.png" />

        <?php if (is_search()) { ?>
        <meta name="robots" content="noindex, nofollow" /> 
        <?php } ?>
		
		<!-- Only javascript in the header is modernizr -->
        <script src="js/vendor/modernizr-2.6.2-respond-1.1.0.min.js"></script>

        <!-- You want plugins? Leave this baby alone. -->
        <?php wp_head(); ?>
    </head>
    <body>
        <!--[if lt IE 7]>
            <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
        <![endif]-->

        <div class="header-container">
            <header class="wrapper clearfix">
                <h1 class="title">h1.title</h1>
                <nav>
                    <?php wp_nav_menu( array
                            (
                              'theme_location'  => 'nav',
                              'container'       => 'ul', 
                              'container_class' => 'menu-{menu slug}-container', 
                              'menu_id'    => 'top-nav',
                              'menu_class'      => 'main-nav', 
                              'echo'            => true,
                              'fallback_cb'     => 'wp_page_menu',  
                            )
                        );
                    ?>         
                </nav>
            </header>
        </div>
