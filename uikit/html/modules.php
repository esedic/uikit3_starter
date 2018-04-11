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

/**
 * This is a file to add template specific chrome to module rendering.  To use it you would
 * set the style attribute for the given module(s) include in your template to use the style
 * for each given modChrome function.
 *
 * eg. To render a module mod_test in the submenu style, you would use the following include:
 * <jdoc:include type="module" name="test" style="submenu" />
 *
 * This gives template designers ultimate control over how modules are rendered.
 *
 * NOTICE: All chrome wrapping methods should be named: modChrome_{STYLE} and take the same
 * two arguments.
 */


    
function modChrome_uikit($module, &$params, &$attribs)
{       
	$moduleTag      = $params->get('module_tag', 'div');
    $mysuffix = $params->get('moduleclass_sfx');
	$headerTag      = htmlspecialchars($params->get('header_tag', 'h3'));
	$bootstrapSize  = (int) $params->get('bootstrap_size', 0);
        switch ($bootstrapSize) {
            case 1:
                $moduleClass    = "uk-width-1-10";
                break;
            case 2:
                $moduleClass    = "uk-width-1-6";
                break;
            case 3:
                $moduleClass    = "uk-width-medium-1-4";
                break;
            case 4:
                $moduleClass    = "uk-width-medium-1-3";
                break;
            case 5:
                $moduleClass    = "uk-width-medium-2-5";
                break;
            case 6:
                $moduleClass    = "uk-width-medium-1-2";
                break;
            case 7:
                $moduleClass    = "uk-width-medium-3-5";
                break;
             case 8:
                $moduleClass    = "uk-width-medium-2-3";
                break;
             case 9:
                $moduleClass    = "uk-width-medium-3-4";
                break;
             case 10:
                $moduleClass    = "uk-width-5-6";
                break;
             case 11:
                $moduleClass    = "uk-width-9-10";
                break;
             case 12:
                $moduleClass    = "uk-width-1-1";
                break;
            default:
                $moduleClass    = "";
                break;
        }
        
	if (!empty ($module->content)) : ?>
		<<?php echo $moduleTag; ?> class="module <?php echo htmlspecialchars($mysuffix); ?> <?php echo $moduleClass; ?>">

		<?php if ((bool) $module->showtitle) :?>
			<<?php echo $headerTag; ?> class="<?php echo $params->get('header_class'); ?>"><?php echo $module->title; ?></<?php echo $headerTag; ?>>
		<?php endif; ?>

		<?php echo $module->content; ?>
		
		</<?php echo $moduleTag; ?>>

	<?php endif;
}


/*
 * Module chrome for rendering blank module
 */
function modChrome_blank($module, &$params, &$attribs)
{
    if ($module->content)
    {
        echo $module->content;
    }
}


/*
 * Module chrome for rendering blank module
 */
function modChrome_blanktitle($module, &$params, &$attribs)
{
    $headerTag      = htmlspecialchars($params->get('header_tag', 'h3'));

    if ((bool) $module->showtitle) {
        echo '<' . $headerTag . ' class="' . $params->get('header_class') . '">' . $module->title. '</' .$headerTag.'>'; 
    }
    if ($module->content)
    {
        echo $module->content;
    }
}

