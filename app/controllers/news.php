<?php namespace app\controllers;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;

class news{

  public function default_page(Request $request, Application $app){
    $news = $app['em']->getRepository('\app\domain\news')->findByPodcast(null);
    return $app['twig']->render('news\default_page.tpl',
                                ['user' => $app['user'], 'news' => $news]);
  }

  public function delete_news(Request $request, Application $app){
    $news = $app['em']->find('\app\domain\news', $request->query->get('news_id'));
    if($news->get_user() == $app['user'] or $app['user']->isNewsAdmin()){
      $app['em']->remove($news);
      $app['em']->flush();
    }
    return $app['twig']->render('news\delete_news.tpl',
                                ['id' => $news->get_id()]);
  }

  public function get_dialog_edit_news(Request $request, Application $app){
    $news = $app['em']->find('\app\domain\news',
                             $request->query->get('news_id'));
    return $app['twig']->render('news\get_dialog_edit_news.tpl',
                                ['news' => $news]);
  }

  public function get_dialog_new_news(Request $request, Application $app){
    return $app['twig']->render('news\get_dialog_new_news.tpl');
  }

  public function edit_news(Request $request, Application $app){
    $news = $app['em']->find('\app\domain\news', $request->request->get('id'));
    if($news->get_user() == $app['user'] or $app['user']->isNewsAdmin()){
      $news->set_title($request->request->get('title'));
      $news->set_description($request->request->get('description'));
      $app['em']->flush();
    }
    return $app['twig']->render('news/news-item.tpl',
                                ['user' => $app['user'], 'item' => $news]);
  }

  public function change_rating(Request $request, Application $app){
    $news = $app['em']->find('\app\domain\news', $request->query->get('news_id'));
    $user = $app['user'];
    if(!$news->get_votes()->contains($user) || $user->isNewsAdmin()){
      $rating = (int) $news->get_rating();
      $news->get_votes()->add($user);
      switch($request->query->get('number')){
        case 'up':
          $news->set_rating(++$rating);
          break;
        case 'down':
          $news->set_rating(--$rating);
          break;
      }
      $app['em']->persist($news);
      $app['em']->flush();
    }
    return $app['twig']->render('news\change_rating.tpl', ['news' => $news]);
  }

  public function save_news(Request $request, Application $app){
    $news = new \app\domain\news();
    $news->set_title($request->query->get('title'));
    $news->set_description($request->query->get('description'));
    $news->set_user($app['user']);
    $news->set_pubtime(time());
    $app['em']->persist($news);
    $app['em']->flush();
    return $app['twig']->render('news/news-item.tpl',
                                ['user' => $app['user'], 'item' => $news]);
  }
}