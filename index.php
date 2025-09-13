<?php
define('ENVIRONMENT', 'development');

if (defined('ENVIRONMENT'))
{
    switch (ENVIRONMENT)
    {
        case 'development':
            error_reporting(-1);
            ini_set('display_errors', 1);
            break;

        case 'testing':
        case 'production':
            ini_set('display_errors', 0);
            if (version_compare(PHP_VERSION, '5.3', '>='))
            {
                error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED & ~E_STRICT & ~E_USER_NOTICE & ~E_USER_DEPRECATED);
            }
            else
            {
                error_reporting(E_ALL & ~E_NOTICE & ~E_STRICT);
            }
            break;

        default:
            exit('The application environment is not set correctly.');
    }
}

$system_path = 'system';
$application_folder = 'application';
$view_folder = '';

if (defined('STDIN'))
{
    chdir(dirname(__FILE__));
}

if (realpath($system_path) !== FALSE)
{
    $system_path = realpath($system_path).'/';
}

$system_path = rtrim($system_path, '/').'/';

if ( ! is_dir($system_path))
{
    exit("Your system folder path does not appear to be set correctly. Please open the following file and correct this: ".pathinfo(__FILE__, PATHINFO_BASENAME));
}

define('BASEPATH', str_replace("\\", "/", $system_path));
define('FCPATH', dirname(__FILE__).'/');
define('SYSDIR', trim(strrchr(trim(BASEPATH, '/'), '/'), '/'));

if (is_dir($application_folder))
{
    if (($_temp = realpath($application_folder)) !== FALSE)
    {
        $application_folder = $_temp;
    }
    else
    {
        $application_folder = strtr(rtrim($application_folder, '/'), '/\\', DIRECTORY_SEPARATOR.DIRECTORY_SEPARATOR);
    }
}
elseif (is_dir(BASEPATH.$application_folder.DIRECTORY_SEPARATOR))
{
    $application_folder = BASEPATH.$application_folder.DIRECTORY_SEPARATOR;
}
else
{
    header('HTTP/1.1 503 Service Unavailable.', TRUE, 503);
    echo 'Your application folder path does not appear to be set correctly. Please open the following file and correct this: '.SELF;
    exit(3);
}

define('APPPATH', $application_folder.DIRECTORY_SEPARATOR);

if ( ! $view_folder && is_dir(APPPATH.'views'.DIRECTORY_SEPARATOR))
{
    $view_folder = APPPATH.'views';
}
elseif ( ! is_dir($view_folder))
{
    header('HTTP/1.1 503 Service Unavailable.', TRUE, 503);
    echo 'Your view folder path does not appear to be set correctly. Please open the following file and correct this: '.SELF;
    exit(3);
}

if (($_temp = realpath($view_folder)) !== FALSE)
{
    $view_folder = $_temp;
}
else
{
    $view_folder = strtr(rtrim($view_folder, '/'), '/\\', DIRECTORY_SEPARATOR.DIRECTORY_SEPARATOR);
}

define('VIEWPATH', $view_folder.DIRECTORY_SEPARATOR);

require_once BASEPATH.'core/CodeIgniter.php';