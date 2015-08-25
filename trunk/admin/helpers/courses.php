<?php

// No direct access
defined('_JEXEC') or die;

class CoursesHelper
{
	/**
	 * Configure the Linkbar.
	 *
	 * @param	string	The name of the active view.
	 * @since	1.6
	 */
	public static function addSubmenu($vName = 'courses')
	{
		JSubMenuHelper::addEntry(
			JText::_('COM_COURSES_SUBMENU_COURSES'),
			'index.php?option=com_courses&view=courses',
			$vName == 'courses'
		);
		JSubMenuHelper::addEntry(
			JText::_('COM_COURSES_SUBMENU_CATEGORIES'),
			'index.php?option=com_categories&extension=com_courses',
			$vName == 'categories'
		);
		if ($vName=='categories') {
			JToolBarHelper::title(
				JText::sprintf('COM_CATEGORIES_CATEGORIES_TITLE', JText::_('com_courses')),
				'courses-cat');
		}
	}

	/**
	 * Gets a list of the actions that can be performed.
	 *
	 * @param	int		The category ID.
	 * @return	JObject
	 * @since	1.6
	 */
	public static function getActions($categoryId = 0)
	{
		$user	= JFactory::getUser();
		$result	= new JObject;

		if (empty($categoryId)) {
			$assetName = 'com_courses';
			$level = 'component';
		} else {
			$assetName = 'com_courses.category.'.(int) $categoryId;
			$level = 'category';
		}

		$actions = JAccess::getActions('com_courses', $level);

		foreach ($actions as $action) {
			$result->set($action->name,	$user->authorise($action->name, $assetName));
		}
		
		return $result;
	}
}
