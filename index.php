<?php
function walk($path, $accept_index) {
    if($handle = opendir($path)) {
        $directories = array();
        $sketches = array();
        while (false !== ($entry = readdir($handle))) {
            $full_path = sprintf("%s/%s", $path, $entry);
            if (is_dir($full_path) && substr($entry, 0, 1) !== ".") {
                array_unshift($directories, $full_path);
            } elseif($accept_index && $entry === "index.php") {
                $desc = "no description given...";
                $config = sprintf("%s/config.php", $path);
                if (file_exists($config)) {
                    require_once($config);
                    $desc = $description;
                }
                array_push($sketches, array(
                    "desc" => $desc,
                    "path" => substr($path, 2)
                ));
            }
            $index++;
        }
        $has_sketches = count($sketches) > 0;
        if ($has_sketches) {
            echo "<ul>";
            foreach($sketches as $sketch) {
                echo sprintf('<li><a href="%s" title="%s">%s</a>', $sketch["path"], $sketch["desc"], $sketch["path"]);
                foreach($directories as $directory) {
                    walk($directory, true);
                }
                echo "</li>";
            }
            echo "</ul>";
        } else {
            foreach($directories as $directory) {
                walk($directory, true);
            }
        }
        closedir($handle);
    }
}
?><!DOCTYPE html>
<html dir="ltr" lang="en-US">
<head>
    <meta http-equiv="Content-Type" charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>I Can Has Web - Arne Hassel on the web</title>
    <link rel="stylesheet" type="text/css" media="all" href="stylesheets/style.css" />
    <link rel="stylesheet" type="text/css" media="all and (min-width: 30em)" href="stylesheets/style.medium.css" />
    <link rel="stylesheet" type="text/css" media="all and (min-width: 51em)" href="stylesheets/style.large.css" />
    <!--[if lte IE 8]>
    <link rel="stylesheet" type="text/css" href="stylesheets/style.medium.css" />
    <link rel="stylesheet" type="text/css" href="stylesheets/style.large.css" />
    <![endif]-->
</head>
<body>
    <div class="block-content">
        <h1>Sketches</h1>
        <p>Here you'll find sketches I made public.</p>
        <p>The sketches are organized into a three, with each leaf being the actual sketch, while the branches will show the latest sketch within their scope.</p>
    </div>
    <div class="list-sketches">
        <?php walk(".", false); ?>
    </div>
    <script src="javascript/lib/jquery.1.9.1.min.js" type="text/javascript"></script>
    <script src="javascript/lib/jquery.qtip.2.0.1.min.js" type="text/javascript"></script>
    <script type="text/javascript">
        $(function () {
            $("a[title]").qtip({
                style: {
                    classes: 'qtip-dark qtip-rounded qtip-shadow',
                    position: {
                        my: 'left center',
                        at: 'left top'
                    },
                    tip: {
                        corner: 'left top'
                    }
                }
            });
        });
    </script>
</body>