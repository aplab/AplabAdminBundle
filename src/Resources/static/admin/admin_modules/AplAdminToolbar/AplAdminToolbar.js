/**
 * Created by polyanin on 16.11.2016.
 */
// noinspection JSUnusedGlobalSymbols
/**
 *
 * @param data
 * @param append_to
 * @constructor
 */
function AplAdminToolbar(data, append_to)
{
    append_to = append_to || $('body');
    var instanceName = data.id;

    (
        /**
         * static init
         *
         * @param o self same object
         * @param c same function
         */
        function(o, c) {
            if (undefined === c.instances) {
                c.instances = [];
            }
            if (undefined === c.getInstance) {
                c.getInstance = function(instance_name)
                {
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

    var menu = $('<div>').prop({
        id: instanceName,
        class: 'apl-action-menu'
    });
    append_to.append(menu);

    var wrapper = $('<div>').prop({
        class: 'apl-action-menu-wrapper'
    });
    menu.append(wrapper);

    var container = $('<div>').prop({
        class: 'apl-action-menu-container'
    });
    wrapper.append(container);

    var content = $('<div>').prop({
        class: 'apl-action-menu-content'
    });
    container.append(content);

    var scrollbar = $('<div>').prop({
        class: 'apl-action-menu-scrollbar'
    });
    wrapper.append(scrollbar);

    this.show = function () {
        menu.show();
        calcWidth();
        init();
    };

    /**
     * Create menu items
     */
    var createMenuItems = function ()
    {
        var items = data.items;
        for (var id in items) {
            // noinspection JSUnfilteredForInLoop
            var item = items[id];
            var span;
            var icon = null;
            if (item.icon !== undefined && item.icon.length) {
                icon = '';
                for (var icon_item_id in item.icon) {
                    icon += '<i class="' + item.icon[icon_item_id] + '" aria-hidden="true"></i>';
                }
                icon = $(icon);
            }
            if (item.url !== undefined) {
                var a = $('<a>');
                a.text(item.name);
                a.prop('href', item.url);
                if (item.hasOwnProperty('target') && item.target) {
                    a.prop('target', item.target);
                }
                content.append(a);
                a.append(icon);
            } else if (item.handler !== undefined) {
                span = $('<span>');
                span.html(item.caption);
                content.append(span);
                (function (v)//isolation
                {
                    span.click(function ()
                    {
                        eval(v);
                        menu.hide();
                    });
                })(item.handler);
                span.append(icon);
            } else {
                span = $('<span>');
                span.text(item.caption);
                content.append(span);
                span.append(icon);
            }
        }
    };

    createMenuItems();
}