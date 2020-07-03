<?php
namespace demo\plugins\mmdemo;

use ILIAS\GlobalScreen\Scope\MainMenu\Factory\TopItem\TopParentItem;
use ILIAS\GlobalScreen\Scope\MainMenu\Collector\Handler\TypeHandler;
use ILIAS\GlobalScreen\Scope\MainMenu\Factory\isItem;
use ILIAS\GlobalScreen\Identification\IdentificationInterface;
use ilObjRole;

/**
 * Class RoleEntryType
 */
class RoleEntryType extends TopParentItem implements TypeHandler{
	/**
	 * @inheritDoc
	 */
	public function matchesForType(): string {
		return "";
	}


	/**
	 * @inheritDoc
	 */
	public function enrichItem(isItem $item): isItem {
		return $item;
	}


	/**
	 * @inheritDoc
	 */
	public function getAdditionalFieldsForSubForm(IdentificationInterface $identification): array {
		global $DIC;


		if(RoleStorage::find($identification->getInternalIdentifier())){
			$storage = new RoleStorage($identification->getInternalIdentifier());
			$data = unserialize($storage->getMMItemData());
		}else{
			$data["roles"] = [];

		}

		$global_roles = $DIC->rbac()->review()->getGlobalRoles();
		$options = [];
		foreach ($global_roles as $role){
			$role = new ilObjRole($role);
			$options[$role->getId()] = $role->getTitle();
		}

		return [
			"roles" => $DIC->ui()->factory()->input()->field()->multiSelect("Global Roles",$options)
				->withValue($data["roles"])->withByline("Users of selected roles see the given entry.")
		];
	}


	/**
	 * @inheritDoc
	 */
	public function saveFormFields(IdentificationInterface $identification, array $data): bool {
		$data = serialize($data);
		$storage = new RoleStorage();
		$storage->setMMItemIdentifier($identification->getInternalIdentifier());
		$storage->setMMItemData($data);
		$storage->save();
		return true;
	}
}