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

namespace Buddy\Apis;

use Buddy\Objects\Email;

class Emails extends Api
{
    /**
     * @param null|string $accessToken
     * @return \Buddy\Objects\Emails
     */
    public function getAuthenticatedUserEmails($accessToken = null)
    {
        return $this->getJson($accessToken, '/user/emails')->getAsEmails();
    }

    /**
     * @param Email $email
     * @param null|string $accessToken
     * @return Email
     */
    public function addAuthenticatedUserEmail(Email $email, $accessToken = null)
    {
        return $this->postJson($accessToken, [
            'email' => $email->getEmail()
        ], '/user/emails')->getAsEmail();
    }

    /**
     * @param string $email
     * @param null|string $accessToken
     * @return bool
     */
    public function deleteAuthenticatedUserEmail($email, $accessToken = null)
    {
        return $this->deleteJson($accessToken, null, '/user/emails/:email', [
            'email' => $email
        ])->getAsBool();
    }
}
