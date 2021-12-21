<?php
// This file is part of Moodle - http://moodle.org/
//test
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

require_once('block_mad_lib_form.php');
    class block_mad_lib extends block_base {
        public function init(){
            $this->title = get_string('pluginname','block_mad_lib');
           
        }
        public function get_content() {

            //INIT
            global $DB, $COURSE, $USER;
            $categories = array("[wordn]","[worda]","[wordv]");
            $madlib = '';
            $count = $DB->get_record_sql('SELECT COUNT(*) AS counter FROM {mad_lib_sentence}');
            $context = get_context_instance(CONTEXT_COURSE,$COURSE->id);
            $random = rand(1, $count->counter);
            $sentence = $DB->get_record_sql('SELECT sentence FROM {mad_lib_sentence} WHERE id = ?',[$random]);
            $nouns = $DB->get_records_sql("SELECT id, word,category 
            FROM {mad_lib_word} 
            WHERE category = 1");
            $verbs =  $DB->get_records_sql("SELECT id, word,category 
            FROM {mad_lib_word} 
            WHERE category = 2");
            $adjectives = $DB->get_records_sql("SELECT id, word,category 
            FROM {mad_lib_word} 
            WHERE category = 3");
            if ($this->content !== null) {
              return $this->content;
            }
            //Parse sentence
            $noun_counter = substr_count($sentence->sentence,"[wordn]");
            $adjective_counter = substr_count($sentence->sentence,"[worda]");
            $verb_counter = substr_count($sentence->sentence,"[wordv]");
            $this->content =  new stdClass;
            if(!$sentence){
                $madlib = '<p>There\'s no new sentences. Try to submit your own or wait for another user to submit theirs!</p>';
            }else if(count($nouns) == 0 || count($verbs) == 0 || count($adjectives == 0)){
                $madlib ='<p>There\s not enough words to show some mad libs. Try to submit your own or wait for another user to submit theirs!</p>';
            }else{
                $madlib = '<p>We choose this Mad Lib for you:</p>';
                
                for ($i='1'; $i <= $noun_counter ; $i++) {
                    $array_keys = array_keys($nouns);
                    $randomizer = rand(0,count($array_keys)-1);
                    $randomized_word = $nouns[$array_keys[$randomizer]]->word;
                    $pos = strpos($sentence->sentence, $categories[0]);
                    if ($pos !== false) {
                        $sentence->sentence = substr_replace($sentence->sentence,$randomized_word,$pos,strlen("[wordn]"));
                    }
                }
                for ($i='1'; $i <= $adjective_counter ; $i++) { 
                    $array_keys = array_keys($adjectives);
                    $randomizer = rand(0,count($array_keys)-1);
                    $randomized_word = $adjectives[$array_keys[$randomizer]]->word;
                    $pos = strpos($sentence->sentence, $categories[1]);
                    if ($pos !== false) {
                        $sentence->sentence = substr_replace($sentence->sentence,$randomized_word,$pos,strlen("[worda]"));
                    }
                }
                for ($i='1'; $i <= $verb_counter ; $i++) { 
                    $array_keys = array_keys($verbs);
                    $randomizer = rand(0,count($array_keys)-1);
                    $randomized_word = $verbs[$array_keys[$randomizer]]->word;
                    $pos = strpos($sentence->sentence, $categories[2]);
                    if ($pos !== false) {
                        $sentence->sentence = substr_replace($sentence->sentence,$randomized_word,$pos,strlen("[wordv]"));
                    }
                }
    
                $madlib .= '<p>'.$sentence->sentence.'</p>';
            }
            $this->content->text = $madlib;
            $mform = new block_mad_lib_form();
            if ($mform->is_cancelled()) {
                return;
            } else if ($fromform = $mform->get_data()) {
                //submit data to table
                if($fromform->word){
                    $datawordsend = new stdclass();
                    $datawordsend->user_id = $USER->id;
                    $datawordsend->word = $fromform->word;
                    $datawordsend->category = $fromform->category;
                    $DB->insert_record("mad_lib_word",$datawordsend);
                }
                if($fromform->sentence){
                    $datasentencesend = new stdclass();
                    $datasentencesend->user_id = $USER->id;
                    $datasentencesend->sentence = $fromform->sentence;
                    $DB->insert_record("mad_lib_sentence",$datasentencesend);
                }
                redirect(new moodle_url(''));
            } 
            $this->content->footer = $mform->render();
            return $this->content;
        }
    }
//test
//test
