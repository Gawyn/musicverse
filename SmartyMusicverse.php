<?php
  require 'smarty/libs/Smarty.class.php';
  class SmartyMusicverse extends Smarty
  {
    private $path = '/Users/cristianplanasgonzalez/projects/smarty/';

    public function __construct()
    {
      parent::__construct();
      $this->template_dir = $this->path.'templates/templatesMusicverse';
      $this->config_dir = $this->path.'configs';
      $this->compile_dir = $this->path.'templates_c';
      $this->cache_dir = $this->path.'cache';
    }
  }
?>
