<?php
/**
 * Application model for Cake.
 *
 * This file is application-wide model file. You can put all
 * application-wide model-related methods here.
 *
 * PHP versions 4 and 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       cake
 * @subpackage    cake.cake.libs.model
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

/**
 * Application model for Cake.
 *
 * This is a placeholder class.
 * Create the same file in app/app_model.php
 * Add your application-wide methods to the class, your models will inherit them.
 *
 * @package       cake
 * @subpackage    cake.cake.libs.model
 */
class AppModel extends Model {
    var $cache = true;

    function find($type, $params = null)
    {
        if ($this->cache) {
            if(is_array($type)) {
                $typeString = md5(serialize($type));
            } else {
                $typeString = $type;
            }
            $tag = isset($this->name) ? '_' . $this->name : 'appmodel';
            $paramsHash = md5(serialize($params));
            $version = (int)Cache::read($tag);
            $fullTag = $tag . '_' . $typeString . '_' . $paramsHash;
            if ($result = Cache::read($fullTag)) {
                if ($result['version'] == $version)
                    return $result['data'];
            }
            $result = array('version' => $version, 'data' => parent::find($type, $params), );
            Cache::write($fullTag, $result);
            Cache::write($tag, $version);
            return $result['data'];
        } else {
            return parent::find($type, $params);
        }
    }

    private function updateCounter()
    {
        if ($this->cache) {
            $tag = isset($this->name) ? '_' . $this->name : 'appmodel';
            Cache::write($tag, 1 + (int)Cache::read($tag));
        }
    }

    function afterDelete()
    {
        $this->updateCounter();
        parent::afterDelete();
    }

    function afterSave($created)
    {
        $this->updateCounter();
        parent::afterSave($created);
    }
}
