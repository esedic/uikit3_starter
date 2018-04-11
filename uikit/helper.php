<?php

defined('_JEXEC') or die;

use \Joomla\CMS\Factory;

$app = Factory::getApplication();
$doc = Factory::getDocument();

$menuleft = $this->params->get('menuleft');
$menulogo = $this->params->get('logo_in_menu');
$logo = $this->params->get('logo');
$logomobile = $this->params->get('logomobile');
$sitetitle = $this->params->get('sitetitle');
$active = $app->getMenu()->getActive();
$pageParams = $app->getParams();
$sitename = $app->getCfg('sitename');
if ($sitetitle) {
    $site_id = $sitetitle;
} else {
    $site_id = $sitename;
}

// Define relative path to the current template directory
$template = 'templates/' . $this->template;
