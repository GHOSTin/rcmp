<?php

use \Silex\Application;
use \app\controllers\default_page as controller;

class controller_about_Test extends PHPUnit_Framework_TestCase{

  public function setUp(){
    $twig = $this->getMockBuilder('\Twig_Environment')
                 ->disableOriginalConstructor()->getMock();
    $em = $this->getMockBuilder('\Doctrine\ORM\EntityManager')
               ->disableOriginalConstructor()->getMock();
    $this->app = new Application();
    $this->controller = new controller();
    $this->app['twig'] = $twig;
    $this->app['em'] = $em;
  }

  public function test_default_page(){
    $this->app['user'] = 'user_object';
    $repository = $this->getMockBuilder('Doctrine\ORM\EntityRepository')
                       ->disableOriginalConstructor()
                       ->setMethods(['findOneByShowPodcast'])
                       ->getMock();
    $repository->expects($this->once())
               ->method('findOneByShowPodcast')
               ->with('1')
               ->will($this->returnValue('podcast_object'));
    $this->app['em']->expects($this->once())
                    ->method('getRepository')
                    ->will($this->returnValue($repository));
    $this->app['twig']->expects($this->once())
                      ->method('render')
                      ->with('default_page.tpl',
                             ['user' => $this->app['user'],
                              'podcast' => 'podcast_object'])
                      ->will($this->returnValue('render_template'));
    $response = $this->controller->default_page($this->app);
    $this->assertEquals('render_template', $response);
  }

  public function test_donation(){
    $this->app['user'] = 'user_object';
    $this->app['twig']->expects($this->once())
                      ->method('render')
                      ->with('donation.tpl', ['user' => $this->app['user']])
                      ->will($this->returnValue('render_template'));
    $response = $this->controller->donation($this->app);
    $this->assertEquals('render_template', $response);
  }

  public function test_online(){
    $this->app['user'] = 'user_object';
    $this->app['twig']->expects($this->once())
                      ->method('render')
                      ->with('online.tpl', ['user' => $this->app['user']])
                      ->will($this->returnValue('render_template'));
    $response = $this->controller->online($this->app);
    $this->assertEquals('render_template', $response);
  }
}