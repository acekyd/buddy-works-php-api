<?php
/**
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *      http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

namespace Buddy\Objects;

class PermissionSets extends Object
{
    /**
     * @var array
     */
    protected $permissionSets;

    /**
     * PermissionSets constructor.
     * @param array $json
     * @param array $headers
     * @param int $status
     */
    public function __construct(array $json = [], array $headers = [], $status = 200)
    {
        parent::__construct($json, $headers, $status);
        $this->setFromJsonAsArray('Buddy\Objects\PermissionSet', 'permissionSets', 'permission_sets');
    }

    /**
     * @return array
     */
    public function getPermissionSets()
    {
        return $this->permissionSets;
    }
}
