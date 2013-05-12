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
                        if (preg_match("/^Link:\s?(.+)$/i", $line, $matches)) {
                                $link = "true";
                        }                        
                }
                // write file
                $num++;
                echo $num.'...';
                mkdir("./posts/{$num}-{$slug}", 0755, TRUE);
                if($link == "true") { 
                        file_put_contents("./posts/{$num}-{$slug}/article.link.txt", $post_str);
                        $link = "false";
                } else {
                        file_put_contents("./posts/{$num}-{$slug}/article.text.txt", $post_str);
                }
        }
}
?>
