<?php
function walk($path, $accept_index) {
    if($handle = opendir($path)) {
        $directories = array();
        $paths = array();
        while (false !== ($entry = readdir($handle))) {
            $full_path = sprintf("%s/%s", $path, $entry);
            if (is_dir($full_path) && substr($entry, 0, 1) !== ".") {
                array_push($directories, $full_path);
            } elseif($accept_index && $entry === "index.php") {
                array_push($paths, substr($path, 2));
            }
        }
        $has_paths = count($paths) > 0;
        if ($has_paths) {
            echo "<ul>";
            foreach($paths as $path) {
                echo sprintf('<li><a href="%s">%s</a>', $path, $path);
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
        <p>Below you'll find some sketches, made for various purposes.</p>
    </div>
    <div class="list-sketches">
        <?php walk(".", false); ?>
    </div>
</body>