<?php
$file_str = file_get_contents('./posts.txt');

$split = explode("##########", $file_str);

$num = "000";
foreach($split as $post_str) {
       
        $post_str = trim($post_str);
        
        if ($post_str) {
                // get the yaml data out
                $yaml_lines = explode("\n", $post_str);
                foreach ($yaml_lines as $line) {
                        if (preg_match("/^Slug:\s?([A-Za-z0-9_-]+)$/i", $line, $matches)) {
                                $slug = $matches[1];
                        }
                }
                // write file
                $num++;
                echo $num.'...';
                mkdir("./posts/{$num}-{$slug}", 0755, TRUE);
                file_put_contents("./posts/{$num}-{$slug}/blogarticle.txt", $post_str);
        }
}
?>
