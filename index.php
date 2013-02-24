<?php
include("functions.php");
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