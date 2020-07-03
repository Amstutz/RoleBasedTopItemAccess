<?php
require_once __DIR__ . "/../vendor/autoload.php";

use demo\plugins\mmdemo\RoleBasedProvider;

/**
 * Class iliLubModsPlugin
 *
 * @author  Timon Amstutz
 * @version $Id$
 */
class ilRoleBasedTopItemAccessPlugin extends ilUserInterfaceHookPlugin {


    public function __construct()
    {
        parent::__construct();

        global $DIC;
        $this->provider_collection->setMainBarProvider(new RoleBasedProvider($DIC, $this));
        //$this->provider_collection->setMetaBarProvider(new MetaBarProvider($DIC, $this));
        //$this->provider_collection->setNotificationProvider(new NotificationProvider($DIC, $this));
        //$this->provider_collection->setModificationProvider(new ModificationProvider($DIC, $this));
        //$this->provider_collection->setToolProvider(new ToolProvider($DIC, $this));
    }

	/**
	 * @return string
	 */
	function getPluginName() {
		return 'RoleBasedTopItemAccess';
	}
}