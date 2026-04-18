<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Simulator-Admin Area</title>
        <link rel="stylesheet" type="text/css" href="<?php echo URL; ?>backoffice/public/theme/css/theme.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo URL; ?>backoffice/public/theme/css/style.css" />
        <link rel="stylesheet" href="<?php echo URL; ?>backoffice/public/css/style.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo URL; ?>backoffice/public/cleditor/cleditor.css" />
        <link rel="stylesheet" href="<?php echo URL; ?>backoffice/public/jquery/themes/base/jquery.ui.all.css">
            <link rel="stylesheet" type="text/css" href="<?php echo URL; ?>backoffice/public/theme/css/theme4.css"/>
            <script src="<?php echo URL; ?>backoffice/public/jquery/jquery-1.10.2.js"></script>
            <script src="<?php echo URL; ?>backoffice/public/fancybox/jquery-1.4.3.min.js"></script>
            <!--            ########################### FANCYBOX ###################################-->
            <!--            ###################  TEXT EDITOR ################################-->
            <script src="<?php echo URL; ?>backoffice/public/cleditor/jquery.cleditor.js"></script>
            <!--#######################################-->
            <script type="text/javascript" src="<?php echo URL; ?>backoffice/public/fancybox/fancybox/jquery.mousewheel-3.0.4.pack.js"></script>
            <script type="text/javascript" src="<?php echo URL; ?>backoffice/public/fancybox/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
            <link rel="stylesheet" type="text/css" href="<?php echo URL; ?>public/fancybox/fancybox/jquery.fancybox-1.3.4.css" media="screen" />
            <script src="<?php echo URL; ?>backoffice/public/jquery/ui/jquery.ui.core.js"></script>
            <script src="<?php echo URL; ?>backoffice/public/jquery/ui/jquery.ui.widget.js"></script>
            <script src="<?php echo URL; ?>backoffice/public/jquery/ui/jquery.ui.datepicker.js"></script>
            <script type="text/javascript" src="<?php echo URL; ?>backoffice/public/js/application.js"></script>

            <script type="text/javascript" src="<?php echo URL; ?>backoffice/public/chart/js/highcharts.js"></script>
            <script type="text/javascript" src="<?php echo URL; ?>backoffice/public/chart/js/modules/exporting.js"></script>
            <?php echo (file_exists($jsController) ? '<script type="text/javascript" src="' . URL . $jsController . '"></script>' : "") ?>
            <?php echo (file_exists($jsView) ? '<script type="text/javascript" src="' . URL . $jsView . '"></script>' : "") ?>
            <!--[if IE]>
            <link rel="stylesheet" type="text/css" href="css/ie-sucks.css" />
            <![endif]-->
    </head>

    <body>
        <div style="display: none;" id="overlay"></div>
        <div id="container">


