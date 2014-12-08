<?php

use Silex\Application;
use app\controllers\podcasts as controller;
use Symfony\Component\HttpFoundation\Request;

class controller_podcast_Test extends PHPUnit_Framework_TestCase{

  public function setUp(){
    $twig = $this->getMockBuilder('\Twig_Environment')
                 ->disableOriginalConstructor()->getMock();
    $em = $this->getMockBuilder('\Doctrine\ORM\EntityManager')
               ->disableOriginalConstructor()->getMock();
    $this->app = new Application();
    $this->controller = new controller();
    $this->request = new Request();
    $this->app['twig'] = $twig;
    $this->app['em'] = $em;
  }

  public function test_default_page(){
    $repository = $this->getMockBuilder('Doctrine\ORM\EntityRepository')
                       ->disableOriginalConstructor()
                       ->setMethods(['findBy'])
                       ->getMock();
    $repository->expects($this->once())
               ->method('findBy')
               ->with([], ['time' => 'DESC'])
               ->will($this->returnValue('podcast_array'));
    $this->app['em']->expects($this->once())
                    ->method('getRepository')
                    ->with('\app\domain\podcast')
                    ->will($this->returnValue($repository));
    $this->app['user'] = 'user_object';
    $this->app['twig']->expects($this->once())
                      ->method('render')
                      ->with('podcasts\default_page.tpl',
                             ['user' => 'user_object',
                              'podcasts' => 'podcast_array'])
                      ->will($this->returnValue('render_template'));
    $response = $this->controller->default_page($this->app);
    $this->assertEquals('render_template', $response);
  }

  public function test_change_podcast_1(){
    $this->setExpectedException('RuntimeException');
    $this->request->query->set('id', 123);
    $repository = $this->getMockBuilder('Doctrine\ORM\EntityRepository')
                       ->disableOriginalConstructor()
                       ->setMethods(['find'])
                       ->getMock();
    $repository->expects($this->once())
               ->method('find')
               ->with(123)
               ->will($this->returnValue(null));
    $this->app['em']->expects($this->once())
                    ->method('getRepository')
                    ->with('\app\domain\podcast')
                    ->will($this->returnValue($repository));
    $response = $this->controller->change_podcast($this->request, $this->app);
  }

  public function test_change_podcast_2(){
    $this->request->query->set('id', 123);
    $podcast = $this->getMock('\app\domain\podcast');
    $podcast->expects($this->once())
            ->method('set_showPodcast')
            ->with("1");
    $repository = $this->getMockBuilder('Doctrine\ORM\EntityRepository')
                       ->disableOriginalConstructor()
                       ->setMethods(['find', 'findOneByshowPodcast',
                                     'findBy'])
                       ->getMock();
    $repository->expects($this->once())
               ->method('find')
               ->with(123)
               ->will($this->returnValue($podcast));
    $repository->expects($this->once())
               ->method('findOneByshowPodcast')
               ->with('1')
               ->will($this->returnValue(null));
    $repository->expects($this->once())
               ->method('findBy')
               ->with([], ['time' => 'DESC'])
               ->will($this->returnValue('podcast_array'));
    $this->app['em']->expects($this->exactly(3))
                    ->method('getRepository')
                    ->with('\app\domain\podcast')
                    ->will($this->returnValue($repository));
    $this->app['em']->expects($this->once())
                    ->method('flush');
    $this->app['user'] = 'user_object';
    $this->app['twig']->expects($this->once())
                      ->method('render')
                      ->with('podcasts/podcast-list.tpl',
                             ['user' => 'user_object',
                              'podcasts' => 'podcast_array'])
                      ->will($this->returnValue('render_template'));
    $response = $this->controller->change_podcast($this->request, $this->app);
    $this->assertEquals('render_template', $response);
  }

  public function test_change_podcast_3(){
    $this->request->query->set('id', 123);
    $podcast = $this->getMock('\app\domain\podcast');
    $podcast->expects($this->once())
            ->method('set_showPodcast')
            ->with("1");
    $old_podcast = $this->getMock('\app\domain\podcast');
    $old_podcast->expects($this->once())
                ->method('set_showPodcast')
                ->with("0");
    $repository = $this->getMockBuilder('Doctrine\ORM\EntityRepository')
                       ->disableOriginalConstructor()
                       ->setMethods(['find', 'findOneByshowPodcast',
                                     'findBy'])
                       ->getMock();
    $repository->expects($this->once())
               ->method('find')
               ->with(123)
               ->will($this->returnValue($podcast));
    $repository->expects($this->once())
               ->method('findOneByshowPodcast')
               ->with('1')
               ->will($this->returnValue($old_podcast));
    $repository->expects($this->once())
               ->method('findBy')
               ->with([], ['time' => 'DESC'])
               ->will($this->returnValue('podcast_array'));
    $this->app['em']->expects($this->exactly(3))
                    ->method('getRepository')
                    ->with('\app\domain\podcast')
                    ->will($this->returnValue($repository));
    $this->app['em']->expects($this->once())
                    ->method('flush');
    $this->app['user'] = 'user_object';
    $this->app['twig']->expects($this->once())
                      ->method('render')
                      ->with('podcasts/podcast-list.tpl',
                             ['user' => 'user_object',
                              'podcasts' => 'podcast_array'])
                      ->will($this->returnValue('render_template'));
    $response = $this->controller->change_podcast($this->request, $this->app);
    $this->assertEquals('render_template', $response);
  }

  public function test_get_dialog_edit_podcast(){
    $this->request->query->set('podcast_id', 123);
    $repository1 = $this->getMockBuilder('Doctrine\ORM\EntityRepository')
                       ->disableOriginalConstructor()
                       ->setMethods(['find'])
                       ->getMock();
    $repository1->expects($this->once())
                ->method('find')
                ->with(123)
                ->will($this->returnValue('podcast_object'));
    $repository2 = $this->getMockBuilder('Doctrine\ORM\EntityRepository')
                       ->disableOriginalConstructor()
                       ->setMethods(['findByPodcast'])
                       ->getMock();
    $repository2->expects($this->once())
                ->method('findByPodcast')
                ->with(null)
                ->will($this->returnValue('news_array'));
    $this->app['em']->expects($this->exactly(2))
                    ->method('getRepository')
                    ->withConsecutive(['\app\domain\podcast'],
                                      ['\app\domain\news'])
                    ->will($this->onConsecutiveCalls($repository1,
                                                     $repository2));
    $this->app['user'] = 'user_object';
    $this->app['twig']->expects($this->once())
                      ->method('render')
                      ->with('podcasts\get_dialog_edit_podcast.tpl',
                             ['user' => 'user_object',
                              'podcast' => 'podcast_object',
                              'news' => 'news_array'])
                      ->will($this->returnValue('render_template'));
    $response = $this->controller->get_dialog_edit_podcast($this->request,
                                                           $this->app);
    $this->assertEquals('render_template', $response);
  }

  public function test_get_dialog_new_podcast(){
    $this->app['twig']->expects($this->once())
                      ->method('render')
                      ->with('podcasts\get_dialog_new_podcast.tpl')
                      ->will($this->returnValue('render_template'));
    $response = $this->controller->get_dialog_new_podcast($this->app);
    $this->assertEquals('render_template', $response);
  }
}