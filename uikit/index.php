<?php
/**
 * @package    Uikit 3 template
 *
 * @author     Elvis Sedić, elvis@spletodrom.si
 * @copyright  Spletodrom
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 * @link       https://www.spletodrom.si
 */

defined('_JEXEC') or die;

use \Joomla\CMS\Factory;
use \Joomla\Registry\Registry;

// Initialize system variables
$app             = Factory::getApplication();
$doc             = Factory::getDocument();
$user            = Factory::getUser();
$this->language  = $doc->language;
$sitename = $app->get('sitename');
$this->direction = $doc->direction;

$menu = $app->getMenu();
$itemid = $app->input->getInt('Itemid');
$option = $app->input->get('option');
$view = $app->input->get('view');
$layout = $app->input->get('layout');
$id = $app->input->getInt('id');
$active = $menu->getActive();

// Get template parameters
$params = $app->getTemplate(true)->params;
$menuleft = $params->get('menuleft');
$menulogo = $params->get('logo_in_menu');
$logo = $params->get('logo');
$logomobile = $params->get('logomobile');
$sitetitle = $params->get('sitetitle');
$pageParams = $app->getParams();
if ($sitetitle) {
    $site_id = $sitetitle;
} else {
    $site_id = $sitename;
}

// Output as HTML5
$doc->setHtml5(true);

// Pageclass Suffix
$pageclass_sfx = '';
if (is_object($menu))
    $pageclass_sfx = $active->params['pageclass_sfx'];

// Detecting Active Variables
$option   = $app->input->getCmd('option', '');
$view     = $app->input->getCmd('view', '');
$layout   = $app->input->getCmd('layout', '');
$task     = $app->input->getCmd('task', '');
$itemid   = $app->input->getCmd('Itemid', '');
$sitename = $app->get('sitename');

// Column layout
$sidebarA = $this->countModules('sidebar-a');
$sidebarB = $this->countModules('sidebar-b');

if(!$sidebarA && $sidebarB) {
	$layoutClass = 'main-right';
	$mainWidth = ' uk-width-3-4@l';
	$sidebarWidth = ' uk-width-1-4@l';
}
else if($sidebarA && !$sidebarB) {
	$layoutClass = 'left-main';
	$mainWidth = ' uk-width-3-4@l';
	$sidebarWidth = ' uk-width-1-4@l';
}
else if($sidebarA && $sidebarB) {
	$layoutClass = 'left-main-right';
	$mainWidth = ' uk-width-2-4@l';
	$sidebarWidth = ' uk-width-1-4@l';
}
else {
	$layoutClass = 'full-main';
	$mainWidth = ' uk-width-1-1';
}

// Page CSS class
$pageClass = '';
if ($menu->getActive() == $menu->getDefault()) {
	$pageClass = 'homepage';
}
else {
	$pageClass = 'innerpage';
}

// Add Stylesheets
$doc->addStyleSheetVersion($this->baseurl . '/templates/' . $this->template . '/css/uikit.css', array('version' => 'auto'));

// Check for a custom CSS file
$templateCss = JPATH_SITE . '/templates/' . $this->template . '/css/template.css';

if (file_exists($templateCss) && filesize($templateCss) > 0)
{
	$this->addStyleSheetVersion($this->baseurl . '/templates/' . $this->template . '/css/template.css', array('version' => 'auto'));
}

// load jQuery
JHtml::_('jquery.framework');

// Add Scripts
$doc->addScriptVersion($this->baseurl . '/templates/' . $this->template . '/js/uikit.min.js', array('version' => 'auto'));
$doc->addScriptVersion($this->baseurl . '/templates/' . $this->template . '/js/uikit-icons.min.js', array('version' => 'auto'));
$doc->addScriptVersion($this->baseurl . '/templates/' . $this->template . '/js/scripts.js', array('version' => 'auto'));
?>

<!DOCTYPE html>
<html lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>" class="<?php echo ' itemid-' . $itemid; ?>">
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--[if lte IE 8]>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.min.js"></script>
	<![endif]-->
	<jdoc:include type="head" />
