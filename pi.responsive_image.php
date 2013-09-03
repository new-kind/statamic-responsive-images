<?php
class Plugin_responsive_image extends Plugin {
  var $meta = array(
    'name'       => 'Srcset markup generator',
    'version'    => '0.1',
    'author'     => 'Cinesoon (Jeroen Gerits)',
    'author_url' => 'http://cinesoon.com'
  );
  public function index()
  {
    // Fetch Parameters
    $url = $this->fetchParam('src', null, false, false, false);
    $class = $this->fetchParam('class', null, false, false, false);
    $title = $this->fetchParam('title', null, false, false, false);
    $sizes = explode(', ', $this->fetchParam('sizes', null, false, false, false));
    // Generate and return output
    $output = '';
    $output .= '<img class="'.$class.'"';
    $output .= 'src="{{ transform src="'.$url.'" width="64" quality="100" }}"';
    $output .= 'srcset="';
    foreach ($sizes as $size)
    {
      $output .= '{{ transform src="'.$url.'" width="'.$size.'" quality="100" }} '.$size.'w,';
      // Retina support
      $hdsize = $size * 2;
      $output .= '{{ transform src="'.$url.'" width="'.$hdsize.'" quality="100" }} '.$size.'w 2x,';
    }
    $output .= '">';
    return $output;
  }
}