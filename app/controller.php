<?php namespace app;

abstract class controller{
  abstract public function execute(\app\request $request);
}