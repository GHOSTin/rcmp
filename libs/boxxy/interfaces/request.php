<?php namespace boxxy\interfaces;

interface request{

  public function __construct();

  public function set_property($key, $value);

  public function get_property($key);

  public function get_uri();

  public function get_host();
}