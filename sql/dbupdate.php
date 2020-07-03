<#1>
<?php
require_once('Customizing/global/plugins/Services/UIComponent/UserInterfaceHook/RoleBasedTopItemAccess/src/RoleStorage.php');
$ar = new demo\plugins\mmdemo\RoleStorage();
$ar->createTableIfNotExists();
?>