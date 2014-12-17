<?php namespace app\controllers;

use app\domain\podcast;
use RuntimeException;
use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class podcasts{

  public function default_page(Application $app){
    $podcasts = $app['em']->getRepository('\app\domain\podcast')
                          ->findBy([], ['time' => 'DESC']);
    return $app['twig']->render('podcasts\default_page.tpl',
                                ['user' => $app['user'],
                                 'podcasts' => $podcasts]);
  }

  public function change_podcast(Request $request, Application $app){
    $podcast = $app['em']->getRepository('\app\domain\podcast')
                         ->find($request->get('id'));
    if(is_null($podcast))
      throw new RuntimeException();
    $oldPodcast = $app['em']->getRepository('\app\domain\podcast')
                            ->findOneByshowPodcast("1");
    if(!is_null($oldPodcast))
      $oldPodcast->set_showPodcast(0);
    $podcast->set_showPodcast(1);
    $app['em']->flush();
    $podcasts = $app['em']->getRepository('\app\domain\podcast')
                          ->findBy([], ['time' => 'DESC']);
    return $app['twig']->render('podcasts/podcast-list.tpl',
                                ['user' => $app['user'],
                                 'podcasts' => $podcasts]);
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
      $id = $podcast->get_id();
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
      $podcast->set_time($timestamp);
      $podcast->set_name($request->request->get('title'));
      $podcast->set_alias($request->request->get('alias'));
      $podcast->set_url($request->request->get('url'));
      $podcast->set_file_url($request->get('file'));
      $podcast->set_shownotes($request->get('shownotes'));
      foreach ($podcast->get_news() as $news) {
        $podcast->get_news()->removeElement($news);
        $news->set_podcast(null);
      }
      if($request->request->get('news')) {
        foreach ($request->request->get('news') as $id) {
          $news = $app['em']->find('\app\domain\news', $id);
          $news->set_podcast($podcast);
          $podcast->add_news($news);
        }
      }
      $app['em']->persist($podcast);
      $app['em']->flush();
    }
    return $app['twig']->render('podcasts/podcast.tpl',
                              ['user' => $app['user'], 'podcast' => $podcast]);
  }

  public function create_podcast(Request $request, Application $app){
    $dtime = \DateTime::createFromFormat("d.m.Y H:i:s",
                                         $request->get('time').' 00:00:00');
    $timestamp = $dtime->getTimestamp();
    $podcast = new podcast();

    $podcast->set_time($timestamp);
    $podcast->set_name($request->get('title'));
    $podcast->set_alias($request->get('alias'));
    $podcast->set_url($request->get('url'));
    $podcast->set_file_url($request->get('file'));
    $podcast->set_shownotes($request->get('shownotes'));
    $app['em']->persist($podcast);
    $app['em']->flush();
    return $app['twig']->render('podcasts\podcast.tpl',
                                ['user' => $app['user'],
                                 'podcast' => $podcast]);
  }

  public function show_podcast($alias, Application $app){
    $podcast = $app['em']->getRepository('\app\domain\podcast')
                         ->findOneByAlias($alias);
    if(is_null($podcast))
      throw new NotFoundHttpException();
    $comments = $app['em']->getRepository('\app\domain\comment')
        ->getRootNodesByPodcast($podcast, 'time', 'desc');
    return $app['twig']->render('podcasts/show_podcast.tpl',
        ['user' => $app['user'], 'podcast' => $podcast, 'comments' => $comments]);
  }

  public function add_comment($alias, Request $request, Application $app) {
    $podcast = $app['em']->getRepository('\app\domain\podcast')
        ->findOneByAlias($alias);
    if(is_null($podcast))
      throw new NotFoundHttpException();
    if(is_null($app['user']))
      throw new RuntimeException();
    $comment = new \app\domain\comment();
    $comment->set_text($request->request->get('text'));
    $comment->set_time(time());
    $comment->set_user($app['user']);
    $comment->set_podcast($podcast);
    $parent_id = $request->request->get('parent_id');
    if(!empty($parent_id)) {
      $id = explode('-', $parent_id)[1];
      $parent = $app['em']->getRepository('\app\domain\comment')
                          ->find($id);
      if(is_null($parent)) {
        throw new RuntimeException();
      }
      $comment->set_parent($parent);
    }
    $app['em']->persist($comment);
    $app['em']->flush();
    $sort = $request->request->get('sort');
    $comments = $app['em']->getRepository('\app\domain\comment')
        ->getRootNodesByPodcast($podcast, 'time', $sort);
    $template = $app['twig']->render('comments/commentsList.tpl',['comments' => $comments,
                                                                  'user'=>$app['user']]);
    return $app->json(['template' => $template, 'count'=>$podcast->get_comments()->count()]);
  }

  public function get_comments($alias, Request $request, Application $app){
    $podcast = $app['em']->getRepository('\app\domain\podcast')
        ->findOneByAlias($alias);
    if(is_null($podcast))
      throw new NotFoundHttpException();
    if(is_null($app['user']))
      throw new RuntimeException();
    $sort = $request->query->get('sort');
    $comments = $app['em']->getRepository('\app\domain\comment')
        ->getRootNodesByPodcast($podcast, 'time', $sort);
    $template = $app['twig']->render('comments/commentsList.tpl',['comments' => $comments,
                                                                  'user'=>$app['user']]);
    return $app->json(['template' => $template, 'count'=>$podcast->get_comments()->count()]);
  }
}