<?php

// No direct access
defined('_JEXEC') or die;

jimport('joomla.application.component.view');

class CoursesViewCourse extends JView
{
	protected $state;
	protected $item;
	protected $form;

	/**
	 * Display the view
	 */
	public function display($tpl = null)
	{
		$this->state	= $this->get('State');
		$this->item		= $this->get('Item');
		$this->form		= $this->get('Form');

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
		JRequest::setVar('hidemainmenu', true);

		$user		= JFactory::getUser();
		$userId		= $user->get('id');
		$isNew		= ($this->item->id == 0);
		$checkedOut	= !($this->item->checked_out == 0 || $this->item->checked_out == $user->get('id'));
		// Since we don't track these assets at the item level, use the category id.
		$canDo		= CoursesHelper::getActions($this->item->catid, 0);

		JToolBarHelper::title(JText::_('COM_COURSES_MANAGER_COURSE'), 'courses-categories');

		// If not checked out, can save the item.
		if (!$checkedOut && ($canDo->get('core.edit')||(count($user->getAuthorisedCategories('com_courses', 'core.create')))))
		{
			JToolBarHelper::apply('course.apply');
			JToolBarHelper::save('course.save');
		}
		if (!$checkedOut && (count($user->getAuthorisedCategories('com_courses', 'core.create')))){
			JToolBarHelper::save2new('course.save2new');
		}
		// If an existing item, can save to a copy.
		if (!$isNew && (count($user->getAuthorisedCategories('com_courses', 'core.create')) > 0)) {
			JToolBarHelper::save2copy('course.save2copy');
		}
		if (empty($this->item->id)) {
			JToolBarHelper::cancel('course.cancel');
		}
		else {
			JToolBarHelper::cancel('course.cancel', 'JTOOLBAR_CLOSE');
		}

		JToolBarHelper::divider();
		JToolBarHelper::help('JHELP_COMPONENTS_COURSES_LINKS_EDIT');		
		}
}
