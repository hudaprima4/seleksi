$(document).ready(function () {
    var base_url = window.location.origin;
    new WOW().init();
    var commands = {
        'Home': function () {
            window.location = base_url + "/epen";
        }

    };

    annyang.addCommands(commands);
    annyang.start();
    $('#far-clouds').pan({fps: 30, speed: 1.5, dir: 'left', depth: 30});
    $('#near-clouds').pan({fps: 30, speed: 2.5, dir: 'left', depth: 70});

});