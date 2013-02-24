<?php
function sort_by_date($a, $b) {
    return $a["date"] > $b["date"];
}
function walk($path, $accept_index) {
    if($handle = opendir($path)) {
        $directories = array();
        $sketches = array();
        while (false !== ($entry = readdir($handle))) {
            $full_path = sprintf("%s/%s", $path, $entry);
            $file_path = sprintf("%s/index.php", $full_path);
            if ($accept_index && file_exists($file_path) && substr($entry, 0, 1) !== ".") {
                $desc = "no description given...";
                $config_path = sprintf("%s/config.php", $full_path);
                if (file_exists($config_path)) {
                    require_once($config_path);
                    $desc = $description;
                }
                $date = time();
                try {
                    $date = new DateTime($entry);
                    $date = $date->getTimestamp();
                } catch(Exception $e) {}
                array_push($sketches, array(
                    "date" => $date,
                    "path" => substr($full_path, 2),
                    "desc" => $desc
                ));
            }
            if (is_dir($full_path) && substr($entry, 0, 1) !== ".") {
                array_unshift($directories, $full_path);
            }
            $index++;
        }
        $has_sketches = count($sketches) > 0;
        if ($has_sketches) {
            usort($sketches, "sort_by_date");
            echo "<ul class='nav'>";
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
?>