<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application;

//TODO : update base url with production url
$hostBaseUrl = 'http://hpta.localhost';
$moduleName = 'Application';

return array(
    'hostBaseUrl' => $hostBaseUrl,
    'allowEdit' => 0,
    'router' => array(
        'routes' => array(
            'home' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route'    => '/',
                    'defaults' => array(
                        'controller' => 'Application\Controller\Route',
                        'action'     => 'index',
                    ),
                ),
            ),
            // The following is a route to simplify getting started creating
            // new controllers and actions without needing to create a new
            // module. Simply drop new controllers in, and you can access them
            // using the path /application/:controller/:action
            'application' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => "/$moduleName",
                    'defaults' => array(
                        '__NAMESPACE__' => 'Application\Controller',
                        'controller'    => 'auth',
                        'action'        => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'default' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'    => '/[:controller[/:action]]',
                            'constraints' => array(
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                            ),
                            'defaults' => array(
                            ),
                        ),
                    ),
                ),
            ),
            'login' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route'    => "/$moduleName/auth/login",
                    'defaults' => array(
                        'controller' => 'Application\Controller\Auth',
                        'action'     => 'login',
                    ),
                ),
            ),
            'logout' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route'    => "/$moduleName/auth/logout",
                    'defaults' => array(
                        'controller' => 'Application\Controller\Auth',
                        'action'     => 'logout',
                    ),
                ),
            ),
            'internal-routing' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route'    => "/$moduleName/route/index",
                    'defaults' => array(
                        'controller' => 'Application\Controller\Route',
                        'action'     => 'index',
                    ),
                ),
            ),
            'radar-list' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route'    => "/$moduleName/radar/getAllRadars",
                    'defaults' => array(
                        'controller' => 'Application\Controller\Radar',
                        'action'     => 'getAllRadars',
                    ),
                ),
            ),
            'radar-categories' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route'    => "/$moduleName/radar/getCategories",
                    'defaults' => array(
                        'controller' => 'Application\Controller\Radar',
                        'action'     => 'getCategories',
                    ),
                ),
            ),
            'radar-category-subcategories' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route'    => "/$moduleName/radar/getCategorySubcategories",
                    'defaults' => array(
                        'controller' => 'Application\Controller\Radar',
                        'action'     => 'getCategorySubcategories',
                    ),
                ),
            ),
            'question-add' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route'    => "/$moduleName/question/add",
                    'defaults' => array(
                        'controller' => 'Application\Controller\Question',
                        'action'     => 'add',
                    ),
                ),
            ),
            'question-update' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route'    => "/$moduleName/question/update",
                    'defaults' => array(
                        'controller' => 'Application\Controller\Question',
                        'action'     => 'update',
                    ),
                ),
            ),
            'question-delete' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route'    => "/$moduleName/question/delete",
                    'defaults' => array(
                        'controller' => 'Application\Controller\Question',
                        'action'     => 'delete',
                    ),
                ),
            ),
            'question-list' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route'    => "/$moduleName/question/list",
                    'defaults' => array(
                        'controller' => 'Application\Controller\Question',
                        'action'     => 'list',
                    ),
                ),
            ),
            'company-add' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route'    => "/$moduleName/company/add",
                    'defaults' => array(
                        'controller' => 'Application\Controller\Company',
                        'action'     => 'add',
                    ),
                ),
            ),
            'company-update' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route'    => "/$moduleName/company/update",
                    'defaults' => array(
                        'controller' => 'Application\Controller\Company',
                        'action'     => 'update',
                    ),
                ),
            ),
            'company-delete' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route'    => "/$moduleName/company/delete",
                    'defaults' => array(
                        'controller' => 'Application\Controller\Company',
                        'action'     => 'delete',
                    ),
                ),
            ),
            'company-list' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route'    => "/$moduleName/company/list",
                    'defaults' => array(
                        'controller' => 'Application\Controller\Company',
                        'action'     => 'list',
                    ),
                ),
            ),
            'team-add' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route'    => "/$moduleName/team/add",
                    'defaults' => array(
                        'controller' => 'Application\Controller\Team',
                        'action'     => 'add',
                    ),
                ),
            ),
            'team-update' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route'    => "/$moduleName/team/update",
                    'defaults' => array(
                        'controller' => 'Application\Controller\Team',
                        'action'     => 'update',
                    ),
                ),
            ),
            'team-delete' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route'    => "/$moduleName/team/delete",
                    'defaults' => array(
                        'controller' => 'Application\Controller\Team',
                        'action'     => 'delete',
                    ),
                ),
            ),
            'team-list' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route'    => "/$moduleName/team/list",
                    'defaults' => array(
                        'controller' => 'Application\Controller\Team',
                        'action'     => 'list',
                    ),
                ),
            ),
            'team-member-add' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route'    => "/$moduleName/teamMember/add",
                    'defaults' => array(
                        'controller' => 'Application\Controller\TeamMember',
                        'action'     => 'add',
                    ),
                ),
            ),
            'team-member-update' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route'    => "/$moduleName/teamMember/update",
                    'defaults' => array(
                        'controller' => 'Application\Controller\TeamMember',
                        'action'     => 'update',
                    ),
                ),
            ),
            'team-member-delete' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route'    => "/$moduleName/teamMember/delete",
                    'defaults' => array(
                        'controller' => 'Application\Controller\TeamMember',
                        'action'     => 'delete',
                    ),
                ),
            ),
            'team-member-list' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route'    => "/$moduleName/teamMember/list",
                    'defaults' => array(
                        'controller' => 'Application\Controller\TeamMember',
                        'action'     => 'list',
                    ),
                ),
            ),
            'survey-take' => array(
                'type' => 'segment',
                'options' => array(
                    'route'    => "/$moduleName/survey/take[/:subcategoryId]",
                    'defaults' => array(
                        'controller' => 'Application\Controller\Survey',
                        'action'     => 'take',
                    ),
                    'constraints' => array (
                        'subcategoryId' => '\d{1,11}'
                    ),
                ),
            ),
            'survey-radar' => array(
                'type' => 'segment',
                'options' => array(
                    'route'    => "/$moduleName/survey/radar[/:teamId]",
                    'defaults' => array(
                        'controller' => 'Application\Controller\Survey',
                        'action'     => 'radar',
                    ),
                    'constraints' => array (
                        'teamId' => '\d{0,11}'
                    ),
                ),
            ),
            'survey-graph' => array(
                'type' => 'segment',
                'options' => array(
                    'route'    => "/$moduleName/survey/graph[/:teamId]",
                    'defaults' => array(
                        'controller' => 'Application\Controller\Survey',
                        'action'     => 'graph',
                    ),
                    'constraints' => array (
                        'teamId' => '\d{0,11}'
                    ),
                ),
            ),
            'survey-graph-csv' => array(
                'type' => 'segment',
                'options' => array(
                    'route'    => "/$moduleName/survey/graphCsv[/:teamId/:year/:quarter]",
                    'defaults' => array(
                        'controller' => 'Application\Controller\Survey',
                        'action'     => 'graphCsv',
                    ),
                    'constraints' => array (
                        'teamId' => '\d{0,11}',
                        'year' => '\d{4}',
                        'quarter' => '\d{1}'
                    ),
                ),
            ),

            'survey-summary' => array(
                'type' => 'segment',
                'options' => array(
                    'route'    => "/$moduleName/survey/summary[/:teamId]",
                    'defaults' => array(
                        'controller' => 'Application\Controller\Survey',
                        'action'     => 'summary',
                    ),
                    'constraints' => array (
                        'teamId' => '\d{0,11}'
                    ),
                ),
            ),

            'team-compare' => array(
                'type' => 'segment',
                'options' => array(
                    'route'    => "/$moduleName/team/compare",
                    'defaults' => array(
                        'controller' => 'Application\Controller\Team',
                        'action'     => 'compare',
                    ),
                    'constraints' => array (
                        'teamId' => '\d{0,11}'
                    ),
                ),
            ),

            'survey-compare' => array(
                'type' => 'segment',
                'options' => array(
                    'route'    => "/$moduleName/survey/compare",
                    'defaults' => array(
                        'controller' => 'Application\Controller\Survey',
                        'action'     => 'compare',
                    ),
                    'constraints' => array (
                        'teamId' => '\d{0,11}'
                    ),
                ),
            ),

            'survey-bar' => array(
                'type' => 'segment',
                'options' => array(
                    'route'    => "/$moduleName/survey/barGraph[/:teamId]",
                    'defaults' => array(
                        'controller' => 'Application\Controller\Survey',
                        'action'     => 'barGraph',
                    ),
                    'constraints' => array (
                        'teamId' => '\d{0,11}'
                    ),
                ),
            ),
            'survey-bar-csv' => array(
                'type' => 'segment',
                'options' => array(
                    'route'    => "/$moduleName/survey/barGraphCsv[/:teamId/:year/:quarter]",
                    'defaults' => array(
                        'controller' => 'Application\Controller\Survey',
                        'action'     => 'barGraphCsv',
                    ),
                    'constraints' => array (
                        'teamId' => '\d{0,11}',
                        'year' => '\d{4}',
                        'quarter' => '\d{1}'
                    ),
                ),
            ),

            'graph-csv-strength' => array(
                'type' => 'segment',
                'options' => array(
                    'route'    => "/$moduleName/survey/graphCsvStrength[/:teamId/:year/:quarter]",
                    'defaults' => array(
                        'controller' => 'Application\Controller\Survey',
                        'action'     => 'graphCsvStrength',
                    ),
                    'constraints' => array (
                        'teamId' => '\d{0,11}',
                        'year' => '\d{4}',
                        'quarter' => '\d{1}'
                    ),
                ),
            ),
            'graph-csv-weakness' => array(
                'type' => 'segment',
                'options' => array(
                    'route'    => "/$moduleName/survey/graphCsvWeakness[/:teamId/:year/:quarter]",
                    'defaults' => array(
                        'controller' => 'Application\Controller\Survey',
                        'action'     => 'graphCsvWeakness',
                    ),
                    'constraints' => array (
                        'teamId' => '\d{0,11}',
                        'year' => '\d{4}',
                        'quarter' => '\d{1}'
                    ),
                ),
            ),
            'survey-tree' => array(
                'type' => 'segment',
                'options' => array(
                    'route'    => "/$moduleName/survey/tree[/:teamId]",
                    'defaults' => array(
                        'controller' => 'Application\Controller\Survey',
                        'action'     => 'tree',
                    ),
                    'constraints' => array (
                        'teamId' => '\d{0,11}'
                    ),
                ),
            ),
            'survey-tree-json' => array(
                'type' => 'segment',
                'options' => array(
                    'route'    => "/$moduleName/survey/treeJson[/:teamId/:year/:quarter]",
                    'defaults' => array(
                        'controller' => 'Application\Controller\Survey',
                        'action'     => 'treeJson',
                    ),
                    'constraints' => array (
                        'teamId' => '\d{0,11}',
                        'year' => '\d{4}',
                        'quarter' => '\d{1}'
                    ),
                ),
            ),
            'generate-report' => array(
                'type' => 'segment',
                'options' => array(
                    'route'    => "/$moduleName/survey/report[/:teamId]",
                    'defaults' => array(
                        'controller' => 'Application\Controller\Survey',
                        'action'     => 'report',
                    ),
                    'constraints' => array (
                        'teamId' => '\d{0,11}',
                    ),
                ),
            ),
            'generate-analyze' => array(
                'type' => 'segment',
                'options' => array(
                    'route'    => "/$moduleName/survey/analyze[/:teamId]",
                    'defaults' => array(
                        'controller' => 'Application\Controller\Survey',
                        'action'     => 'analyze',
                    ),
                    'constraints' => array (
                        'teamId' => '\d{0,11}',
                    ),
                ),
            ),
            'generate-report-executive' => array(
                'type' => 'segment',
                'options' => array(
                    'route'    => "/$moduleName/survey/executivereport[/:teamId]",
                    'defaults' => array(
                        'controller' => 'Application\Controller\Survey',
                        'action'     => 'summaryReport',
                    ),
                    'constraints' => array (
                        'teamId' => '\d{0,11}',
                    ),
                ),
            ),
        ),
    ),
    'service_manager' => array(
        'abstract_factories' => array(
            'Zend\Cache\Service\StorageCacheAbstractServiceFactory',
            'Zend\Log\LoggerAbstractServiceFactory',
        ),
        'factories' => array(
            'translator' => 'Zend\Mvc\Service\TranslatorServiceFactory',
            'Zend\Db\Adapter\Adapter' => 'Zend\Db\Adapter\AdapterServiceFactory',
        ),
    ),
    'translator' => array(
        'locale' => 'en_US',
        'translation_file_patterns' => array(
            array(
                'type'     => 'gettext',
                'base_dir' => __DIR__ . '/../language',
                'pattern'  => '%s.mo',
            ),
        ),
    ),
    'controllers' => array(
        'invokables' => array(
            'Application\Controller\Route' => Controller\RouteController::class,
            'Application\Controller\Question' => Controller\QuestionController::class,
            'Application\Controller\Auth' => Controller\AuthController::class,
            'Application\Controller\Company' => Controller\CompanyController::class,
            'Application\Controller\Survey' => Controller\SurveyController::class,
            'Application\Controller\Team' => Controller\TeamController::class,
            'Application\Controller\TeamMember' => Controller\TeamMemberController::class,
            'Application\Controller\Radar' => Controller\RadarController::class,
        ),
    ),
    'view_manager' => array(
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map' => array(
            'layout/layout'           => __DIR__ . '/../view/layout/hpta.phtml',
            'application/index/index' => __DIR__ . "/../view/$moduleName/index/index.phtml",
            'error/404'               => __DIR__ . '/../view/error/404.phtml',
            'error/index'             => __DIR__ . '/../view/error/index.phtml',
        ),
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),
    // Placeholder for console routes
    'console' => array(
        'router' => array(
            'routes' => array(
            ),
        ),
    ),
    'doctrine' => array(
        'authentication' => array(
            'orm_default' => array(
                'object_manager' => 'Doctrine\ORM\EntityManager',
                'identity_class' => 'Application\Entity\Employee',
                'identity_property' => 'email',
                'credential_property' => 'password',
            ),
        ),
        'driver' => array(
            'Application_driver' => array(
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => array(__DIR__ . '/../src/Application/Entity')
            ),
            'orm_default' => array(
                'drivers' => array(
                    'Application\Entity' =>  'Application_driver'
                ),
            ),
        ),
    ),
);
