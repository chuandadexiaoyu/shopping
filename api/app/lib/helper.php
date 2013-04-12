<?php

// include this with:
// require_once app_path().'/lib/helper.php';

// Helper functions ----------------------------------------------------
 
if (!function_exists('getJsonStringForError')) {
    function getJsonStringForError($exception)
    {
        $data = json_decode($exception->getMessage());
        if (!$data) {
            $json = array('errors' => array($exception->getMessage()));
        } else {
            $json = array('errors' => $data);
        }
        return $json;
    }
}

