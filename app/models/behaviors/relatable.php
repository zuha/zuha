<?php
class RelatableBehavior extends ModelBehavior {

	var $__model = '';
	var $__foreignKey = '';
	var $__key = 'id';

	function setup(&$Model, $settings = array()) {
		# I know this is bad.  I'm in a time crunch.
		$this->__model = (!empty($_GET['m']) ? $_GET['m'] : null);
		$this->__foreignKey = (!empty($_GET['f']) ? $_GET['f'] : null);
		$this->__key = (!empty($settings['key']) ? $settings['key'] : $this->__key);
	}


	function beforeFind(&$Model, $queryData) {
		if (!empty($queryData['conditions']) && !empty($this->__key)) {
			unset($queryData['conditions'][$Model->alias.'.'.$this->__key]);
		}
		$queryData['conditions'][$Model->alias.'.model'] = $this->__model;
		$queryData['conditions'][$Model->alias.'.foreign_key'] = $this->__foreignKey;
		return $queryData;
	}
}

?>