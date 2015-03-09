var page = require("webpage").create();
var system = require("system");

page.paperSize = {
    format: 'Letter',
    orientation: 'Portrait',
    margin: {
        top: '.2in',
        left: '.2in',
        right: '.2in',
        bottom: '.2in'
    }
}

page.zoomFactor = .8;

page.open(system.args[1], function (status) {
    window.setTimeout(function () {
        page.render(system.args[2]);

        phantom.exit();
    }, 5000);
});

page.onError = function(msg, trace) {
    console.log(msg);
}