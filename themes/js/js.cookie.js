/*!
 * Cookies.js - 0.3.1
 * Wednesday, April 24 2013 @ 2:28 AM EST
 *
 * Copyright (c) 2013, Scott Hamper
 * Licensed under the MIT license,
 * http://www.opensource.org/licenses/MIT
 */
(function (undefined) {
    'use strict';

    var Cookies = function (key, value, options) {
        return arguments.length === 1 ?
            Cookies.get(key) : Cookies.set(key, value, options);
    };

    // Allows for setter injection in unit tests
    Cookies._document = document;
    Cookies._navigator = navigator;

    Cookies.defaults = {
        path: '/'
    };

    Cookies.get = function (key) {
        if (Cookies._cachedDocumentCookie !== Cookies._document.cookie) {
            Cookies._renewCache();
        }

        return Cookies._cache[key];
    };

    Cookies.set = function (key, value, options) {
        options = Cookies._getExtendedOptions(options);
        options.expires = Cookies._getExpiresDate(value === undefined ? -1 : options.expires);

        Cookies._document.cookie = Cookies._generateCookieString(key, value, options);

        return Cookies;
    };

    Cookies.expire = function (key, options) {
        return Cookies.set(key, undefined, options);
    };

    Cookies._getExtendedOptions = function (options) {
        return {
            path: options && options.path || Cookies.defaults.path,
            domain: options && options.domain || Cookies.defaults.domain,
            expires: options && options.expires || Cookies.defaults.expires,
            secure: options && options.secure !== undefined ?  options.secure : Cookies.defaults.secure
        };
    };

    Cookies._isValidDate = function (date) {
        return Object.prototype.toString.call(date) === '[object Date]' && !isNaN(date.getTime());
    };

    Cookies._getExpiresDate = function (expires, now) {
        now = now || new Date();
        switch (typeof expires) {
            case 'number': expires = new Date(now.getTime() + expires * 1000); break;
            case 'string': expires = new Date(expires); break;
        }

        if (expires && !Cookies._isValidDate(expires)) {
            throw new Error('`expires` parameter cannot be converted to a valid Date instance');
        }

        return expires;
    };

    Cookies._generateCookieString = function (key, value, options) {
        key = encodeURIComponent(key);
        value = (value + '').replace(/[^!#$&-+\--:<-\[\]-~]/g, encodeURIComponent);
        options = options || {};

        var cookieString = key + '=' + value;
        cookieString += options.path ? ';path=' + options.path : '';
        cookieString += options.domain ? ';domain=' + options.domain : '';
        cookieString += options.expires ? ';expires=' + options.expires.toGMTString() : '';
        cookieString += options.secure ? ';secure' : '';

        return cookieString;
    };

    Cookies._getCookieObjectFromString = function (documentCookie) {
        var cookieObject = {};
        var cookiesArray = documentCookie ? documentCookie.split('; ') : [];

        for (var i = 0; i < cookiesArray.length; i++) {
            var cookieKvp = Cookies._getKeyValuePairFromCookieString(cookiesArray[i]);

            if (cookieObject[cookieKvp.key] === undefined) {
                cookieObject[cookieKvp.key] = cookieKvp.value;
            }
        }

        return cookieObject;
    };

    Cookies._getKeyValuePairFromCookieString = function (cookieString) {
        // "=" is a valid character in a cookie value according to RFC6265, so cannot `split('=')`
        var separatorIndex = cookieString.indexOf('=');

        // IE omits the "=" when the cookie value is an empty string
        separatorIndex = separatorIndex < 0 ? cookieString.length : separatorIndex;

        return {
            key: decodeURIComponent(cookieString.substr(0, separatorIndex)),
            value: decodeURIComponent(cookieString.substr(separatorIndex + 1))
        };
    };

    Cookies._renewCache = function () {
        Cookies._cache = Cookies._getCookieObjectFromString(Cookies._document.cookie);
        Cookies._cachedDocumentCookie = Cookies._document.cookie;
    };

    Cookies._areEnabled = function () {
        return Cookies._navigator.cookieEnabled ||
            Cookies.set('cookies.js', 1).get('cookies.js') === '1';
    };

    Cookies.enabled = Cookies._areEnabled();

    // AMD support
    if (typeof define === 'function' && define.amd) {
        define(function () { return Cookies; });
    // CommonJS and Node.js module support.
    } else if (typeof exports !== 'undefined') {
        // Support Node.js specific `module.exports` (which can be a function)
        if (typeof module !== 'undefined' && module.exports) {
            exports = module.exports = Cookies;
        }
        // But always support CommonJS module 1.1.1 spec (`exports` cannot be a function)
        exports.Cookies = Cookies;
    } else {
        window.Cookies = Cookies;
    }
})();

/*
                      _____              _____              _____             _______         
                     /\    \            /\    \            /\    \           /::\    \        
                    /::\    \          /::\    \          /::\    \         /::::\    \       
                   /::::\    \         \:::\    \        /::::\    \       /::::::\    \      
                  /::::::\    \         \:::\    \      /::::::\    \     /::::::::\    \     
                 /:::/\:::\    \         \:::\    \    /:::/\:::\    \   /:::/~~\:::\    \    
                /:::/__\:::\    \         \:::\    \  /:::/__\:::\    \ /:::/    \:::\    \   
               /::::\   \:::\    \        /::::\    \ \:::\   \:::\    \:::/    / \:::\    \  
              /::::::\   \:::\    \__    /::::::\    \_\:::\   \:::\    \:/____/   \:::\____\ 
             /:::/\:::\   \:::\____\ \  /:::/\:::\    \ \:::\   \:::\    \    |     |:::|    |
            /:::/  \:::\   \:::|    | \/:::/  \:::\____\ \:::\   \:::\____\___|     |:::|____|
            \::/   |::::\  /:::|____| /:::/    \::/    /  \:::\   \::/    /   _\___/:::/    / 
             \/____|:::::\/:::/    /\/:::/    / \/____/\   \:::\   \/____/:\ |::| /:::/    /  
                   |:::::::::/    /:::::/    /      \:::\   \:::\    \  \:::\|::|/:::/    /   
                   |::|\::::/    /\::::/____/        \:::\   \:::\____\  \::::::::::/    /    
                   |::| \::/____/  \:::\    \         \:::\  /:::/    /   \::::::::/    /     
                   |::|  ~|         \:::\    \         \:::\/:::/    /     \::::::/    /      
                   |::|   |          \:::\    \         \::::::/    /       \::::/____/       
                   \::|   |           \:::\____\         \::::/    /         |::|    |        
                    \:|   |            \::/    /          \::/    /          |::|____|        
                     \|___|             \/____/            \/____/            ~~              
                                                                                                                
     ____.________                                  _____       .___                                     .___ 
    |    |\_____  \  __ __   ___________ ___.__.   /  _  \    __| _/__  _______    ____   ____  ____   __| _/ 
    |    | /  / \  \|  |  \_/ __ \_  __ <   |  |  /  /_\  \  / __ |\  \/ /\__  \  /    \_/ ___\/ __ \ / __ |  
/\__|    |/   \_/.  \  |  /\  ___/|  | \/\___  | /    |    \/ /_/ | \   /  / __ \|   |  \  \__\  ___// /_/ |  
\________|\_____\ \_/____/  \___  >__|   / ____| \____|__  /\____ |  \_/  (____  /___|  /\___  >___  >____ |  
                 \__>           \/       \/              \/      \/            \/     \/     \/    \/     \/  
                   _______                        ___________.__        __                                    
                   \      \   ______  _  ________ \__    ___/|__| ____ |  | __ ___________                    
          ______   /   |   \_/ __ \ \/ \/ /  ___/   |    |   |  |/ ___\|  |/ // __ \_  __ \   ______          
         /_____/  /    |    \  ___/\     /\___ \    |    |   |  \  \___|    <\  ___/|  | \/  /_____/          
                  \____|__  /\___  >\/\_//____  >   |____|   |__|\___  >__|_ \\___  >__|                      
                          \/     \/           \/                     \/     \/    \/                          
*/

;
(function($, window, document, undefined) {
        'use strict';
        // undefined is used here as the undefined global variable in ECMAScript 3 is
        // mutable (ie. it can be hasMoved by someone else). undefined isn't really being
        // passed in so we can ensure the value of it is truly undefined. In ES5, undefined
        // can no longer be modified.

        // window and document are passed through as local variable rather than global
        // as this (slightly) quickens the resolution process and can be more efficiently
        // minified (especially when both are regularly referenced in your plugin).

        // Create the defaults once
        var pluginName = 'newsTicker',
                defaults = {
                        row_height: 20,
                        max_rows: 3,
                        speed: 400,
                        duration: 2500,
                        direction: 'up',
                        autostart: 1,
                        pauseOnHover: 1,
                        nextButton: null,
                        prevButton: null,
                        startButton: null,
                        stopButton: null,
                        hasMoved: function() {},
                        movingUp: function() {},
                        movingDown: function() {},
                        start: function() {},
                        stop: function() {},
                        pause: function() {},
                        unpause: function() {}
                };

        // The actual plugin constructor
        function Plugin(element, options) {
                this.element = element;
                this.$el = $(element);
                this.options = $.extend({}, defaults, options);
                this._defaults = defaults;
                this._name = pluginName;
                this.moveInterval;
                this.state = 0;
                this.paused = 0;
                this.moving = 0;
                if (this.$el.is('ul')) {
                        this.init();
                }
        }

        Plugin.prototype = {
                init: function() {
                        this.$el.height(this.options.row_height * this.options.max_rows)
                                .css({overflow : 'hidden'});

                        this.checkSpeed();

                        if(this.options.nextButton && typeof(this.options.nextButton[0]) !== 'undefined')
                                this.options.nextButton.click(function(e) {
                                        this.moveNext();
                                        this.resetInterval();
                                }.bind(this));
                        if(this.options.prevButton && typeof(this.options.prevButton[0]) !== 'undefined')
                                this.options.prevButton.click(function(e) {
                                        this.movePrev();
                                        this.resetInterval();
                                }.bind(this));
                        if(this.options.stopButton && typeof(this.options.stopButton[0]) !== 'undefined')
                                this.options.stopButton.click(function(e) {
                                        this.stop()
                                }.bind(this));
                        if(this.options.startButton && typeof(this.options.startButton[0]) !== 'undefined')
                                this.options.startButton.click(function(e) {
                                        this.start()
                                }.bind(this));
                        
                        if(this.options.pauseOnHover) {
                                this.$el.hover(function() {
                                        if (this.state)
                                                this.pause();
                                }.bind(this), function() {
                                        if (this.state)
                                                this.unpause();
                                }.bind(this));
                        }

                        if(this.options.autostart)
                                this.start();
                },

                start: function() {
                        if (!this.state) {
                                this.state = 1;
                                this.resetInterval();
                                this.options.start();
                        }
                },

                stop: function() {
                        if (this.state) {
                                clearInterval(this.moveInterval);
                                this.state = 0;
                                this.options.stop();
                        }
                },

                resetInterval: function() {
                        if (this.state) {
                                clearInterval(this.moveInterval);
                                this.moveInterval = setInterval(function() {this.move()}.bind(this), this.options.duration);
                        }
                },

                move: function() {
                         if (!this.paused) this.moveNext();
                },

                moveNext: function() {
                        if (this.options.direction === 'down')
                                this.moveDown();
                        else if (this.options.direction === 'up')
                                this.moveUp();
                },

                movePrev: function() {
                        if (this.options.direction === 'down')
                                this.moveUp();
                        else if (this.options.direction === 'up')
                                this.moveDown();
                },

                pause: function() {
                        if (!this.paused) this.paused = 1;
                        this.options.pause();
                },

                unpause: function() {
                        if (this.paused) this.paused = 0;
                        this.options.unpause();
                },

                moveDown: function() {
                        if (!this.moving) {
                                this.moving = 1;
                                this.options.movingDown();
                                this.$el.children('li:last').detach().prependTo(this.$el).css('marginTop', '-' + this.options.row_height + 'px')
                                        .animate({marginTop: '0px'}, this.options.speed, function(){
                                                this.moving = 0;
                                                this.options.hasMoved();
                                        }.bind(this));
                        }
                },

                moveUp: function() {
                        if (!this.moving) {
                                this.moving = 1;
                                this.options.movingUp();
                                var element = this.$el.children('li:first');
                                element.animate({marginTop: '-' + this.options.row_height + 'px'}, this.options.speed,
                                        function(){
                                                element.detach().css('marginTop', '0').appendTo(this.$el);
                                                this.moving = 0;
                                                this.options.hasMoved();
                                        }.bind(this));
                        }
                },

                updateOption: function(option, value) {
                        if (typeof(this.options[option]) !== 'undefined'){
                                this.options[option] = value;
                                if (option == 'duration' || option == 'speed'){
                                    this.checkSpeed();
                                    this.resetInterval();
                                }
                        }
                },

                getState: function() {
                        if (paused) return 2
                        else return this.state;//0 = stopped, 1 = started
                },

                checkSpeed: function() {
                        if (this.options.duration < (this.options.speed + 25))
                                this.options.speed = this.options.duration - 25;
                },

                destroy: function() {
                        this._destroy(); //or this.delete; depends on jQuery version
                }
        };

        // A really lightweight plugin wrapper around the constructor,
        // preventing against multiple instantiations
        $.fn[pluginName] = function(option) {
                var args = arguments;
                
                return this.each(function() {
                        var $this = $(this),
                                data = $.data(this, 'plugin_' + pluginName),
                                options = typeof option === 'object' && option;
                        if (!data) {
                                $this.data('plugin_' + pluginName, (data = new Plugin(this, options)));
                        }
                        // if first argument is a string, call silimarly named function
                        // this gives flexibility to call functions of the plugin e.g.
                        //   - $('.dial').plugin('destroy');
                        //   - $('.dial').plugin('render', $('.new-child'));
                        if (typeof option === 'string') {
                                data[option].apply(data, Array.prototype.slice.call(args, 1));
                        }
                });
        };
})(jQuery, window, document);
