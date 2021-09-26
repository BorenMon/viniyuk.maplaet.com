<?php

function urlmtime($url) {
  $parsed_url = parse_url($url);
  $path = $parsed_url['path'];

  if ($path[0] == "/") {
      $filename = $_SERVER['DOCUMENT_ROOT'] . "/" . $path;
  } else {
      $filename = $path;
  }

  if (!file_exists($filename)) {
      // If not a file then use the current time
      $lastModified = date('YmdHis');
  } else {
      $lastModified = date('YmdHis', filemtime($filename));
  }

  if (strpos($url, '?') === false) {
      $url .= '?ts=' . $lastModified;
  } else {
      $url .= '&ts=' . $lastModified;
  }

  return $url;
}

function include_css($css_url, $media='all') {
  // According to Yahoo, using link allows for progressive 
  // rendering in IE where as @import url($css_url) does not
  echo '<link rel="stylesheet" type="text/css" media="' .
       $media . '" href="' . urlmtime($css_url) . '">'."\n";
}

function include_javascript($javascript_url) {
  echo '<script type="text/javascript" src="' . urlmtime($javascript_url) .
       '"></script>'."\n";
}