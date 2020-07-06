<!DOCTYPE HTML>
<!--
    Made by Frost-ZX (github.com/Frost-ZX)
    Template: Multiverse by HTML5 UP
              html5up.net | @ajlkn
    Free for personal and commercial use under the CCA 3.0 license (html5up.net/license).
-->
<?php
define('IN_MAIN', TRUE);
include 'functions.php';

// 设置
$settings = new LoadSettings();
$settings->readSettings();
// 图片
$images = new LoadImages();
$images->readImages();

// 翻页
$page_current = intval($_GET['page']) or $page_current = 1;
?>
<html>
    <head>
        <title><?php $settings->getSiteTitle(); ?> - <?php $settings->getSiteSubtitle(); ?></title>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
        <link rel="stylesheet" href="assets/css/main.css" />
        <link rel="stylesheet" href="assets/css/style.css" />
        <noscript><link rel="stylesheet" href="assets/css/noscript.css" /></noscript>
    </head>
    <body class="is-preload">
        <!-- Wrapper -->
        <div id="wrapper">

            <!-- Header -->
            <header id="header">
                <h1><a href="."><strong><?php $settings->getSiteTitle(); ?></strong> <?php $settings->getSiteSubtitle(); ?></a></h1>
                <nav>
                    <ul>
                        <li><a class="icon solid fa-expand" id="fullscreen">全屏</a></li>
                        <li><a href="#footer" class="icon solid fa-info-circle">关于</a></li>
                    </ul>
                </nav>
            </header>

            <!-- Main -->
            <div id="main">
                <?php $images->getImages($page_current); ?>
                <div class="pager">
                    <?php $images->getPager($page_current); ?>
                </div>
                <div class="spacing"></div>
            </div>

            <!-- Footer -->
            <footer id="footer" class="panel">
                <div class="inner split">
                    <div>
                        <section>
                            <h2>关于</h2>
                            <p><?php $settings->getPersonalAbout(); ?></p>
                        </section>
                        <section>
                            <h2>联系我</h2>
                            <ul class="icons">
                                <?php $settings->getPersonalContactLinks(); ?>
                            </ul>
                        </section>
                        <p class="copyright">
                            &copy; Blocky: Made by <a href="https://github.com/Frost-ZX" target="_blank">Frost-ZX</a>.
                            Template: Multiverse by <a href="https://html5up.net/" target="_blank">HTML5 UP</a>.
                        </p>
                    </div>
                    <div>
                        <?php
                        /*
                        <section>
                            <h2>联系我</h2>
                            <form method="post" action="#">
                                <div class="fields">
                                    <div class="field half">
                                        <input type="text" name="name" id="name" placeholder="称呼" />
                                    </div>
                                    <div class="field half">
                                        <input type="text" name="email" id="email" placeholder="邮箱" />
                                    </div>
                                    <div class="field">
                                        <textarea name="message" id="message" rows="4" placeholder="内容"></textarea>
                                    </div>
                                </div>
                                <ul class="actions">
                                    <li><input type="submit" value="发送" class="primary" /></li>
                                    <li><input type="reset" value="重置" /></li>
                                </ul>
                            </form>
                        </section>
                        */
                        ?>
                    </div>
                </div>
            </footer>
        </div>

        <!-- Scripts -->
        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/js/jquery.lazyload.min.js"></script>
        <script src="assets/js/jquery.poptrox.min.js"></script>
        <script src="assets/js/browser.min.js"></script>
        <script src="assets/js/breakpoints.min.js"></script>
        <script src="assets/js/util.js"></script>
        <script src="assets/js/main.js"></script>
        <!-- 自定义 -->
        <script src="assets/js/script.js"></script>
        <!-- Lazy Load -->
        <script type="text/javascript">
            $(function() {
                $("a.lazy").lazyload({
                    effect: "fadeIn",
                    effect_speed: 2000
                });
            });
        </script>
    </body>
</html>
