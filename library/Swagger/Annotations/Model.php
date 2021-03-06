<?php
namespace Swagger\Annotations;

/**
 * @license    http://www.apache.org/licenses/LICENSE-2.0
 *             Copyright [2012] [Robert Allen]
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *   http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 *
 * @package
 * @category
 * @subpackage
 */
use Swagger\Annotations\Properties;

/**
 * @package
 * @category
 * @subpackage
 *
 * @Annotation
 */
class Model extends AbstractAnnotation
{
    /**
     * @var string
     */
    public $id;
    /**
     * @var string
     */
    public $description;

    /**
     * @var array
     */
    public $properties = array();

    public function __construct($values)
    {
        parent::__construct($values);

        // If @Properties declared
        if (isset($values['value'])) {
            switch ($values['value']) {
                case ($values['value'] instanceof Properties):
                    $this->properties = $values['value']->toArray();
                    break;
            }
        }
    }

    /**
     * @return array
     */
    public function toArray()
    {
        $result = parent::toArray();
        $properties = array();
        foreach ($result['properties'] as $property) {
            $properties[$property['name']] = $property;
            unset($properties[$property['name']]['name']);
        }
        $result['properties'] = $properties;
        return $result;
    }
}

