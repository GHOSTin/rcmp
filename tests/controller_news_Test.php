<?php

use Silex\Application;
use app\controllers\news as controller;
use Symfony\Component\HttpFoundation\Request;
use app\domain\user;
use app\domain\news;

class controller_news_Test extends PHPUnit_Framework_TestCase{

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
                       ->setMethods(['findByPodcast'])
                       ->getMock();
    $repository->expects($this->once())
               ->method('findByPodcast')
               ->with(null)
               ->will($this->returnValue('news_array'));
    $this->app['em']->expects($this->once())
                    ->method('getRepository')
                    ->with('\app\domain\news')
                    ->will($this->returnValue($repository));
    $this->app['user'] = 'user_object';
    $this->app['twig']->expects($this->once())
                      ->method('render')
                      ->with('news\default_page.tpl',
                             ['user' => 'user_object', 'news' => 'news_array'])
                      ->will($this->returnValue('render_template'));
    $response = $this->controller->default_page($this->app);
    $this->assertEquals('render_template', $response);
  }

  public function test_delete_news_1(){
    $this->request->query->set('news_id', 123);
    $user = new user();
    $news = new news();
    $news->set_id(254);
    $news->set_user($user);
    $this->app['user'] = $user;
    $repository = $this->getMockBuilder('Doctrine\ORM\EntityRepository')
                       ->disableOriginalConstructor()
                       ->setMethods(['find'])
                       ->getMock();
    $repository->expects($this->once())
               ->method('find')
               ->with(123)
               ->will($this->returnValue($news));
    $this->app['em']->expects($this->once())
                    ->method('getRepository')
                    ->with('\app\domain\news')
                    ->will($this->returnValue($repository));
    $this->app['em']->expects($this->once())
                    ->method('remove')
                    ->with($this->isInstanceOf('\app\domain\news'));
    $this->app['em']->expects($this->once())
                    ->method('flush');
    $this->app['twig']->expects($this->once())
                      ->method('render')
                      ->with('news\delete_news.tpl',
                             ['id' => 254])
                      ->will($this->returnValue('render_template'));
    $response = $this->controller->delete_news($this->request, $this->app);
    $this->assertEquals('render_template', $response);
  }

  public function test_delete_news_2(){
    $this->request->query->set('news_id', 123);
    $admin = $this->getMock('\app\domain\user');
    $admin->expects($this->once())
          ->method('isNewsAdmin')
          ->will($this->returnValue(true));
    $user = new user();
    $user->set_id(2);
    $news = new news();
    $news->set_id(254);
    $news->set_user($user);
    $this->app['user'] = $admin;
    $repository = $this->getMockBuilder('Doctrine\ORM\EntityRepository')
                       ->disableOriginalConstructor()
                       ->setMethods(['find'])
                       ->getMock();
    $repository->expects($this->once())
               ->method('find')
               ->with(123)
               ->will($this->returnValue($news));
    $this->app['em']->expects($this->once())
                    ->method('getRepository')
                    ->with('\app\domain\news')
                    ->will($this->returnValue($repository));
    $this->app['em']->expects($this->once())
                    ->method('remove')
                    ->with($this->isInstanceOf('\app\domain\news'));
    $this->app['em']->expects($this->once())
                    ->method('flush');
    $this->app['twig']->expects($this->once())
                      ->method('render')
                      ->with('news\delete_news.tpl',
                             ['id' => 254])
                      ->will($this->returnValue('render_template'));
    $response = $this->controller->delete_news($this->request, $this->app);
    $this->assertEquals('render_template', $response);
  }

  public function test_delete_news_3(){
    $this->request->query->set('news_id', 123);
    $admin = $this->getMock('\app\domain\user');
    $admin->expects($this->once())
          ->method('isNewsAdmin')
          ->will($this->returnValue(false));
    $user = new user();
    $user->set_id(2);
    $news = new news();
    $news->set_id(254);
    $news->set_user($user);
    $this->app['user'] = $admin;
    $repository = $this->getMockBuilder('Doctrine\ORM\EntityRepository')
                       ->disableOriginalConstructor()
                       ->setMethods(['find'])
                       ->getMock();
    $repository->expects($this->once())
               ->method('find')
               ->with(123)
               ->will($this->returnValue($news));
    $this->app['em']->expects($this->once())
                    ->method('getRepository')
                    ->with('\app\domain\news')
                    ->will($this->returnValue($repository));
    $this->app['em']->expects($this->never())
                    ->method('remove');
    $this->app['em']->expects($this->never())
                    ->method('flush');
    $this->app['twig']->expects($this->once())
                      ->method('render')
                      ->with('news\delete_news.tpl',
                             ['id' => 254])
                      ->will($this->returnValue('render_template'));
    $response = $this->controller->delete_news($this->request, $this->app);
    $this->assertEquals('render_template', $response);
  }

  public function test_get_dialog_edit_news(){
    $this->request->query->set('news_id', 123);
    $repository = $this->getMockBuilder('Doctrine\ORM\EntityRepository')
                       ->disableOriginalConstructor()
                       ->setMethods(['find'])
                       ->getMock();
    $repository->expects($this->once())
               ->method('find')
               ->with(123)
               ->will($this->returnValue('news_object'));
    $this->app['em']->expects($this->once())
                    ->method('getRepository')
                    ->with('\app\domain\news')
                    ->will($this->returnValue($repository));
    $this->app['twig']->expects($this->once())
                      ->method('render')
                      ->with('news\get_dialog_edit_news.tpl',
                             ['news' => 'news_object'])
                      ->will($this->returnValue('render_template'));
    $response = $this->controller->get_dialog_edit_news($this->request,
                                                        $this->app);
    $this->assertEquals('render_template', $response);
  }

  public function test_get_dialog_new_news(){
    $this->app['twig']->expects($this->once())
                      ->method('render')
                      ->with('news\get_dialog_new_news.tpl')
                      ->will($this->returnValue('render_template'));
    $response = $this->controller->get_dialog_new_news($this->app);
    $this->assertEquals('render_template', $response);
  }

  public function test_edit_news_1(){
    $this->request->query->set('id', 123);
    $this->request->query->set('title', 'Тайтл');
    $this->request->query->set('description', 'Описание');
    $user = new user();
    $news = new news();
    $news->set_user($user);
    $this->app['user'] = $user;
    $repository = $this->getMockBuilder('Doctrine\ORM\EntityRepository')
                       ->disableOriginalConstructor()
                       ->setMethods(['find'])
                       ->getMock();
    $repository->expects($this->once())
               ->method('find')
               ->with(123)
               ->will($this->returnValue($news));
    $this->app['em']->expects($this->once())
                    ->method('getRepository')
                    ->with('\app\domain\news')
                    ->will($this->returnValue($repository));
    $this->app['em']->expects($this->once())
                    ->method('flush');
    $this->app['twig']->expects($this->once())
                      ->method('render')
                      ->with('news\news-item.tpl',
                             ['user' => $user, 'item' => $news])
                      ->will($this->returnValue('render_template'));
    $response = $this->controller->edit_news($this->request, $this->app);
    $this->assertEquals('render_template', $response);
  }

  public function test_edit_news_2(){
    $this->request->query->set('id', 123);
    $this->request->query->set('title', 'Тайтл');
    $this->request->query->set('description', 'Описание');
    $admin = $this->getMock('\app\domain\user');
    $admin->expects($this->once())
          ->method('isNewsAdmin')
          ->will($this->returnValue(true));
    $user = new user();
    $news = new news();
    $news->set_user($user);
    $this->app['user'] = $admin;
    $repository = $this->getMockBuilder('Doctrine\ORM\EntityRepository')
                       ->disableOriginalConstructor()
                       ->setMethods(['find'])
                       ->getMock();
    $repository->expects($this->once())
               ->method('find')
               ->with(123)
               ->will($this->returnValue($news));
    $this->app['em']->expects($this->once())
                    ->method('getRepository')
                    ->with('\app\domain\news')
                    ->will($this->returnValue($repository));
    $this->app['em']->expects($this->once())
                    ->method('flush');
    $this->app['twig']->expects($this->once())
                      ->method('render')
                      ->with('news\news-item.tpl',
                             ['user' => $admin, 'item' => $news])
                      ->will($this->returnValue('render_template'));
    $response = $this->controller->edit_news($this->request, $this->app);
    $this->assertEquals('render_template', $response);
  }

  public function test_edit_news_3(){
    $this->request->query->set('id', 123);
    $this->request->query->set('title', 'Тайтл');
    $this->request->query->set('description', 'Описание');
    $admin = $this->getMock('\app\domain\user');
    $admin->expects($this->once())
          ->method('isNewsAdmin')
          ->will($this->returnValue(false));
    $user = new user();
    $news = new news();
    $news->set_user($user);
    $this->app['user'] = $admin;
    $repository = $this->getMockBuilder('Doctrine\ORM\EntityRepository')
                       ->disableOriginalConstructor()
                       ->setMethods(['find'])
                       ->getMock();
    $repository->expects($this->once())
               ->method('find')
               ->with(123)
               ->will($this->returnValue($news));
    $this->app['em']->expects($this->once())
                    ->method('getRepository')
                    ->with('\app\domain\news')
                    ->will($this->returnValue($repository));
    $this->app['em']->expects($this->never())
                    ->method('flush');
    $this->app['twig']->expects($this->once())
                      ->method('render')
                      ->with('news\news-item.tpl',
                             ['user' => $admin, 'item' => $news])
                      ->will($this->returnValue('render_template'));
    $response = $this->controller->edit_news($this->request, $this->app);
    $this->assertEquals('render_template', $response);
  }

  public function test_save_news(){
    $this->request->query->set('title', 'Тайтл');
    $this->request->query->set('description', 'Описание');
    $this->app['em']->expects($this->once())
                    ->method('flush');
    $this->app['em']->expects($this->once())
                    ->method('persist')
                    ->with($this->isInstanceOf('\app\domain\news'));
    $this->app['user'] = new user();
    $this->app['twig']->expects($this->once())
                      ->method('render')
                      ->will($this->returnValue('render_template'));
    $response = $this->controller->save_news($this->request, $this->app);
    $this->assertEquals('render_template', $response);
  }
}