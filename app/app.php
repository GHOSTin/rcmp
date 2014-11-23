<?php namespace app;

use \Doctrine\ORM\Tools\Setup;
use \Doctrine\ORM\EntityManager;
use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use Silex\Provider\TwigServiceProvider;
use \app\conf;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use \Silex\Provider\SwiftmailerServiceProvider;

$root = substr(__DIR__, 0, (strlen(__DIR__) - strlen(DIRECTORY_SEPARATOR.'app'))).DIRECTORY_SEPARATOR;
require_once($root."vendor/autoload.php");

$app = new Application();
if(conf::status === 'development')
  $app['debug'] = true;

$paths = array(__DIR__);
$isDevMode = (conf::status == 'development')? true: false;
$dbParams = array(
  'driver'   => 'pdo_mysql',
  'host'     => conf::db_host,
  'user'     => conf::db_user,
  'password' => conf::db_password,
  'dbname'   => conf::db_name,
  'charset'  => 'utf8'
);

$config = Setup::createAnnotationMetadataConfiguration($paths, $isDevMode);
$app['em'] = EntityManager::create($dbParams, $config);

$app['swiftmailer.options'] = array(
    'host' => conf::smtp_server,
    'port' => conf::smtp_port,
    'username' => conf::smtp_user,
    'password' => conf::smtp_password,
    'encryption' => conf::smtp_encryption,
    'auth_mode' => null
);


$app->register(new TwigServiceProvider(), array(
  'twig.path' => $root.'/templates',
));

$app->register(new SwiftmailerServiceProvider());

$app['twig']->addExtension(new BBCodeExtension());
$app['twig']->addExtension(new \Jasny\Twig\PcreExtension());
$app['twig']->addExtension(new \Jasny\Twig\TextExtension());

$app->before(function (Request $request, Application $app) {
  $uid = $request->cookies->get('uid');
  if(isset($uid)){
    $session = $app['em']->find('\app\domain\session', $_COOKIE['uid']);
    if(is_null($session)){
      setcookie("uid", "", time() - 3600, '/');
      $app['user'] = null;
    }else
      $app['user'] = $session->get_user();
  }else
    $app['user'] = null;
}, Application::EARLY_EVENT);

$app->get('/', 'app\\controllers\\default_page::default_page');
$app->get('/enter/', 'app\\controllers\\login::enter');
$app->post('/login/', 'app\\controllers\\login::login');
$app->get('/logout/', 'app\\controllers\\login::logout');
$app->get('/password/', 'app\\controllers\\login::password');
$app->post('/password/recovery/', 'app\\controllers\\login::recovery');
$app->get('/new_user/', 'app\\controllers\\login::new_user');
$app->post('/registration/', 'app\\controllers\\login::registration');
$app->get('/donation/', 'app\\controllers\\default_page::donation');
$app->get('/online/', 'app\\controllers\\default_page::online');
# podcast
$app->get('/podcasts/', 'app\\controllers\\podcasts::default_page');
$app->post('/podcasts/change_showing_podcast/',
            'app\\controllers\\podcasts::change_podcast');
$app->post('/podcasts/edit_podcast/',
            'app\\controllers\\podcasts::edit_podcast');
$app->get('/podcasts/get_dialog_edit_podcast/',
          'app\\controllers\\podcasts::get_dialog_edit_podcast');
$app->get('/podcasts/get_dialog_new_podcast/',
          'app\\controllers\\podcasts::get_dialog_new_podcast');
$app->get('/podcasts/save_podcast/',
          'app\\controllers\\podcasts::save_podcast');
$app->get('/podcasts/delete_podcast/',
          'app\\controllers\\podcasts::delete_podcast');
# news
$app->get('/news/', 'app\\controllers\\news::default_page');
$app->get('/news/delete_news/', 'app\\controllers\\news::delete_news');
$app->get('/news/get_dialog_edit_news/',
          'app\\controllers\\news::get_dialog_edit_news');
$app->post('/news/edit_news/', 'app\\controllers\\news::edit_news');
$app->get('/news/change_rating/', 'app\\controllers\\news::change_rating');
$app->get('/news/get_dialog_new_news/',
          'app\\controllers\\news::get_dialog_new_news');
$app->get('/news/save_news/',
          'app\\controllers\\news::save_news');
# api
$app->post('/api/get_show_podcast/',
          'app\\controllers\\api::get_show_podcast');
$app->get('/api/{api_key}/get_user_info/',
          'app\\controllers\\api::get_user_info');
$app->get('/api/{api_key}/get_user_list/',
          'app\\controllers\\api::get_user_list');

$app->error(function (NotFoundHttpException $e, $code) use ($app){
    return $app['twig']->render('404.tpl', ['user' => $app['user']]);
});
$app->run();