<?php namespace app\controllers;

use app\domain\podcast;
use RuntimeException;
use Silex\Application;
use Symfony\Component\HttpFoundation\Request;

class podcasts{

  public function default_page(Application $app){
    $podcasts = $app['em']->getRepository('\app\domain\podcast')
                          ->findBy([], ['time' => 'DESC']);
    return $app['twig']->render('podcasts\default_page.tpl',
                            ['user' => $app['user'], 'podcasts' => $podcasts]);
  }

  public function change_podcast(Request $request, Application $app){
    $podcast = $app['em']->getRepository('\app\domain\podcast')
                         ->find($request->get('id'));
    if(is_null($podcast))
      throw new RuntimeException();
    $oldPodcast = $app['em']->getRepository('\app\domain\podcast')
                            ->findOneByshowPodcast("1");
    if(!is_null($oldPodcast))
      $oldPodcast->set_showPodcast("0");
    $podcast->set_showPodcast("1");
    $app['em']->flush();
    $podcasts = $app['em']->getRepository('\app\domain\podcast')
                          ->findBy([], ['time' => 'DESC']);
    return $app['twig']->render('podcasts/podcast-list.tpl',
                            ['user' => $app['user'], 'podcasts' => $podcasts]);
  }

  public function delete_podcast(Request $request, Application $app){
    $id = null;
    $podcast = $app['em']->find('\app\domain\podcast',
                                $request->query->get('podcast_id'));
    if($app['user']->isPodcastAdmin()){
      foreach ($podcast->get_news() as $news) {
        $podcast->get_news()->removeElement($news);
        $news->set_podcast(null);
      }
      $id = $podcast->get_time();
      $app['em']->remove($podcast);
      $app['em']->flush();
    }
    return $app['twig']->render('podcasts\delete_podcast.tpl', ['id' => $id]);
  }

  public function get_dialog_edit_podcast(Request $request, Application $app){
    $podcast = $app['em']->getRepository('\app\domain\podcast')
                         ->find($request->get('podcast_id'));
    $news = $app['em']->getRepository('\app\domain\news')->findByPodcast(null);
    return $app['twig']->render('podcasts\get_dialog_edit_podcast.tpl',
                                ['user' => $app['user'], 'podcast' => $podcast,
                                 'news' => $news]);
  }

  public function get_dialog_new_podcast(Application $app){
    return $app['twig']->render('podcasts\get_dialog_new_podcast.tpl');
  }

  public function edit_podcast(Request $request, Application $app){
    $podcast = $app['em']->find('\app\domain\podcast',
                                $request->request->get('id'));
    if($app['user']->isPodcastAdmin()){
      $dtime = \DateTime::createFromFormat("d.m.Y H:i:s",
                                  $request->request->get('time').' 00:00:00');
      $timestamp = $dtime->getTimestamp();
      foreach ($podcast->get_news() as $news) {
        $podcast->get_news()->removeElement($news);
        $news->set_podcast(null);
      }
      if($podcast->get_time() != $timestamp) {
        $show = $podcast->get_showPodcast();
        $app['em']->remove($podcast);
        $podcast = new podcast();
        $podcast->set_showPodcast($show);
      }
      foreach ($request->request->get('podcasts') as $id) {
        $news = $app['em']->find('\app\domain\news', $id);
        $news->set_podcast($podcast);
        $podcast->add_news($news);
      }
      $podcast->set_time($timestamp);
      $podcast->set_name($request->request->get('title'));
      $podcast->set_alias($request->request->get('alias'));
      $podcast->set_url($request->request->get('url'));
      $app['em']->persist($podcast);
      $app['em']->flush();
    }
    return $app['twig']->render('podcasts/podcast.tpl',
                              ['user' => $app['user'], 'podcast' => $podcast]);
  }

  public function save_podcast(Request $request, Application $app){
    $dtime = \DateTime::createFromFormat("d.m.Y H:i:s",
                                         $request->get('time').' 00:00:00');
    $timestamp = $dtime->getTimestamp();
    $podcast = new \app\domain\podcast();
    $podcast->set_time($timestamp);
    $podcast->set_name($request->get('title'));
    $podcast->set_alias($request->get('alias'));
    $podcast->set_url($request->get('url'));
    $podcast->set_file_url($request->get('file'));
    $app['em']->persist($podcast);
    $app['em']->flush();
    return $app['twig']->render('podcasts\podcast.tpl',
                                ['user' => $app['user'],
                                 'podcast' => $podcast]);
  }
}