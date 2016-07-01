
<!DOCTYPE html>

<html lang="en">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8">

        <title>jQuery Cheat Sheet</title>

        <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">

        <meta name="viewport" content="width=device-width, initial-scale=1">

        <meta name="author" content="Oscar Otero - https://oscarotero.com">
        <meta name="title" content="jQuery Cheat Sheet">
        <meta name="description" content="jQuery cheat sheet in HTML with links to the original API documentation">
        <meta name="keywords" content="jQuery, javascript, cheatsheet, api, resource, web developer">

        <meta property="og:title" content="jQuery Cheat Sheet">
        <meta property="og:image" content="<?= $app->getUrl('jquery.png') ?>">
        <meta property="og:description" content="jQuery cheat sheet in HTML with links to the original API documentation. Created by Oscar Otero">

        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:site" content="@misteroom">
        <meta name="twitter:creator" content="@misteroom">
        <meta name="twitter:title" content="JQuery Cheat Sheet">
        <meta name="twitter:description" content="jQuery cheat sheet in HTML with links to the original API documentation. Created by Oscar Otero">
        <meta name="twitter:image" content="<?= $app->getUrl('jquery.png') ?>">

        <link rel="stylesheet" href="<?= $app->getUrl('css/styles.css') ?>" type="text/css" media="screen">
        <link rel="stylesheet" href="<?= $app->getUrl('css/styles-print.css') ?>" type="text/css" media="print">
        <script type="text/javascript" src="<?= $app->getUrl('js/main.js') ?>"></script>
    </head>

    <body>
        <header class="main-header">
            <h1>
                <strong><a href="http://jquery.com/" title="Go to jQuery site">jQuery</a></strong>
                Quick API Reference
            </h1>

            <div class="filter-group">
                <div class="filter filter-version">
                    <select id="version" data-placeholder="Version...">
                        
                        <?php foreach (array_reverse($versions) as $version): ?>
                        <option data-source="<?= $version['source']; ?>" value="<?= $version['value'] ?>"><?= $version['name'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="filter filter-search">
                    <select id="search" placeholder="Search...">
                        <option></option>
                        <?php
                        $this->insert('options', $selectors);
                        $this->insert('options', $attributes);
                        $this->insert('options', $manipulation);
                        $this->insert('options', $traversing);
                        $this->insert('options', $events);
                        $this->insert('options', $effects);
                        $this->insert('options', $ajax);
                        $this->insert('options', $core);
                        ?>
                    </select>
                </div>
            </div>

            <a class="about" href="#about" id="about-link">Preferences...</a>
        </header>

        <div class="main-content ly-horizontal">
            <?php
            $this->insert('article', $selectors);
            $this->insert('article', $attributes);
            $this->insert('article', $manipulation);
            $this->insert('article', $traversing);
            $this->insert('article', $events);
            $this->insert('article', $effects);
            $this->insert('article', $ajax);
            $this->insert('article', $core);
            ?>
        </div>

        <div class="ads">
            <a href="http://www.jspplang.org/" target="_blank" title="Go to JavaScript++">
                <strong>Click here to learn about JavaScript++</strong>, which provides classes, type checking, and modules. It also works with jQuery
            </a>
        </div>

        <div id="about" class="mfp-hide">
            <fieldset>
                <h4>Open links:</h4>
                <label><input type="radio" name="open_links" value="modal-window"> Modal window</label>
                <label><input type="radio" name="open_links" value="new-window"> New window</label>
                <label><input type="radio" name="open_links" value="same-window"> Same window</label>
            </fieldset>

            <fieldset>
                <h4>Layout:</h4>
                <label><input type="radio" name="layout" value="horizontal"> Horizontal</label>
                <label><input type="radio" name="layout" value="vertical"> Vertical</label>
            </fieldset>

            <p><a href="https://github.com/oscarotero/jquery-cheatsheet" title="Get the code from github">Source code</a> | by <a href="https://twitter.com/misteroom">@misteroom</a></p>
        </div>

        <div id="modal" class="mfp-hide">
            <ul>
                <li class="link-api"><a href="">API doc</a></li>
                <li class="link-src"><a href="http://james.padolsey.com/jquery/" target="_blank">Source viewer</a></li>
            </ul>
            <div>
                <iframe src="about:blank"></iframe>
            </div>
        </div>
    </body>
</html>
