<?php
/**
 * @package     Joomla.Site
 * @subpackage  Layout
 *
 * @copyright   Copyright (C) 2005 - 2018 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('JPATH_BASE') or die;

$msgList = $displayData['msgList'];

$alert = [
    'message' => 'uk-alert-success',
    'warning' => 'uk-alert-warning',
    'error' => 'uk-alert-danger',
    'notice' => ''
];

?>
<div id="system-message-container">
	<?php if (is_array($msgList) && !empty($msgList)) : ?>
		<?php foreach ($msgList as $type => $msgs) : ?>
			<div class="uk-alert <?php echo $alert[$type]; ?>" uk-alert>
				<a href="#" class="uk-alert-close uk-close" uk-close></a>

				<?php if (!empty($msgs)) : ?>
					<h4><?php echo JText::_($type); ?></h4>
					<?php foreach ($msgs as $msg) : ?>
						<p><?php echo $msg; ?><p>
					<?php endforeach; ?>
				<?php endif; ?>
			</div>
		<?php endforeach; ?>
	<?php endif; ?>
</div>
