$(document).ready(function () {

    /**
     * Global object
     *
     * @constructor
     */
    window.AplabAdmin = function () {
    };

    /**
     * Returns common cookie key name
     * @returns {string}
     */
    AplabAdmin.getCookieKey = function () {
        return 'aplab-admin-data';
    };

    /**
     * Initialize
     */
    AplabAdmin.init = function () {
        $('#aplab-admin-open-sidebar').click(function () {
            AplabAdmin.openSidebar();
        });

        $('#aplab-admin-sidebar-button-close').click(function () {
            AplabAdmin.closeSidebar();
        });

        $('#aplab-admin-sidebar-button-toggle-pin').click(function () {
            AplabAdmin.togglePinSidebar();
        });
    };

    /**
     * Open sidebar
     */
    AplabAdmin.openSidebar = function () {
        $('body').addClass('aplab-admin-sidebar-open');
        AplabAdmin.setIsSidebarOpen(true);
    };

    /**
     * Close sidebar
     */
    AplabAdmin.closeSidebar = function () {
        $('body').removeClass('aplab-admin-sidebar-open');
        AplabAdmin.setIsSidebarOpen(false);
    };

    /**
     * Pin sidebar
     */
    AplabAdmin.pinSidebar = function () {
        $('body').addClass('aplab-admin-sidebar-pin');
        AplabAdmin.setIsSidebarPin(true);
    };

    /**
     * Unpin sidebar
     */
    AplabAdmin.unpinSidebar = function () {
        $('body').removeClass('aplab-admin-sidebar-pin');
        AplabAdmin.setIsSidebarPin(false);
    };

    /**
     * Toggle pin sidebar
     */
    AplabAdmin.togglePinSidebar = function () {
        if ($('body').hasClass('aplab-admin-sidebar-pin')) {
            AplabAdmin.unpinSidebar();
        } else {
            AplabAdmin.pinSidebar();
        }
    };

    /**
     * Returns cookie stored data
     *
     * @returns {*}
     */
    AplabAdmin.getCookieData = function () {
        var data = Cookies.getJSON(AplabAdmin.getCookieKey());
        var type = typeof(data);
        if ('object' !== type.toLowerCase()) {
            data = {};
            Cookies.set(AplabAdmin.getCookieKey(), data);
        }
        return data;
    };

    /**
     * Set pin sidebar state
     *
     * @param value
     */
    AplabAdmin.setIsSidebarPin = function (value) {
        var data = AplabAdmin.getCookieData();
        data.sidebar_pin = !!value;
        Cookies.set(AplabAdmin.getCookieKey(), data);
    };

    /**
     * Set pin sidebar state
     *
     * @param value
     */
    AplabAdmin.setIsSidebarOpen = function (value) {
        var data = AplabAdmin.getCookieData();
        data.sidebar_open = !!value;
        Cookies.set(AplabAdmin.getCookieKey(), data);
    };

    /**
     * Call initialization.
     */
    AplabAdmin.init(/** test 6 */);
});