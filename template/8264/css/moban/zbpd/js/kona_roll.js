/*
 * kona_roll.js
 * @author lovekonakona@gmail.com
 * @version 0.2
 */

;(function() {
    var $ = jQuery = window.jQuery;

    var Roll = function(selector, options) {
        this.setSelector(selector)
            .setOptions(options)
            .init()
            .run();
    }

    Roll.setJQuery = function(j) {
        $ = jQuery = j;
    }

    Roll.prototype = {
        selector: null,
        child: null,
        isHorizontal: true,
        isNext: true,
        firstInner: null,
        secondInner: null,
        itemsWidth: 0,
        itemsIndex: 0,
        itemsNum: 0,
        enable: true,
        isRunning: false,
        options: {
            direction: 3,
            speed: 1000,
            delay: 2000,
            easing: 'swing',
            auto: true,
            px: 1,
            step: 1,
            isCeil: false,
            mode: 'item', // item, px
            mouseOverStop: true,
            control: true,
            startEvent: 'mousedown',
            endEvent: 'mouseup',
            along: false,
            prev: null,
            next: null,
            minItemsWidth: 0
        },
        modeName: {
            posName: 'left',
            widthName: 'width',
            outerWidthName: 'outerWidth'
        },
        setSelector: function(selector) {
            this.selector = $(selector);
            return this;
        },
        setOptions: function(options) {
            options = this.applyShortcut(options);

            if (typeof options['direction'] !== 'undefined') {
                this.setDirection(options['direction']);
                delete options['direction'];
            }

            this.options = $.extend({}, this.options, options);
            return this;
        },
        setDirection: function(d) {
            if (typeof d === 'string') {
                if (d != '' && d >= 0 || d <= 3) {
                    d = d - 0;
                } else {
                    switch (d) {
                        case 'up': case 'top':
                            d = 0;
                            break;
                        case 'right':
                            d = 1;
                            break;
                        case 'down': case 'bottom':
                            d = 2;
                            break;
                        case 'left': default:
                            d = 3;
                            break;
                    }
                }
            } else if (typeof d === 'number' && (d < 0 || d > 3) || typeof d !== 'number') {
                d = 3;
            }

            this.isHorizontal = !!(d & 1);
            this.isNext = d == 0 || d == 3;
            this.options.direction = d;
            this.resetModeName();
            return this;
        },
        applyShortcut: function(options) {
            var l, // Longname
                shortcut = {
                    'd': 'direction',
                    's': 'speed',
                    'de': 'delay',
                    'm': 'mode',
                    'a': 'auto'
                };
            for (var s in shortcut) {
                if (typeof options[s] !== 'undefined') {
                    l = shortcut[s];
                    if (typeof options[l] === 'undefined') {
                        options[l] = options[s];
                    }
                    delete options[s];
                }
            }
            return options;
        },
        resetModeName: function() {
            if (this.isHorizontal) {
                this.modeName = {
                    posName: 'left',
                    widthName: 'width',
                    outerWidthName: 'outerWidth'
                }
            } else {
                this.modeName = {
                    posName: 'top',
                    widthName: 'height',
                    outerWidthName: 'outerHeight'
                }
            }
            return this;
        },
        init: function() {
            var that = this, 
                first_inner,
                second_inner;

            this.child = this.selector.children();
            this.itemsNum = this.child.size();

            this.selector.css({
                'position': 'relative',
                'overflow': 'hidden',
                'width': this.selector.width() + 'px',
                'height': this.selector.height() + 'px'
            });

            if (this.isHorizontal) {
                this.child.css({'float': 'left'});
            }
            this.initItemsWidth();
            this.selector.wrapInner($('<div></div>')
                .css({'overflow': 'hidden', 'float': 'left'})
                [this.modeName.widthName](this.itemsWidth));

            first_inner = $('<div></div>').css({
                'overflow': 'hidden',
                'position': 'relative',
                'width': this.selector.width() + 'px',
                'height': this.selector.height() + 'px'
            });
            this.selector.wrapInner(first_inner);
            this.firstInner = this.selector.children();
            
            second_inner = $('<div></div>').css({
                'overflow': 'hidden',
                'position': 'absolute',
                'top': 0,
                'left': 0
            });

            second_inner.width(this.child.eq(0).width());
            second_inner.height(this.child.eq(0).height());
            second_inner[this.modeName.widthName](this.itemsWidth * 2);

            this.selector.children().wrapInner(second_inner);
            this.secondInner = this.firstInner.children();

            if (this.itemsWidth < (!this.options.minItemsWidth ? this.selector[this.modeName['widthName']]() : this.options.minItemsWidth)) {
                this.enable = false;
                return this;
            }
            this.secondInner.append(this.secondInner.children().clone());
            this.initControl();

            return this;
        },
        initItemsWidth: function() {
            var that = this,
                i,
                step = this.options.step,
                width = 0;

            if (this.options.isCeil && step > 1 && this.itemsNum % step > 0) {
                for (i = 0; i < step; ++i) {
                    width += this.child.eq(i)[this.modeName['outerWidthName']](1);
                }
                width *= parseInt(this.itemsNum / step) + 1;
            } else {
                this.child.each(function() {
                    width += $(this)[that.modeName['outerWidthName']](1);
                });
            }
            this.itemsWidth = width;
        },
        initControl: function() {
            var that = this,
                prev = this.options.prev,
                next = this.options.next;
            if (this.options.control) {
                if (prev) {
                    if (this.options.startEvent) {
                        $(prev)[this.options.startEvent](function() {
                            that.prev();
                        });
                    }
                    if (this.options.endEvent) {
                        $(prev)[this.options.endEvent](function() {
                            that.finishControlEvent();
                        });
                    }
                }
                if (next) {
                    if (this.options.startEvent) {
                        $(next)[this.options.startEvent](function() {
                            that.next();
                        });
                    }
                    if (this.options.endEvent) {
                        $(next)[this.options.endEvent](function() {
                            that.finishControlEvent();
                        });
                    }
                }
            }
        },
        initControlEvent: function() {
            /*
            switch (this.options.mouseEvent) {
                case 'mousedown':
                    this.options.endEvent = 'mouseup';
                    break;
                case 'mouseover':
                    this.options.endEvent = 'mouseout';
                    break;
                default:
                    break;
            }
            */
        },
        run: function() {
            if (this.enable) {
                this.autoRoll();
                if (this.options.mouseOverStop) {
                    this.mouseOverStop();
                }
            }
            return this;
        },
        stop: function() {
            clearInterval(this.innerval);
        },
        mouseOverStop: function() {
            var that = this;
            $(this.selector).hover(function() {
                that.stop();
            }, function() {
                that.autoRoll();
            });
        },
        autoRoll: function() {
            var that = this;
            if (this.options.auto) {
                this.innerval = setInterval(function() {
                    that.roll();
                }, this.options.delay + this.options.speed);
            }
        },
        roll: function(is_next) {
            var that = this,
                params;

            if (this.isRunning) {
                return this;
            }

            if (this.enable) {
                this.secondInner.stop(1, 1);
                this.isRunning = true;
                params = this.accountPosition(is_next);
                if (this.options.mode == 'px') {
                    that.secondInner.css(params);
                    that.isRunning = false;
                } else {
                    this.secondInner.animate(params, this.options.speed, this.options.easing, function() {
                        that.isRunning = false;
                    });
                }
            }
            return this;
        },
        accountPosition: function(is_next) {
            var pos = {},
                unit,
                modename = this.modeName;
            pos[modename.posName] = parseInt(this.secondInner.css(modename.posName));

            if (typeof is_next === 'undefined') {
                is_next = this.isNext;
            }
            unit = is_next ? -1 : 1;
            if (this.options.mode == 'item') {
                unit *= this.options.step;
            }

            if (is_next && pos[modename.posName] <= -this.itemsWidth) {
                pos[modename.posName] += this.itemsWidth;
                this.secondInner.css(modename.posName, pos[modename.posName]);
            } else if (!is_next && pos[modename.posName] >= 0) {
                pos[modename.posName] -= this.itemsWidth;
                this.secondInner.css(modename.posName, pos[modename.posName]);
            }

            if (this.options.mode == 'px') {
                pos[modename.posName] += unit * this.options.px;
            } else if (this.options.mode == 'item') {
                this.itemsIndex -= unit;
                if (this.itemsIndex < 0) {
                    this.itemsIndex += this.itemsNum;
                } else {
                    this.itemsIndex %= this.itemsNum;
                }
                pos[modename.posName] += unit * this.child.eq(this.itemsIndex - 1)[modename['outerWidthName']](1);
            }
            pos[modename.posName] += 'px';

            return pos;
        },
        prev: function(along) {
            var that = this;
            this.stop();
            along = typeof along !== 'undefined' ? along : this.options.along;
            this.roll(0);
            if (along) {
                this.innerval = setInterval(function() {
                    that.roll(0);
                }, this.options.delay + this.options.speed);
            }
        },
        next: function(along) {
            var that = this;
            this.stop();
            along = typeof along !== 'undefined' ? along : this.options.along;
            this.roll(1);
            if (along) {
                this.innerval = setInterval(function() {
                    that.roll(1);
                }, this.options.delay + this.options.speed);
            }
        },
        finishControlEvent: function() {
            this.stop();
            this.autoRoll();
        }
    }

    $.fn.extend({
        konaRoll: function(options) {
            new Roll(this, options);
            return this;
        }
    });

    window.kona_roll = function(selector, options) {
        return new Roll(selector, options);
    }
})();