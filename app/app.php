<?php namespace app;

use Doctrine\Common\Annotations\AnnotationReader;
use Doctrine\Common\Annotations\CachedReader;
use Doctrine\Common\Cache\ArrayCache;
use Doctrine\Common\EventManager;
use Doctrine\Common\Persistence\Mapping\Driver\MappingDriverChain;
use \Doctrine\ORM\Tools\Setup;
use \Doctrine\ORM\EntityManager;
use Gedmo\DoctrineExtensions;
use Gedmo\Tree\TreeListener;
use \Silex\Application;
use \Silex\Provider\TwigServiceProvider;
use \Silex\Provider\SwiftmailerServiceProvider;
use \Symfony\Component\HttpFoundation\Request;
use \Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use \app\conf;
$DS = DIRECTORY_SEPARATOR;
$root = substr(__DIR__, 0, (strlen(__DIR__) - strlen($DS.'app'))).$DS;
require_once($root."vendor/autoload.php");

$app = new Application();
$app['debug'] = (conf::status === 'development')? true: false;
$app['salt'] = conf::auth_salt;
$app['host'] = conf::host;

// globally used cache driver, in production use APC or memcached
$cache = new ArrayCache;
// standard annotation reader
$annotationReader = new AnnotationReader;
$cachedAnnotationReader = new CachedReader(
    $annotationReader, // use reader
    $cache // and a cache driver
);
// create a driver chain for metadata reading
$driverChain = new MappingDriverChain();
// load superclass metadata mapping only, into driver chain
// also registers Gedmo annotations.NOTE: you can personalize it
DoctrineExtensions::registerAbstractMappingIntoDriverChainORM(
    $driverChain, // our metadata driver chain, to hook into
    $cachedAnnotationReader // our cached annotation reader
);

$dbParams = array(
  'driver'   => 'pdo_mysql',
  'host'     => conf::db_host,
  'user'     => conf::db_user,
  'password' => conf::db_password,
  'dbname'   => conf::db_name,
  'charset'  => 'utf8'
);

$config = Setup::createAnnotationMetadataConfiguration(
    array(__DIR__),
    $app['debug'],
    $root.conf::doctrine_proxy_path
);

$evm = new EventManager();
// tree
$treeListener = new TreeListener;
$treeListener->setAnnotationReader($cachedAnnotationReader);
$evm->addEventSubscriber($treeListener);

$app['em'] = EntityManager::create($dbParams, $config, $evm);

$app['swiftmailer.options'] = array(
    'host' => conf::smtp_server,
    'port' => conf::smtp_port,
    'username' => conf::smtp_user,
    'password' => conf::smtp_password,
    'encryption' => conf::smtp_encryption,
    'auth_mode' => null
);

if($app['debug']){
  $twig_conf = ['twig.path' => $root.'/templates'];
}else{
  $cache = $root.$DS.'cache'.$DS.'twig'.$DS;
  $twig_conf = ['twig.path' => $root.'/templates',
                'twig.options' => ['cache' => $cache]];
}

$app->register(new TwigServiceProvider(), $twig_conf);
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
          'app\\controllers\\podcasts::create_podcast');
$app->get('/podcasts/delete_podcast/',
          'app\\controllers\\podcasts::delete_podcast');
$app->get('/podcasts/{alias}/',
          'app\\controllers\\podcasts::show_podcast');
#comments
$app->post('/podcasts/{alias}/comment/',
          'app\\controllers\\podcasts::add_comment');
$app->get('/podcasts/{alias}/comment/',
          'app\\controllers\\podcasts::get_comments');
$app->put('/podcasts/{alias}/comment/{id}/delete/',
          'app\\controllers\\podcasts::delete_comment');
$app->put('/podcasts/{alias}/comment/{id}/recovery/',
          'app\\controllers\\podcasts::recovery_comment');
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
# errorhandlers
$app->error(function (NotFoundHttpException $e) use ($app){
  return $app['twig']->render('404.tpl', ['user' => $app['user']]);
});
$app->run();