<?php
require_once __DIR__ . "/../vendor/autoload.php";


class ilRoleBasedTopItemAccessUIHookGUI extends ilUIHookPluginGUI
{

	/**
	 * Routes the getHTML call of the ilUIHookPluginGUI forward. Note, this is extremely sensitive for performance
	 * EVERY tpl loaded will perform the listed checks.
	 *
	 * @param string $a_comp
	 * @param string $a_part
	 * @param array $a_par
	 * @return array
	 * @throws ilDatabaseException
     *
     *
	 */
	public function getHTML($a_comp, $a_part, $a_par = array()) {
        if ($a_part == 'template_get' && $a_par['tpl_id'] == 'src/UI/templates/default/MainControls/tpl.footer.html') {
            return $this->addRenderedBy($a_par['html']);
        }
	}

	/**
	 * @param string $html
	 * @return array
	 */
	protected function addRenderedBy(string $html){
		$rendered = 'rendered by ' . gethostname();
		$html     = $html.'<span style="color:white;">'. $rendered.' </span style="color:white;"> ';

		return array('mode' =>  ilUIHookPluginGUI::REPLACE, 'html' => $html);
	}
}