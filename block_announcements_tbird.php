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
 * Block for creating an automatic Announcements HTML block
 *
 * @package   block_announcements_tbird
 * @copyright 2013 onwards Johan Reinalda (http://www.thunderbird.edu)
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

class block_announcements_tbird extends block_base {

    function init() {
		$this->title = get_string('pluginname', 'block_announcements_tbird');
    }

    function applicable_formats() {
        return array('all' => true);
    }
    
    //this class is called immediately after object is instantiated.
    //here we set the title for each instance
	function specialization() {
		$this->title = '';
		$title = get_config('block_announcements_tbird','configtitle');
		if(!empty($title))
			$this->title = $title;
	}

    //we do NOT allow multiple instances of this block!
    function instance_allow_multiple() {
        return false;
    }

    function get_content() {
    	global $CFG;
        if ($this->content !== NULL) {
            return $this->content;
        }

        $filteropt = new stdClass;
        $filteropt->overflowdiv = true;
        if ($this->content_is_trusted()) {
            // fancy html allowed only on course, category and system blocks.
            $filteropt->noclean = true;
        }

        $this->content = new stdClass;
        //hardcode for testing. Need to read global admin settings data here
        //$this->content->text = '<a href="http://thor.thunderbird.edu" target=_new">Thor</a>';
        //$this->content->footer = 'FOOTER TEXT';
        
    	//this way content comes from global configuration
    	$content = get_config('block_announcements_tbird','configcontent');
		if (isset($content) && is_string($content)) {
			$this->content->text = $content;
		}

		//add instance content, if allowed and set
		$allowcustom = get_config('block_announcements_tbird','configallowcustom');
		if(!empty($allowcustom) and $allowcustom) {
			
			if(!empty($this->config->text)) {
				$this->content->text .= '<p>' . $this->config->text . '</p>';
			}
			//for debugging :-)
			//$this->content->text .= '<p><pre>' . print_r($this->config,1) . '</pre><p>';
		}
		
		//add footer if set
		$footer = get_config('block_announcements_tbird','configfooter');
		if(!empty($footer)) {
			$this->content->footer = $footer;
		} else {
			$this->content->footer = '';
		}
		
		unset($filteropt); // memory footprint

        return $this->content;
    }

    
    /**
     * Serialize and store config data
     */
    function instance_config_save($data, $nolongerused = false) {

        $config = clone($data);
        //add instance content, if allowed and set
        $allowcustom = get_config('block_announcements_tbird','configallowcustom');
        if(!empty($allowcustom) and $allowcustom) {
	        // Move embedded files into a proper filearea and adjust HTML links to match
	        $config->text = file_save_draft_area_files($data->text['itemid'], $this->context->id, 'block_announcements_tbird', 'content', 0, array('subdirs'=>true), $data->text['text']);
	        $config->format = $data->text['format'];
        }
        parent::instance_config_save($config, $nolongerused);
    }

    function instance_delete() {
        $fs = get_file_storage();
        $fs->delete_area_files($this->context->id, 'block_announcements_tbird');
        return true;
    }

    function content_is_trusted() {
        global $SCRIPT;

        if (!$context = get_context_instance_by_id($this->instance->parentcontextid)) {
            return false;
        }
        //find out if this block is on the profile page
        if ($context->contextlevel == CONTEXT_USER) {
            if ($SCRIPT === '/my/index.php') {
                // this is exception - page is completely private, nobody else may see content there
                // that is why we allow JS here
                return true;
            } else {
                // no JS on public personal pages, it would be a big security issue
                return false;
            }
        }

        return true;
    }
    
    //////////////////////////////////////////////////////////////////////////
    
    //make sure header is shown, with global admin title, set in language file
    function hide_header(){
    	//if no title set, don't show header
    	$title = get_config('block_announcements_tbird','configtitle');
    	if(empty($title) or $title === '') {
        	return true;
    	} else {
    		return false;
    	}
    }
    
    //we have global config/settings data
	function has_config() {
		return true;
	}

    //Instance configuration only if globally allowed.
    //In that case each block can have some custom info added to the global data
	function instance_allow_config() {
		if(get_config('block_announcements_tbird','configallowcustom')) {
			return true;
		}
		return false;
	}
	
}
