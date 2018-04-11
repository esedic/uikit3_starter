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

$twofactormethods	= JAuthenticationHelper::getTwoFactorMethods();
$app				= Factory::getApplication();
$doc				= Factory::getDocument();

$this->language  = $doc->language;
$sitename = $app->get('sitename');

// Output as HTML5
$this->setHtml5(true);

// Add html5 shiv
JHtml::_('script', 'jui/html5.js', array('version' => 'auto', 'relative' => true, 'conditional' => 'lt IE 9'));

$doc->addStyleSheetVersion(JUri::root() . 'templates/' . $this->template . '/css/template.css', array('version' => 'auto'));
$doc->addStyleSheetVersion(JUri::root() . 'templates/' . $this->template . '/css/uikit.css', array('version' => 'auto'));
$doc->addScriptVersion(JUri::root() . 'templates/' . $this->template . '/js/uikit.js', array('version' => 'auto'));
?>

<!DOCTYPE html>
<html lang="<?php echo $this->language; ?>">
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<jdoc:include type="head" />
</head>
<body>
	<div class="tm-block-large">
		<div class="uk-container uk-container-center">
			<div class="uk-grid">
				<div class="uk-width-medium-1-2 uk-text-center uk-container-center">

					<?php if ($app->get('display_offline_message', 1) == 1 && str_replace(' ', '', $app->get('offline_message')) !== '') : ?>
						<div class="uk-alert">
							<p><?php echo $app->get('offline_message'); ?></p>
						</div>
					<?php elseif ($app->get('display_offline_message', 1) == 2) : ?>
						<div class="uk-alert">
							<p><?php echo JText::_('JOFFLINE_MESSAGE'); ?></p>
						</div>
					<?php endif; ?>

					<jdoc:include type="message" />
					<form action="<?php echo JRoute::_('index.php', true); ?>" method="post" id="form-login" class="uk-form uk-form-stacked">
						<fieldset>
							<div class="uk-form-row">
								<label class="uk-form-label" for="username"><?php echo JText::_('JGLOBAL_USERNAME'); ?></label>
								<div class="uk-form-controls">
									<input name="username" id="username" type="text" title="<?php echo JText::_('JGLOBAL_USERNAME'); ?>" />
								</div>
							</div>
							<div class="uk-form-row">
								<label class="uk-form-label" for="password"><?php echo JText::_('JGLOBAL_PASSWORD'); ?></label>
								<div class="uk-form-controls">
									<input type="password" name="password" id="password" title="<?php echo JText::_('JGLOBAL_PASSWORD'); ?>" />
								</div>
							</div>

							<?php if (count($twofactormethods) > 1) : ?>
							<div class="uk-form-row">
								<label class="uk-form-label" for="secretkey"><?php echo JText::_('JGLOBAL_SECRETKEY'); ?></label>
								<div class="uk-form-controls">
									<input type="text" name="secretkey" id="secretkey" title="<?php echo JText::_('JGLOBAL_SECRETKEY'); ?>" />
								</div>
							</div>
							<?php endif; ?>

							<div class="uk-form-row">
								<div class="uk-form-controls">
									<input type="submit" name="Submit" class="uk-button uk-button-primary" value="<?php echo JText::_('JLOGIN'); ?>" />
								</div>
							</div>

							<input type="hidden" name="option" value="com_users" />
							<input type="hidden" name="task" value="user.login" />
							<input type="hidden" name="return" value="<?php echo base64_encode(JUri::base()); ?>" />
							<?php echo JHtml::_('form.token'); ?>
						</fieldset>
					</form>
				</div>
			</div>
		</div>
	</div>
</body>
</html>