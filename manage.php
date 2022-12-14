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

require_once(__DIR__ . '/../../config.php');
global $DB;
global $PAGE;

$PAGE->set_url(new moodle_url('/local/pokemon_tracker/manage.php'));
$PAGE->set_context(\context_system::instance());
$PAGE->set_title(get_string('manage_pkmn', 'local_pokemon_tracker'));

$pokemons = $DB->get_records('local_pokemon');

$types = array("None","Normal", "Fire", "Water", "Grass", "Flying", "Fighting", "Poison", "Electric", "Ground", "Rock", "Psychic", "Ice", "Bug", "Ghost", "Steel", "Dragon", "Dark", "Fairy");

foreach($pokemons as $pokemon){
    $pokemon->pokemontype1 = $types[$pokemon->pokemontype1];
    $pokemon->pokemontype2 = $types[$pokemon->pokemontype2]; 
}

echo $OUTPUT->header();

$templatecontext = (object)[
    'pokemons' => array_values($pokemons),
    'createurl' =>new moodle_url('/local/pokemon_tracker/edit.php')
];

echo $OUTPUT->render_from_template('local_pokemon_tracker/manage', $templatecontext);
$PAGE->requires->js_call_amd('local_pokemon_tracker/confirmdelete', 'init', array());

echo $OUTPUT->footer();
