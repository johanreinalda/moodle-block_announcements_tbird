<?php

// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Announcements block settings
 *
 * @package   block_announcements_tbird
 * @copyright 2013 onwards Johan Reinalda (http://www.thunderbird.edu)
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die;

if ($ADMIN->fulltree) {
	$settings->add(new admin_setting_configtext('block_announcements_tbird/configtitle', get_string('configtitle', 'block_announcements_tbird'),
				get_string('configtitledescr', 'block_announcements_tbird'),
				get_string('configtitledefault', 'block_announcements_tbird'), PARAM_RAW, 20 ));

	//admin_setting_confightmltextarea exists in 1.9.8
	//for 1.9.7 and earlier, use admin_setting_configtextarea
	$settings->add(new admin_setting_confightmleditor('block_announcements_tbird/configcontent', get_string('configcontent', 'block_announcements_tbird'),
				get_string('configcontentdescr', 'block_announcements_tbird'), '', PARAM_RAW, 60, 16 ));

	$settings->add(new admin_setting_configcheckbox('block_announcements_tbird/configallowcustom', get_string('configallowcustom', 'block_announcements_tbird'),
				get_string('configallowcustomdescr', 'block_announcements_tbird'), 0));
				
	$settings->add(new admin_setting_confightmleditor('block_announcements_tbird/configfooter', get_string('configfooter', 'block_announcements_tbird'),
				get_string('configfooterdescr', 'block_announcements_tbird'), ''));
}
