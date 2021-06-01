/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import '../scss/app.scss'

// start the Stimulus application
import '../bootstrap'
import 'jquery'
import 'popper.js'

import './exercice'
import './mathjax-config'

$(document).ready(function (){
    let icon = $('#hamburger-menu')
    let iconSVG = $('#hamburger-icon svg');

    let actus = $('#actus')

    if(screen.width <= 800){
        actus.toggleClass("w-75")
    }

    $('#hamburger-icon').click(function (){
        if (!icon.is(":visible")){
            icon.show()
            iconSVG.removeClass('rotated-inversed')
            iconSVG.toggleClass('rotated');
        }else{
            $('#hamburger-menu').hide()
            iconSVG.removeClass('rotated')
            iconSVG.toggleClass('rotated-inversed');
        }
    })

    $('#myTab a[href="#profile"]').tab('show') // Select tab by name
    $('#myTab li:first-child a').tab('show') // Select first tab
    $('#myTab li:last-child a').tab('show') // Select last tab
    $('#myTab li:nth-child(3) a').tab('show') // Select third tab
})