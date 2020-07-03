<?php
namespace demo\plugins\mmdemo;

use ILIAS\GlobalScreen\Scope\MainMenu\Factory\isItem;
use ILIAS\GlobalScreen\Scope\MainMenu\Collector\Renderer\TopParentItemRenderer;
use ILIAS\UI\Component\Component;
/**
 * Class RoleEntryRenderer
 */
class RoleEntryRenderer extends TopParentItemRenderer {
	/**
	 * @inheritdoc
	 *
	 * Just return the UI-Component for your Special type
	 */
	public function getComponentWithContent(isItem $item): Component {
		global $DIC;

		$identifier = $item->getProviderIdentification();
		$storage = new RoleStorage($identifier->getInternalIdentifier());
		$data = unserialize($storage->getMMItemData());

		$global_roles_with_access = $data['roles'];
		$global_roles_of_user = $DIC->rbac()->review()->assignedGlobalRoles($DIC->user()->getId());

		if(is_array($global_roles_with_access) && count(array_intersect($global_roles_of_user,$global_roles_with_access))){
			return parent::getComponentWithContent($item);
		}
		return $this->ui_factory->legacy("");
	}
}