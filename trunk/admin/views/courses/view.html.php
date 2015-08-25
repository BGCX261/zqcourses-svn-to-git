<?php

// No direct access
defined('_JEXEC') or die;

jimport('joomla.application.component.view');

class CoursesViewCourses extends JView
{
	protected $items;
	protected $pagination;
	protected $state;

	/**
	 * Display the view
	 */
	public function display($tpl = null)
	{
		$this->state		= $this->get('State');
		$this->items		= $this->get('Items');
		$this->pagination	= $this->get('Pagination');

		// Check for errors.
		if (count($errors = $this->get('Errors'))) {
			JError::raiseError(500, implode("\n", $errors));
			return false;
		}

		JHtml::stylesheet('com_courses/admin.stylesheet.css', array(), true, false, false);
		$this->addToolbar();		
		parent::display($tpl);
	}

	protected function addToolbar()
	{
		require_once JPATH_COMPONENT.'/helpers/courses.php';

		$state	= $this->get('State');
		$canDo	= CoursesHelper::getActions($state->get('filter.category_id'));
		$user	= JFactory::getUser();

		JToolBarHelper::title(JText::_('COM_COURSES_MANAGER_COURSES'), 'courses');
		//if (count($user->getAuthorisedCategories('com_courses', 'core.create')) > 0) {
			JToolBarHelper::addNew('course.add');
		//}
		if ($canDo->get('core.edit')) {
			JToolBarHelper::editList('course.edit');
		}
		if ($canDo->get('core.edit.state')) {

			JToolBarHelper::divider();
			JToolBarHelper::publish('courses.publish', 'JTOOLBAR_PUBLISH', true);
			JToolBarHelper::unpublish('courses.unpublish', 'JTOOLBAR_UNPUBLISH', true);


			JToolBarHelper::divider();
			JToolBarHelper::archiveList('courses.archive');
			JToolBarHelper::checkin('courses.checkin');
		}
		if ($state->get('filter.state') == -2 && $canDo->get('core.delete')) {
			JToolBarHelper::deleteList('', 'courses.delete', 'JTOOLBAR_EMPTY_TRASH');
			JToolBarHelper::divider();
		} elseif ($canDo->get('core.edit.state')) {
			JToolBarHelper::trash('courses.trash');
			JToolBarHelper::divider();
		}
		if ($canDo->get('core.admin')) {
			JToolBarHelper::preferences('com_courses');
			JToolBarHelper::divider();
		}

		JToolBarHelper::help('JHELP_COMPONENTS_WEBLINKS_LINKS'); // TODO		
	}
}
