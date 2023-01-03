/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (main.scss in this case)
import '/assets/styles/main.scss';

// start the Stimulus application
import './bootstrap';

import './scripts/back/link.js';

import './scripts/front/slider';

import './scripts/front/songSerializer';

// import './scripts/front/responsiveMenu';

import AjaxService from "./scripts/front/ajaxService";

const ajaxDisplay = new AjaxService(document.querySelector('#js-ajax'))

