<!doctype html>
<!-- paulirish.com/2008/conditional-stylesheets-vs-css-hacks-answer-neither/ -->
<!--[if lt IE 7]> <html class="no-js ie6 oldie" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js ie7 oldie" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js ie8 oldie" lang="en"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang="en">
<!--<![endif]-->
<head>
    <meta charset="utf-8"/>
    <!-- Always force latest IE rendering engine (even in intranet) & Chrome Frame
       Remove this if you use the .htaccess -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <title><?php echo $title_for_layout?></title>
    <meta name="description" content=""/>
    <meta name="author" content=""/>
    <!--  Mobile viewport optimized: j.mp/bplateviewport -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <!-- CSS : implied media="all" -->
    <!-- Le HTML5 shim, for IE6-8 support of HTML elements -->
    <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- styles -->
    <?php
    echo $this->Html->css('bootstrap-2.03');
    echo $this->Html->css('bootstrap-2.03-responsive');
    echo $this->Html->css('site');
    ?>
    <!-- icons -->
    <?php
    echo  $this->Html->meta('icon', $this->webroot . 'img/favicon.ico');
    echo $this->Html->meta(array('rel' => 'apple-touch-icon',
        'href' => $this->webroot . 'img/apple-touch-icon.png'));
    echo $this->Html->meta(array('rel' => 'apple-touch-icon',
        'href' => $this->webroot . 'img/apple-touch-icon.png', 'sizes' => '72x72'));
    echo $this->Html->meta(array('rel' => 'apple-touch-icon',
        'href' => $this->webroot . 'img/apple-touch-icon.png', 'sizes' => '114x114'));
    ?>

    <?php
    echo   $this->Html->script('modernizr-2.0.min');
    echo   $this->Html->script('respond.min');
    ?>
    <style type="text/css">
        body {
            padding-top: 60px;
            padding-bottom: 40px;
        }
    </style>
</head>

<body data-spy="scroll" data-target=".subnav" data-offset="50">
<div class="navbar navbar-fixed-top">
    <div class="navbar-inner">
        <div class="container">
            <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>
            <?php echo $this->Html->link("Cake PHP", array('controller' => 'posts', 'action' => 'index'), array('class' => 'brand')); ?>
            <div class="nav-collapse">
                <ul class="nav">
                    <li class="active">
                        <?php echo $this->Html->link("Home", array('controller' => 'posts', 'action' => 'index')); ?>
                    </li>
                </ul>
                <? if($access->isLoggedin()): ?>
                <ul class="nav pull-right">
                    <li><a href="#">Welcome <?=$access->getmy('username'); ?></a></li>
                    <li>
                        <?php echo $this->Html->link("Log Off", array('controller' => 'users', 'action' => 'logout')); ?>
                    </li>
                </ul>
                <?php else: ?>
                <ul class="nav pull-right">
                    <li id="partial-login-container" class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Have an account? Sign in<b class="caret"></b></a>
                        <ul class="dropdown-menu dropdown-form">
                            <li class="dropdown-caret right">
                                <span class="caret-outer"></span>
                                <span class="caret-inner"></span>
                            </li>
                            <li>
                                <?php echo $this->Form->create(null, array('url' => array('controller' => 'users', 'action' => 'login'), 'id' => 'partial-login-form')); ?>

                                    <?=$form->error('User.username'); ?>
                                    <p>
                                        Username
                                        <?=$form->text('User.username'); ?>
                                    </p>
                                    <p>
                                        Password
                                        <?=$form->password('User.password'); ?>

                                    </p>
                                    <?=$form->submit('Log in', array('class' => 'btn btn-primary')); ?>
                                </form>
                            </li>
                        </ul>
                    </li>
                    <li><?php echo $this->Html->link("or Register!", array('controller' => 'users', 'action' => 'register')); ?></li>
                </ul>
                <? endif; ?>
            </div>
        </div>
    </div>
</div>

<div class="container content">
    <?php echo $this->Session->flash(); ?>
    <?php echo $content_for_layout; ?>
    <hr/>
    <footer>
        <p class="pull-right">
            Designed and built by <a href="#" target="_blank">Author</a>.
        </p>
    </footer>
</div>
<!--! end of #container -->

<div class="container content">
    <h1>SQL Dump</h1>
    <?php echo $this->element('sql_dump'); ?>
</div>

<!-- All JavaScript at the bottom, except for Modernizr and Respond.
Modernizr enables HTML5 elements & feature detects; Respond is a polyfill for min/max-width CSS3 Media Queries
For optimal performance, use a custom Modernizr build: www.modernizr.com/download/ -->

<?php
echo   $this->Html->script('jquery-1.7.1.min');
echo   $this->Html->script('bootstrap-2.03');
?>
<!-- page specific scripts -->
<?php echo $scripts_for_layout; ?>
<!--[if lt IE 7 ]>
        <?php
echo   $this->Html->script('dd_belatedpng');
?>
      <script>DD_belatedPNG.fix('img, .png_bg'); // Fix any <img> or .png_bg bg-images. Also, please read goo.gl/mZiyb </script>
   <![endif]-->
</body>
</html>