/*
Name:           UI Elements / Charts - Examples
Written by:     Okler Themes - (http://www.okler.net)
Theme Version:  1.3.0
*/

(function( $ ) {

    'use strict';
    /*
    Morris: Bar
    */
    Morris.Bar({
        resize: true,
        element: 'morrisBar',
        data: morrisBarData,
        xkey: 'y',
        ykeys: ['a', 'b'],
        labels: ['Series A', 'Series B'],
        hideHover: true,
        barColors: ['#0088cc', '#2baab1']
    });

}).apply( this, [ jQuery ]);