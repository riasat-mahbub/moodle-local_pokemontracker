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
 * @package   local_pokemon_tracker
 * @copyright 2020, Riasat Mahbub <riasat.mahbub@brainstation-23.com>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

//moodleform is defined in formslib.php
require_once("$CFG->libdir/formslib.php");

class edit_form extends moodleform {
    //Add elements to form

    protected $id;

    public function __construct($actionUrl, $id=null){
        $this->id = $id;
        parent::__construct($actionUrl);        
    }
    
    public function definition() {
        global $CFG;
       
        $mform = $this->_form; // Don't forget the underscore! 

        $mform->addElement('hidden', 'id', get_string('id', 'local_pokemon_tracker'));
        $mform->setType('id', PARAM_INT);
        $mform->setDefault('id', $this->data->id ?? "");

        $mform->addElement('text', 'pokemonname', get_string('pkmn_name', 'local_pokemon_tracker')); // Add elements to your form.
        $mform->setType('pokemonname', PARAM_NOTAGS);                   // Set type of element.
        $mform->setDefault('pokemonname', get_string('enter_pkmn', 'local_pokemon_tracker'));        // Default value.

        $types = array("None","Normal", "Fire", "Water", "Grass", "Flying", "Fighting", "Poison", "Electric", "Ground", "Rock", "Psychic", "Ice", "Bug", "Ghost", "Steel", "Dragon", "Dark", "Fairy");

        $mform->addElement('select',  'pokemontype1',  get_string('pkmn_type', 'local_pokemon_tracker'),  $types);
        $mform->setDefault('pokemontype1', 0);

        $mform->addElement('select',  'pokemontype2',  get_string('pkmn_type', 'local_pokemon_tracker'),  $types);
        $mform->setDefault('pokemontype2', 0);

        $this->add_action_buttons();

    }
    //Custom validation should be added here
    function validation($data, $files) {
        return array();
    }
}