<?php
/**
 * @copyright Copyright (c) 2016 Bjoern Schiessle <bjoern@schiessle.org>
 *
 * @license GNU AGPL version 3 or any later version
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License as
 * published by the Free Software Foundation, either version 3 of the
 * License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU Affero General Public License for more details.
 *
 * You should have received a copy of the GNU Affero General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 *
 */

use Symfony\Component\EventDispatcher\GenericEvent;

$passwordPolicyConfig = new \OCA\Password_Policy\PasswordPolicyConfig(\OC::$server->getConfig());
$validator = new \OCA\Password_Policy\PasswordValidator(
	$passwordPolicyConfig,
	\OC::$server->getL10N('password_policy')
);

$eventDispatcher = \OC::$server->getEventDispatcher();

$eventDispatcher->addListener('OCP\PasswordPolicy::validate',
	function(GenericEvent $event) use ($validator) {
		$validator->validate($event->getSubject());
	}
);