</head>
<body class="<?php echo $pageClass . ' ' . htmlspecialchars($pageclass_sfx);?>">

	<?php if ($this->countModules('above')) : ?>
		<div class="tm-above" id="tm-above">
			<div class="uk-container">
				<jdoc:include type="modules" name="above" style="none" />
			</div>
		</div>
	<?php endif; ?>

	<?php if ($this->countModules('toolbar-left') || $this->countModules('toolbar-right')) : ?>
	<div class="tm-toolbar-wrapper" id="tm-toolbar-wrapper">
		<div class="uk-container">
			<div class="tm-toolbar uk-clearfix">

				<?php if ($this->countModules('toolbar-left')) : ?>
				<div class="toolbar-left">
					<a class="uk-logo" href="<?php echo JUri::root(); ?>">
						<jdoc:include type="modules" name="toolbar-left" style="none" />
					</a>
				</div>
				<?php endif; ?>

				<?php if ($this->countModules('toolbar-right')) : ?>
				<div class="toolbar-right">
					<jdoc:include type="modules" name="toolbar-right" style="none" />
				</div>
				<?php endif; ?>

			</div>
		</div>
	</div>
	<?php endif; ?>

	<?php if($this->countModules('menu')) : ?>
	<div class="tm-navbar-container" uk-sticky>
		<div class="uk-container">
			<jdoc:include type="modules" name="menu" style="none" />
		</div>
	</div>
	<?php endif; ?>

	<div class="wrapper <?php echo $layoutClass;?>">

		<?php if($this->countModules('banner')) : ?>
		<div class="banner" id="banner">
			<jdoc:include type="modules" name="banner" style="none" />
		</div>
		<?php endif; ?>

		<?php if($this->countModules('top-a')) : ?>
		<div class="top-a" id="top-a">
			<div class="uk-container">
				<jdoc:include type="modules" name="top-a" style="none" />
			</div>
		</div>
		<?php endif; ?>

		<?php if($this->countModules('top-b')) : ?>
		<div class="top-b" id="top-b">
			<div class="uk-container">
				<jdoc:include type="modules" name="top-b" style="none" />
			</div>
		</div>
		<?php endif; ?>

		<?php if($this->countModules('top-c')) : ?>
		<div class="top-c" id="top-c">
			<div class="uk-container">
				<jdoc:include type="modules" name="top-c" style="none" />
			</div>
		</div>
		<?php endif; ?>

		<?php if($this->countModules('top-d')) : ?>
		<div class="top-d" id="top-d">
			<div class="uk-container">
				<jdoc:include type="modules" name="top-d" style="none" />
			</div>
		</div>
		<?php endif; ?>

		<?php if($this->countModules('top-e')) : ?>
		<div class="top-e" id="top-e">
			<div class="uk-container">
				<jdoc:include type="modules" name="top-e" style="none" />
			</div>
		</div>
		<?php endif; ?>

		<?php if ($menu->getActive() !== $menu->getDefault() && $this->countModules('breadcrumbs')) : ?>
		<header class="ui-header">
			<div class="uk-container">
			<?php if ($this->countModules('breadcrumbs')) : ?>
				<div class="ui-breadcrumbs">
					<jdoc:include type="modules" name="breadcrumbs" style="none" />
				</div>
			<?php endif; ?>
			</div>
		</header>
		<?php endif; ?>

		<div class="uk-container tm-content-container">

			<?php if($this->countModules('search')) : ?>
				<div class="ui-search uk-margin">
					<?php if($this->countModules('search')) : ?>
						<div id="search">
							<jdoc:include type="modules" name="search" style="none" />
						</div>
					<?php endif; ?>
				</div>
			<?php endif; ?>

			<?php if ($menu->getActive() == $menu->getDefault() && $this->countModules('breadcrumbs')) : ?>
				<section class="ui-breadcrumbs">
					<jdoc:include type="modules" name="breadcrumbs" style="none" />
				</section>
			<?php endif; ?>

			<section class="ui-main">
				<div class="uk-grid" uk-grid>

					<?php if($this->countModules('sidebar-a')) : ?>
					<aside id="sidebar-a" class="ui-sidebar ui-sidebar-a<?php echo $sidebarWidth;?>">
						<div>
							<jdoc:include type="modules" name="sidebar-a" style="uikit" />
						</div>
					</aside>
					<?php endif;?>

					<main id="ui-content" class="ui-content<?php echo $mainWidth;?>">
					
						<?php if($this->countModules('main-top-a')) : ?>
						<div id="main-top-a" class="main-top-a">
							<div>
								<jdoc:include type="modules" name="main-top-a" style="none" />
							</div>
						</aside>
						<?php endif;?>
					
						<?php if($this->countModules('main-top-b')) : ?>
						<div id="main-top-b" class="main-top-b">
							<div>
								<jdoc:include type="modules" name="main-top-b" style="none" />
							</div>
						</aside>
						<?php endif; ?>

						<jdoc:include type="message" />
						<jdoc:include type="component" />

						<?php if($this->countModules('main-bottom-a')) : ?>
						<div id="main-bottom-a" class="main-bottom-a">
							<div>
								<jdoc:include type="modules" name="main-bottom-a" style="none" />
							</div>
						</aside>
						<?php endif;?>
					
						<?php if($this->countModules('main-bottom-b')) : ?>
						<div id="main-bottom-b" class="main-bottom-b">
							<div>
								<jdoc:include type="modules" name="main-bottom-b" style="none" />
							</div>
						</aside>
						<?php endif;?>

					</main>

					<?php if($this->countModules('sidebar-b')) : ?>
					<aside id="sidebar-b" class="ui-sidebar ui-sidebar-b<?php echo $sidebarWidth;?>">
						<div>
							<jdoc:include type="modules" name="sidebar-b" style="uikit" />
						</div>
					</aside>
					<?php endif;?>

				</div>
			</section>

		</div>
	</div>

	<?php if($this->countModules('bottom-a')) : ?>
	<div class="bottom-a" id="bottom-a">
		<div class="uk-container uk-flex uk-flex-middle uk-flex-center">
			<jdoc:include type="modules" name="bottom-a" style="none" />
		</div>
	</div>
	<?php endif; ?>

	<?php if($this->countModules('bottom-b')) : ?>
	<div class="bottom-b" id="bottom-b">
		<div class="uk-container">
			<jdoc:include type="modules" name="bottom-b" style="none" />
		</div>
	</div>
	<?php endif; ?>

	<?php if($this->countModules('bottom-c')) : ?>
	<div class="bottom-c" id="bottom-c">
		<div class="uk-container">
			<jdoc:include type="modules" name="bottom-c" style="none" />
		</div>
	</div>
	<?php endif; ?>

	<?php if($this->countModules('bottom-d')) : ?>
	<div class="bottom-d" id="bottom-d">
		<div class="uk-container">
			<jdoc:include type="modules" name="bottom-d" style="none" />
		</div>
	</div>
	<?php endif; ?>

	<?php if($this->countModules('bottom-e')) : ?>
	<div class="bottom-e" id="bottom-e">
		<div class="uk-container">
			<jdoc:include type="modules" name="bottom-e" style="none" />
