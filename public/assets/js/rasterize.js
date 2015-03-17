var page = require("webpage").create();
var system = require("system");

page.paperSize = {
    format: 'Legal',
    orientation: 'Landscape',
    margin: {
        top: '.1in',
        left: '.1in',
        right: '.1in',
        bottom: '.1in'
    }
}

page.zoomFactor = .5;

page.open(system.args[1], function (status) {
    window.setTimeout(function () {
        page.render(system.args[2]);
        phantom.exit();
    }, 5000);
});

page.onError = function(msg, trace) {
    console.log(msg);
}