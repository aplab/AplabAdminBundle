/**
 *
 * @param data
 * @param append_to
 * @constructor
 */
function AplAdminMenu(data, append_to) {
    append_to = append_to || $('body');
    var instanceName = data.id;
    console.log(data);

    (
        /**
         * static init
         *
         * @param o self o same object
         * @param c same function
         */
        function (o, c) {
            if (undefined === c.instances) {
                c.instances = [];
            }
            if (undefined === c.getInstance) {
                c.getInstance = function (instance_name) {
                    if (undefined !== c.instances[instance_name]) {
                        return c.instances[instance_name];
                    }
                    return null;
                };
            }
            if (undefined !== c.instances[instanceName]) {
                console.log('Instance already exists: ' + instanceName);
                console.error('Instance already exists: ' + instanceName);
                throw new Error('Instance already exists: ' + instanceName);
            }
            c.instances[instanceName] = o;
            c.instanceNumber = Object.keys(c.instances).length;
        }
    )(this, arguments.callee);

    /**
     * Create menu items
     * @param container
     * @param data
     * @param level
     * @returns {number}
     */
    var createMenuItems = function (container, data, level) {
        level = level || 0;
        var ul = $('<ul>');
        if (0 === level) {
            ul.addClass('apl-admin-menu');
        } else {
            ul.addClass('apl-admin-submenu');
        }
        var counter = 0;
        for (var id in data) {
            counter++;
            // noinspection JSUnfilteredForInLoop
            var item = data[id];
            var li = $('<li>');
            li.prop('id', item.id);
            ul.append(li);
            var child_number = 0;
            if (item.items !== undefined) {
                child_number = createMenuItems(li, item.items, level + 1);
            }
            var span = $('<span>');
            span.text(item.name);
            var icon = null;
            if (item.icon !== undefined && item.icon.name !== undefined) {
                icon = $('<i class="' + item.icon.name + '" aria-hidden="true"></i>');
            }
            if (child_number) {
                li.prepend(span);
                span.click(function () {
                    var $this = $(this);
                    var $next = $this.next();
                    var $parent = $this.parent();
                    $next.slideToggle();
                    $parent.toggleClass('open');
                    var exclude = append_to.find('.apl-admin-submenu').has($next);
                    append_to.find('.apl-admin-submenu').not($next).not(exclude).slideUp().parent().removeClass('open');
                    if ($parent.hasClass('open')) {
                        Cookies.set(
                            'apl-admin-menu-' + instanceName,
                            $parent.prop('id'),
                            {
                                expires: 7,
                                path: '/'
                            }
                        );
                        return;
                    }
                    var closest = $parent.closest('.open');
                    if (closest.length) {
                        Cookies.set(
                            'apl-admin-menu-' + instanceName,
                            closest.prop('id'),
                            {
                                expires: 7,
                                path: '/'
                            }
                        );
                        return;
                    }
                    Cookies.set(
                        'apl-admin-menu-' + instanceName,
                        '',
                        {
                            expires: 7,
                            path: '/'
                        }
                    );
                });
                span.append('<i class="fas fa-chevron-down"></i>');
                if (icon) {
                    span.append(icon);
                }
            } else {
                if (item.action !== undefined) {
                    if (item.action.type === 'url') {
                        var a = $('<a>');
                        a.text(item.name);
                        a.prop('href', item.action.url);
                        if (item.action.hasOwnProperty('target')) {
                            a.prop('target', item.action.target);
                        }
                        li.append(a);
                        a.append(icon);
                    } else {
                        li.prepend(span);
                        if (item.action.type === 'callback') {
                            (function (v)//isolation
                            {
                                span.click(function () {
                                    eval(v);
                                });
                            })(item.action.callback);
                        }
                        span.append(icon);
                    }
                } else {
                    li.prepend(span);
                    span.append(icon);
                }
            }
        }
        if (counter) {
            container.append(ul);
        }
        return counter;
    };

    createMenuItems(append_to, data.items);

    /**
     * Set current item
     */
    var setCurrent = function () {
        var current_id = Cookies.get('apl-admin-menu-' + instanceName);
        var current = $('#' + current_id);
        if (!current.length) {
            return;
        }
        current = current.eq(0);
        current.addClass('open').children('.apl-admin-submenu').show();
        append_to.find('.apl-admin-submenu').has(current).show().parent().addClass('open');
    };

    /**
     * Set current item
     */
    setCurrent();

    /**
     * Delay if first run workaround
     */
    setTimeout(function () {
        append_to.find('i.fa-chevron-down').addClass('trans');
    }, 100);

    /**
     * Disable selection
     * @param o
     */
    var disableSelection = function (o) {
        $(o).onselectstart = function () {
            return false;
        };
        $(o).unselectable = "on";
        $(o).css({
            '-moz-user-select': 'none',
            '-khtml-user-select': 'none',
            '-webkit-user-select': 'none',
            '-o-user-select': 'none',
            'user-select': 'none'
        });
    };

    /**
     * Disable selection call
     */
    disableSelection(append_to);
}