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


function flatten_query($query) {
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

    $fileName = 'dados-municipios.csv';

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
            fputcsv( $fh, array_keys( $data ) );
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

$fields = get_municipio_fields();

if ( $_GET['type'] == 'csv' ) {
    header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
    header('Content-Description: File Transfer');
    header("Content-type: text/csv");
    header("Content-Disposition: attachment; filename=dados-municipios-" . date( 'YmdHis' ) . ".csv");
    header("Expires: 0");
    header("Pragma: public");
    $fh = @fopen( 'php://output', 'w' );
    fputcsv( $fh, array_merge( array( 'id', 'cidade' ), $fields ) );
}

// Formulários respondidos
$municipios = $wpdb->get_results("
    SELECT p.ID, p.post_title
    FROM
        {$wpdb->posts} p,
        {$wpdb->postmeta} pm,
        {$wpdb->users} u
    WHERE 1=1
        AND pm.post_id = p.ID
        AND pm.meta_key = 'ibge'
        AND pm.meta_value = u.user_login
        AND p.post_type = 'municipio'
        AND p.post_status = 'publish'
    ORDER BY post_title",
    ARRAY_A
);


foreach ( $municipios as $m ) {

    $metas = array();
    $_metas = $wpdb->get_results("
        SELECT meta_key, meta_value
        FROM {$wpdb->postmeta}
        WHERE 1=1
            AND post_id = {$m['ID']}
            AND meta_key LIKE 'wpcf-qs%'
        ORDER BY meta_key ASC",
        ARRAY_A
    );

    if ( count( $_metas ) == 0 )
        continue;

    foreach( $_metas as $_meta ) {
        $metas[ $_meta['meta_key'] ] = $_meta['meta_value'];
    }

    $post = array( 'id' => $m['ID'], 'municipio' => $m['post_title'] );
    foreach( $fields as $f ) {

        if ( empty( $metas[ $f ] ) ) {
            $post[ $f ] = '';
            continue;
        }

        if ( is_serialized( $metas[ $f ] ) )
            $metas[ $f ] = implode( ', ', unserialize( $metas[ $f ] ) );

        $post[ $f ] = $metas[ $f ];

    }

    if ( $_GET["type"] == "csv" )
        fputcsv( $fh, $post );
    else if ( $_GET["type"] == "json" )
        echo json_encode( $posts );
}

if ( $_GET['type'] = 'csv' )
    fclose($fh);
