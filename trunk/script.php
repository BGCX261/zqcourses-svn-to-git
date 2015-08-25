<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');
 
class com_coursesInstallerScript
{
	/**
	 * method to install the component
	 *
	 * @return void
	 */
	function install($parent) 
	{
		// $parent is the class calling this method
		$parent->getParent()->setRedirectURL('index.php?option=com_courses');

		$path = JPATH_ADMINISTRATOR . '/components/com_categories';
		require_once $path . '/models/category.php';
		
		$config = array('table_path' => $path . '/tables');
		$model = new CategoriesModelCategory($config);
		
		$data = array(
			'id' => 0,
			'parent_id' => 0,
			'level' => 1,
			'path' => 'uncategorised',
			'extension' => 'com_courses',
			'title' => 'Uncategorised',
			'alias' => 'uncategorised',
			'note' => '',
			'description' => '',
			'published' => 1,
			'language' => '*'
		);
		
		$status = $model->save($data);
		
		if (!$status)
		{
			JError::raiseWarning(500, JText::_('Unable to create default course category.'));
		}
	}
 
	/**
	 * method to uninstall the component
	 *
	 * @return void
	 */
	function uninstall($parent) 
	{
		// $parent is the class calling this method
		//echo '<p>' . JText::_('COM_COURSES_UNINSTALL_TEXT') . '</p>';
	}
 
	/**
	 * method to update the component
	 *
	 * @return void
	 */
	function update($parent) 
	{
		// $parent is the class calling this method
		//echo '<p>' . JText::_('COM_COURSES_UPDATE_TEXT') . '</p>';
	}
 
	/**
	 * method to run before an install/update/uninstall method
	 *
	 * @return void
	 */
	function preflight($type, $parent) 
	{
		// $parent is the class calling this method
		// $type is the type of change (install, update or discover_install)
		//echo '<p>' . JText::_('COM_COURSES_PREFLIGHT_' . $type . '_TEXT') . '</p>';
	}
 
	/**
	 * method to run after an install/update/uninstall method
	 *
	 * @return void
	 */
	function postflight($type, $parent) 
	{
		// $parent is the class calling this method
		// $type is the type of change (install, update or discover_install)
		//echo '<p>' . JText::_('COM_COURSES_POSTFLIGHT_' . $type . '_TEXT') . '</p>';
	}
}
