<?php

// No direct access.
defined('_JEXEC') or die;

jimport('joomla.application.component.controlleradmin');

class CoursesControllerCourses extends JControllerAdmin
{
	public function getModel($name = 'Course', $prefix = 'CoursesModel', $config = array('ignore_request' => true))
	{
		$model = parent::getModel($name, $prefix, $config);
		return $model;
	}
}
