<?php namespace app\controllers;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Cookie;
use \app\conf;

class login{

  public function enter(Request $request, Application $app){
    return $app['twig']->render('login\enter.tpl', ['user' => $app['user']]);
  }

  public function new_user(Request $request, Application $app){
    return $app['twig']->render('login\new_user.tpl', ['user' => $app['user']]);
  }

  public function password(Request $request, Application $app){
    return $app['twig']->render('login\password.tpl', ['user' => $app['user']]);
  }

  public function registration(Request $request, Application $app){
    $nickname = trim($request->request->get('nickname'));
    $email = trim($request->request->get('email'));
    $password = trim($request->request->get('password'));
    if(!is_null($app['em']->getRepository('\app\domain\user')
                          ->findOneBy(array('email' => $email)))){
      return $app['twig']->render('login\login_busy.tpl', ['user' => $app['user']]);
    }
    $user = new \app\domain\user();
    $user->set_email($email);
    $user->set_nickname($nickname);
    $user->set_hash(sha1(md5($password.conf::auth_salt)));
    $app['em']->persist($user);
    $app['em']->flush();
    return $app->redirect('/');
  }

  public function login(Request $request, Application $app){
    $user = $app['em']->getRepository('\app\domain\user')
                      ->findOneByEmail($request->request->get('login'));
    if(!is_null($user)){
      $hash = sha1(md5($request->request->get('password').conf::auth_salt));
      if($user->get_hash() === $hash){
        $session = new \app\domain\session();
        $key = sha1($user->get_id().$user->get_nickname().$user->get_email().time());
        $session->set_session($key);
        $session->set_user($user);
        $app['em']->persist($session);
        $response = new RedirectResponse('/');
        $cookie = new Cookie('uid', $session->get_session(),
                             strtotime('+30 days'), '/', conf::host);
        $response->headers->setCookie($cookie);
        $app['em']->flush();
        return $response;
      }
    }
    return $app['twig']->render('login\bad_login.tpl', ['user' => $app['user']]);
  }

  public function recovery(Request $request, Application $app){
    $user = $app['em']->getRepository('\app\domain\user')
                ->findOneBy(array('email' => $request->request->get('login')));
    if(is_null($user))
      return $app['twig']->render('login\no_user_email.tpl',
                                  ['user' => $app['user']]);
    $password = substr(str_shuffle(sha1(time())), 0, 8);
    $user->set_hash(sha1(md5($password.conf::auth_salt)));
    $app['em']->persist($user);
    $app['em']->flush();
    $message = \Swift_Message::newInstance()
      ->setSubject('RCMP recovery password')
      ->setFrom(array('nekrasov@mlsco.ru'))
      ->setTo(array($user->get_email()))
      ->setBody('Ваш новый пароль: '.$password);
    $app['mailer']->send($message);
    return $app['twig']->render('login\recovery_success.tpl',
                                ['user' => $app['user']]);
  }

  public function logout(Request $request, Application $app){
    $session = $app['em']->find('\app\domain\session',
                                $request->cookies->get('uid'));
    if(!is_null($session)){
      $app['em']->remove($session);
      $app['em']->flush();
    }
    $response = new RedirectResponse('/');
    $response->headers->clearCookie('uid', '/', conf::host);
    return $response;
  }
}