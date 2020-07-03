<?php
namespace demo\plugins\mmdemo;

use ILIAS\GlobalScreen\Scope\MainMenu\Provider\AbstractStaticMainMenuPluginProvider;
use ILIAS\GlobalScreen\Scope\MainMenu\Factory\TopItem\TopParentItem;
use ILIAS\GlobalScreen\Scope\MainMenu\Collector\Information\TypeInformation;
use ILIAS\GlobalScreen\Scope\MainMenu\Collector\Information\TypeInformationCollection;
use ilPlugin;

/**
 * Class RoleBasedProvider
 *
 * @author Timon Amstutz
 */
class RoleBasedProvider extends AbstractStaticMainMenuPluginProvider {

	/**
	 * @var \ILIAS\DI\Container
	 */
	protected $dic;

	/**
	 * @var ilPlugin $plugin
	 */
	protected $plugin;



	/**
	 * @return TopParentItem[]
	 *
	 * This Method return all TopItems for the MainMenu.
	 * Make sure you use the same Identifier for all subitems as well,
	 * @see getParentIdentifier().
	 * Using $this->if-> (if stands for IdentificationFactory) you will already
	 * get a PluginIdentification for your Plugin-Instance.
	 */
	public function getStaticTopItems(): array {
		return [];
	}

	/**
	 * Accordingly this method provides the Subitems.
	 * By using $this->mainmenu->custom(...) you can even use your own Types.
	 * Make sure you provide special information and rendering for won types if
	 * needed, @see provideTypeInformation()
	 *
	 * @inheritdoc
	 */
	public function getStaticSubItems(): array {
		return [];
	}

	/**
	 * @inheritdoc
	 *
	 */
	public function provideTypeInformation(): TypeInformationCollection {
		$c = new TypeInformationCollection();
		$c->add(new TypeInformation(RoleEntryType::class, "Role Based Access for Studmed",new RoleEntryRenderer(),
				new RoleEntryType($this->if->identifier("parent_role_entry")))
		);
		return $c;
	}
}
