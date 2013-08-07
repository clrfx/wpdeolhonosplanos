<?php
function flatten(array $data, $separator = '_') {
            $result = array();
            $stack = array();
            $path = null;

            reset($data);
            while (!empty($data)) {
                $key = key($data);
                $element = $data[$key];
                unset($data[$key]);  
                if (is_array($element)) {
                    if (!empty($data)) {
                        $stack[] = array($data, $path);
                    }
                      $data = $element;
                    $path .= $key . $separator;
                } else {
                    $result[$path . $key] = $element;
                }

                if (empty($data) && !empty($stack)) {
                    list($data, $path) = array_pop($stack);
                }
            }
            return $result;
         }


function flatten_soc($query) {
    $results = array();
    foreach ($query as $row) {
      $results_row = array();
      foreach ($row as $field => $field_value) {
        if (is_serialized($field_value)) {
          $local_array = unserialize($field_value);
          $results_row[$field] = array_map("map_keys", array_flip($local_array));
        }
        else {
          $results_row[$field] = $field_value;
        }
      }
      $results[] = flatten($results_row);
    }

   return $results;
 }

function map_keys($a) {
  return 1;
}

function writecsv($results) {
    $fileName = 'municipios.csv';
     
    header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
    header('Content-Description: File Transfer');
    header("Content-type: text/csv");
    header("Content-Disposition: attachment; filename={$fileName}");
    header("Expires: 0");
    header("Pragma: public");
     
    $fh = @fopen( 'php://output', 'w' );
     
    $headerDisplayed = false;
     
    foreach ( $results as $data ) {
        // Add a header row if it hasn't been added yet
        if ( !$headerDisplayed ) {
            // Use the keys from $data as the titles
            fputcsv($fh, array_keys($data));
            $headerDisplayed = true;
        }
     
        // Put the data into the stream
        fputcsv($fh, $data);
    }
    // Close the file
    fclose($fh);
    // Make sure nothing else is sent, our file is done
    exit;
}

 ?>
<?php

$path = $_SERVER['DOCUMENT_ROOT'];

include_once $path . '/wp-config.php';
include_once $path . '/wp-load.php';
include_once $path . '/wp-includes/wp-db.php';
include_once $path . '/wp-includes/pluggable.php';

    global $wpdb;
    if ( $_GET["export"] != 'true') {
      die("You don't have the power! :)");
    }
    $quest_fields = "post_title AS municipio, qs_nome, qs_cpf, qs_relacao, qs_relacao_obs, qs_conselho, qs_conselho_obs, qs_email, qs_telefone, qs_01, qs_01_1, qs_01_obs, qs_02_1, qs_02_2, qs_02_3, qs_02_4, qs_02_5, qs_02_obs, qs_03, qs_04, meta_value AS ibge";
    $query = $wpdb->get_results("SELECT ". $quest_fields ." FROM " . $wpdb->prefix . "mapadosplanos_quest AS quest JOIN " . $wpdb->prefix . "posts AS posts ON posts.ID=quest.post_id JOIN ". $wpdb->prefix ."postmeta AS meta ON quest.post_id=meta.post_id WHERE meta.meta_key='ibge'", ARRAY_A);
    //$query = $wpdb->get_results("SELECT * FROM " . $wpdb->prefix . "posts JOIN ".$wpdb->prefix."postmeta ON ID=post_id WHERE post_type='municipio' AND meta_key LIKE 'wpcf-qs%' LIMIT 1000", ARRAY_A);
    
    $posts = array();
    $posts = flatten_soc($query);

    //creating model
    $array_model = array();
    foreach ($posts as $key => $post) {
      foreach ($post as $key_post => $key_value) {
        $array_model[$key_post] = null;
      }
    }

    //Populating
    foreach ($posts as $key => $post) {
      $posts[$key] = $post + $array_model;
      ksort($posts[$key]);
    }

    if ($_GET["type"] == "csv") {
      writecsv($posts);
    }
    else if ($_GET["type"] == "json") {
      echo json_encode($posts);
    }
?>