</div>
	</div>
	<?php endif; ?>

<!-- Footer -->
<footer>
		<div class="uk-container footer">
			<div class="uk-grid" uk-grid uk-height-match>
				<?php if($this->countModules('footer-a')) : ?>
					<div class="uk-width-medium-1-2 uk-width-1-4@l footer-a">
						<jdoc:include type="modules" name="footer-a" style="none" />
					</div>
				<?php endif;?>
				<?php if($this->countModules('footer-b')) : ?>
					<div class="uk-width-medium-1-2 uk-width-1-4@l footer-b">
						<jdoc:include type="modules" name="footer-b" style="none" />
					</div>
				<?php endif;?>
				<?php if($this->countModules('footer-c')) : ?>
					<div class="uk-width-medium-1-2 uk-width-1-4@l footer-c">
						<jdoc:include type="modules" name="footer-c" style="none" />
					</div>
				<?php endif;?>
				<?php if($this->countModules('footer-d')) : ?>
					<div class="uk-width-medium-1-2 uk-width-1-4@l footer-d">
						<jdoc:include type="modules" name="footer-d" style="none" />
					</div>
				<?php endif;?>

			</div>
		</div>
		<div class="copyright">
			<div class="uk-container uk-position-relative">
				<?php if($this->countModules('copyright')) : ?>
					<jdoc:include type="modules" name="copyright" style="none" />
				<?php endif;?>
				<div class="uk-float-medium-left">&copy; <?php echo $sitename.' '.date('Y') ; ?>, vse pravice pridržane.</div>
				<div class="uk-float-medium-right producers">Izdelava: <a href="https://www.spletodrom.si/" target="_blank" title="Spletodrom, Izdelava spletnih strani Joomla">Spletodrom</a></div>
				<a class="tm-totop-scroller" title="To top of the page" uk-scroll href="#"></a>
			</div>
		</div>
</footer>

	<?php if($this->countModules('offcanvas')) : ?>
	<div id="offcanvas" class="uk-offcanvas">
		<div class="uk-offcanvas-bar">
			<jdoc:include type="modules" name="offcanvas" style="none" />
		</div>
	</div>
	<?php endif; ?>

<jdoc:include type="modules" name="debug" style="none" />

</body>
</html>
