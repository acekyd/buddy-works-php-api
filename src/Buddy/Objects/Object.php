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

class Object
{
    /**
     * @var array
     */
    protected $json;

    /**
     * @var string
     */
    protected $url;

    /**
     * @var string
     */
    protected $htmlUrl;

    /**
     * @var array
     */
    protected $httpRequestHeaders;

    /**
     * @var int
     */
    protected $httpRequestStatus;

    /**
     * Object constructor.
     * @param array $json
     * @param array $headers
     * @param int $status
     */
    public function __construct(array $json = [], array $headers = [], $status = 200)
    {
        $this->json = $json;
        $this->httpRequestHeaders = $headers;
        $this->httpRequestStatus = $status;
        $this->setFromJson('url');
        $this->setFromJson('htmlUrl', 'html_url');
    }

    /**
     * @return int
     */
    public function getHttpRequestStatus()
    {
        return $this->httpRequestStatus;
    }

    /**
     * @return array
     */
    public function getHttpRequestHeaders()
    {
        return $this->httpRequestHeaders;
    }

    /**
     * @param string $propertyName
     * @param string|null $jsonName
     */
    protected function setFromJson($propertyName, $jsonName = null)
    {
        if (empty($jsonName)) {
            $jsonName = $propertyName;
        }
        if (isset($this->json[$jsonName])) {
            $this->$propertyName = $this->json[$jsonName];
        }
    }

    /**
     * @param string $className
     * @param string $propertyName
     * @param string|null $jsonName
     */
    protected function setFromJsonAsObject($className, $propertyName, $jsonName = null)
    {
        $this->setFromJson($propertyName, $jsonName);
        if (isset($this->$propertyName)) {
            $this->$propertyName = new $className($this->$propertyName);
        }
    }

    /**
     * @param string $className
     * @param string $propertyName
     * @param string|null $jsonName
     */
    protected function setFromJsonAsArray($className, $propertyName, $jsonName = null)
    {
        $this->setFromJson($propertyName, $jsonName);
        if (isset($this->$propertyName)) {
            $tmp = [];
            foreach ($this->$propertyName as $json) {
                $tmp[] = new $className($json);
            }
            $this->$propertyName = $tmp;
        }
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @return string
     */
    public function getHtmlUrl()
    {
        return $this->htmlUrl;
    }

    /**
     * @return array
     */
    public function getJson()
    {
        return $this->json;
    }
}
