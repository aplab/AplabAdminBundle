/**
 * Created by polyanin on 17.11.2016.
 */
function AplDataTable(container) {

    (
        /**
         * static init
         *
         * @param o self same object
         * @param c same function
         */
        function (o, c) {
            if (undefined === c.instance) {
                c.instance = o;
            } else {
                if (c.instance !== o) {
                    console.log('Instance already exists. Only one instance allowed!');
                    throw new Error('Instance already exists. Only one instance allowed!');
                }
            }
            if (undefined === c.getInstance) {
                c.getInstance = function () {
                    return c.instance;
                };
            }
        }
    )(this, arguments.callee);

    var prefix = '.apl-data-table-';

    var content = container.find(prefix + 'content').eq(0);

    var scroll_horizontal_wrapper = container.find(prefix + 'scroll-horizontal-wrapper').eq(0);
    var scroll_horizontal = container.find(prefix + 'scroll-horizontal').eq(0);
    var scroll_horizontal_content = container.find(prefix + 'scroll-horizontal-content').eq(0);

    var scroll_vertical_wrapper = container.find(prefix + 'scroll-vertical-wrapper').eq(0);
    var scroll_vertical = container.find(prefix + 'scroll-vertical').eq(0);
    var scroll_vertical_content = container.find(prefix + 'scroll-vertical-content').eq(0);

    var body = container.find(prefix + 'body').eq(0);
    var data = container.find(prefix + 'data').eq(0);

    var sidebar_body_col = container.find(prefix + 'sidebar-body-col').eq(0);
    var sidebar_header = container.find(prefix + 'sidebar-header').eq(0);
    var sidebar_header_checkbox = container.find(prefix + 'sidebar-header :checkbox').eq(0);

    var header_row = container.find(prefix + 'header-row').eq(0);

    var scrollbar_calc_outer = $('<div>').addClass('apl-data-table-scrollbar-calc-outer');
    var scrollbar_calc_inner = $('<div>').addClass('apl-data-table-scrollbar-calc-inner');

    var prev_trigger = container.find(prefix + 'prev').eq(0);
    var next_trigger = container.find(prefix + 'next').eq(0);
    var page_select = container.find(prefix + 'page select').eq(0);
    var limit_select = container.find(prefix + 'limit select').eq(0);
    var base_url = container.data('baseUrl');

    container.append(scrollbar_calc_outer);
    scrollbar_calc_outer.append(scrollbar_calc_inner);

    data.children('div').on('click', function () {
        // if (isTouchDevice()) {
        //     return;
        // }
        var o = $(this);
        data.children('div').not(o).removeClass('apl-data-table-active');
        o.toggleClass('apl-data-table-active');
    });

    data.children('div').each(function (i, o) {
        var checkbox_code = '<div class="custom-control custom-checkbox">\n' +
            '  <input type="checkbox" class="custom-control-input" id="%%PLACEHOLDER%%">\n' +
            '  <label class="custom-control-label" for="%%PLACEHOLDER%%"></label>\n' +
            '</div>'
        var div = $('<div>');
        var o = $(o);
        div.css({
            height: o.height()
        });
        sidebar_body_col.append(div);
        // div.append('<input type="checkbox">');
        div.append($(checkbox_code.replace(/%%PLACEHOLDER%%/g, 'apl-data-table-sidebar-header-check-' + i)));
    });

    /**
     *
     * @returns {{h: number, v: number}}
     */
    var calcScrollbarWidth = function () {
        var ow = scrollbar_calc_outer.width();
        var iw = scrollbar_calc_inner.width();
        var oh = scrollbar_calc_outer.height();
        var ih = scrollbar_calc_inner.height();
        return {
            h: Math.round(oh - ih),
            v: Math.round(ow - iw)
        }
    };

    var init = function () {
        var system_scrollbar_size = calcScrollbarWidth();
        var data_width = data.width();
        var data_height = data.height();
        scroll_horizontal_content.css({
            width: data_width
        });
        scroll_vertical_content.css({
            height: data_height
        });
        var threshold = 0;
        var hcalc = function () {
            if ((data_width - scroll_horizontal.width()) > threshold) {
                content.css({
                    bottom: system_scrollbar_size.h
                });
                scroll_horizontal_wrapper.css({
                    height: system_scrollbar_size.h || 4,
                });
                scroll_vertical_wrapper.css({
                    bottom: system_scrollbar_size.h
                });
            } else {
                content.css({
                    bottom: 0
                });
                scroll_horizontal_wrapper.css({
                    height: 0
                });
                scroll_vertical_wrapper.css({
                    bottom: 0
                });
            }
        };
        var vcalc = function () {
            if ((data_height - scroll_vertical.height()) > threshold) {
                content.css({
                    right: system_scrollbar_size.v
                });
                scroll_vertical_wrapper.css({
                    width: system_scrollbar_size.v || 4
                });
                scroll_horizontal_wrapper.css({
                    right: system_scrollbar_size.v
                });
            } else {
                content.css({
                    right: 0
                });
                scroll_vertical_wrapper.css({
                    width: 0
                });
                scroll_horizontal_wrapper.css({
                    right: 0
                });
            }
        };
        vcalc();
        hcalc();
        vcalc();
        setTimeout(function () {
            var sidebar_body_col_divs = sidebar_body_col.children('div');
            data.children('div').each(function (i, o) {
                sidebar_body_col_divs.eq(i).css({
                    height: $(o).height()
                });
            });
        }, 1);
    };

    init();

    this.reinit = function () {
        setTimeout(function () {
            init();
        }, 10);
        setTimeout(function () {
            init();
        }, 100);
        setTimeout(function () {
            init();
        }, 1000);
    };

    $(window).resize(function () {
        init();
    });

    scroll_vertical.scroll(function () {
        var scroll_top = -1 * $(this).scrollTop();
        data.css({
            top: scroll_top
        })
        sidebar_body_col.css({
            top: scroll_top
        })
    });

    scroll_horizontal.scroll(function () {
        var scroll_left = -1 * $(this).scrollLeft();
        data.css({
            left: scroll_left
        })
        header_row.css({
            left: scroll_left
        })
    });

    body.on('mousewheel', function (event) {
        var current = scroll_vertical.scrollTop();
        scroll_vertical.scrollTop(current + -111 * event.deltaY);
    });

    var start_position_x = 0;
    var start_position_y = 0;


    body.on('touchstart', function (event) {
        var e = event.originalEvent;
        start_position_x = scroll_horizontal.scrollLeft() + e.touches[0].pageX;
        start_position_y = scroll_vertical.scrollTop() + e.touches[0].pageY;
        // e.preventDefault();
    });

    body.on('touchend', function (event) {
        var e = event.originalEvent;
        start_position_x = 0;
        start_position_y = 0;
        // e.preventDefault();
    });

    body.on('touchmove', function (event) {
        var e = event.originalEvent;
        scroll_horizontal.scrollLeft(start_position_x - e.touches[0].pageX);
        scroll_vertical.scrollTop(start_position_y - e.touches[0].pageY);
        // e.preventDefault();
    });

    sidebar_header_checkbox.prop({
        checked: false
    }).change(function () {
        sidebar_body_col.find(':checkbox').prop({
            checked: sidebar_header_checkbox.prop('checked')
        });
    });

    /**
     * Обработчик группового выделения строк
     */
    var last_sidebar_checkbox;
    var all_sidebar_checkboxes = sidebar_body_col.find(':checkbox');
    all_sidebar_checkboxes.each(function (i, o) {
        $(o).dblclick(function (event) {
            event.stopPropagation();
        });
        // click handler
        $(o).click(function (event) {
            event.stopPropagation();
            if (!last_sidebar_checkbox) {
                last_sidebar_checkbox = this;
                return;
            }
            if (last_sidebar_checkbox == this) {
                return;
            }
            if (!event.shiftKey) {
                last_sidebar_checkbox = this;
                return;
            }
            var flag = 0;
            for (var i = 0; i < all_sidebar_checkboxes.length; i++) {
                if (all_sidebar_checkboxes[i] == this || all_sidebar_checkboxes[i] == last_sidebar_checkbox) {
                    if (flag == 0) {
                        flag = 1;
                    } else if (flag == 1) {
                        all_sidebar_checkboxes[i].checked = last_sidebar_checkbox.checked;
                        break;
                    }
                }
                if (flag == 1) {
                    all_sidebar_checkboxes[i].checked = last_sidebar_checkbox.checked;
                }
            }
            last_sidebar_checkbox = this;
        });
    });

    /**
     * Retrieve checked rows
     *
     * @returns {{length: number}}
     */
    this.getCheckedRows = function () {
        var elements = {
            length: 0,
            items: []
        };
        var rows = data.children('div');
        var index, element;
        var checked = sidebar_body_col.children('div').has(':checked');
        if (checked.length) {
            for (var i = 0; i < checked.length; i++) {
                index = sidebar_body_col.children('div').index(checked[i]);
                element = rows.eq(index);
                elements.items[i] = {
                    index: index,
                    data: {
                        pk: element.data('pk')
                    }
                };
            }
            elements.length = i;
        }
        return elements;
    };

    /**
     * Retrieve currently-selected row if it only one!
     *
     * @returns {{length: number}}
     */
    this.getCurrentRow = function () {
        var elements = {
            length: 0,
            items: {}
        };
        var rows = data.children('div');
        var selected = data.children('[class$="-active"]');
        if (selected.length == 1) {
            var element = selected.eq(0);
            var index = rows.index(element);
            elements.items[0] = {
                index: index,
                data: {
                    pk: element.data('pk')
                }
            };
            elements.length = 1;
        }
        return elements;
    };

    var navigate = function () {
        var f = $('<form method="post">');
        var page_number = $('<input type="hidden" name="pageNumber">').val(page_select.val());
        var items_per_page = $('<input type="hidden" name="itemsPerPage">').val(limit_select.val());
        f.append(page_number).append(items_per_page);
        container.append(f);
        f.submit();
    };

    page_select.change(function () {
        navigate();
    });

    limit_select.change(function () {
        navigate();
    });

    if (!(prev_trigger.hasClass('disabled'))) {
        prev_trigger.click(function () {
            prev_trigger.addClass('disabled');
            page_select.val(parseInt(page_select.val(), 10) - 1);
            navigate();
        });
    }

    if (!(next_trigger.hasClass('disabled'))) {
        next_trigger.click(function () {
            next_trigger.addClass('disabled');
            page_select.val(parseInt(page_select.val(), 10) + 1);
            navigate();
        });
    }

    this.del = function () {
        AplabAdmin.collapseActionMenu();
        var items;
        items = this.getCheckedRows();
        if (!items.length) {
            items = this.getCurrentRow();
        }
        if (!items.length) {
            alert('Nothing selected');
            return;
        }
        if (!confirm('Confifm delete items: ' + items.length)) {
            return;
        }
        var post_data = {};
        for (var i = 0; i < items.length; i++) {
            var pk = items.items[i].data.pk;
            for (var p in pk) {
                if (undefined === post_data[p]) {
                    post_data[p] = [];
                }
                post_data[p].push(pk[p]);
            }
        }
        var f = $('<form method="post">');
        f.prop({
            action: (base_url + '/del').replace(/\/{2,}/, '/')
        });
        for (var p in post_data) {
            var input = $('<input type="hidden" name="' + p + '">')
                .val(JSON.stringify(post_data[p]));
            f.append(input);
        }
        container.append(f);
        f.submit();
    };

    this.duplicate = function () {
        AplabAdmin.collapseActionMenu();
        var items;
        items = this.getCheckedRows();
        if (!items.length) {
            items = this.getCurrentRow();
        }
        if (!items.length) {
            alert('Nothing selected');
            return;
        }
        if (!confirm('Confifm duplicate items: ' + items.length)) {
            return;
        }
        var post_data = {};
        for (var i = 0; i < items.length; i++) {
            var pk = items.items[i].data.pk;
            for (var p in pk) {
                if (undefined === post_data[p]) {
                    post_data[p] = [];
                }
                post_data[p].push(pk[p]);
            }
        }
        var f = $('<form method="post">');
        f.prop({
            action: (base_url + '/duplicate').replace(/\/{2,}/, '/')
        });
        for (var p in post_data) {
            var input = $('<input type="hidden" name="' + p + '">')
                .val(JSON.stringify(post_data[p]));
            f.append(input);
        }
        container.append(f);
        f.submit();
    };

    /**
     * Touch device detector
     *
     * @returns {boolean}
     */
    var isTouchDevice = function () {
        return 'ontouchstart' in document.documentElement;
    };

    data.find(':checkbox').change(function () {
        var o = $(this);
        var value = o.prop('checked') ? 1 : 0;
        var name = o.prop('name');
        var data_class = o.data('class');
        if (data_class == undefined) {
            return;
        }
        var pk = o.closest('.wExt').data('pk');
        if (pk == undefined) {
            return;
        }
        var post_data = {
            pk: pk,
            name: name,
            value: value,
            class: data_class
        };
        var url = '/admin/xhr/' + '/aplDataTable/editProperty/';
        url = url.replace(/\/{2,}/, '/');
        $.post(
            url,
            post_data,
            function (data) {
                try {
                    if ('ok' == data.status) {
                        o.prop('checked', value);
                        return;
                    }
                } catch (e) {
                    alert('error: ' + e.message);
                }
                try {
                    if ('error' == data.status) {
                        alert('error: ' + data.message);
                        return;
                    }
                } catch (e) {
                    alert('error: ' + e.message);
                }
            },
            'json'
        );
    });

    this.batchAddFilesPlugin = function () {
        var uploader = AplAdminFileUploader.getInstance();
        uploader.setTitle('Upload files');
        uploader.setUrl('/admin/xhr/uploadFile/');
        uploader.done = function () {
            uploader.purgeWindow();
            location = location;
        };
        uploader.showWindow();
    };
}
