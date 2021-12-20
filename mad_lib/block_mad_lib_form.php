<?php
// This file is part of Moodle - http://moodle.org/
// help
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
//test
require_once("$CFG->libdir/formslib.php");

class block_mad_lib_form extends moodleform {
    public function definition() {
        global $CFG, $COURSE, $PAGE;
        //INIT
        $autocomplete = $CFG->wwwroot . '/blocks/mad_lib/js/module.js';
        $url          = new moodle_url($autocomplete);
        $PAGE->requires->js($url);
        $categories = array(1 => 'noun', 2 => 'verb', 3 => 'adjective');
        $context = get_context_instance(CONTEXT_COURSE,$COURSE->id);
        $mform = $this->_form; 
        //Shows different forms for different capabilities
        if($iswordmanager = has_capability('block/mad_lib:wordmanager',$context) | $issentencemanager = has_capability('block/mad_lib:sentencemanager',$context)){
            if($iswordmanager){
                $mform->addElement('html','<div class="qheader"><p>Add your custom Words! </p></div>');
                $mform->addElement('text', 'word','Word');
                $mform->setDefault('word', ' ');   
                $mform->addElement('select','category','Category',$categories);
            }
            if($issentencemanager){
                $mform->addElement('html','<div class="qheader"><p>Add your custom Sentences! </p></div>');
                $mform->addElement('text', 'sentence','Sentence');
                $mform->setDefault('sentence', ' ');
                $mform->addElement('button', 'addspacea','Add Adjective');
                $mform->addElement('button', 'addspacev','Add Verb');
                $mform->addElement('button', 'addspacen','Add Noun');
            }  
            $mform->setType('text', PARAM_NOTAGS);
            $this->add_action_buttons(false);
        }
    }
}
