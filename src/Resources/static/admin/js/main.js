$(document).ready(function () {

    /**
     * Global object
     *
     * @constructor
     */
    window.CapsuleCms = function () {
    };

    /**
     * Returns common cookie key name
     * @returns {string}
     */
    CapsuleCms.getCookieKey = function () {
        return 'capsule-cms-data';
    };

    /**
     * Initialize
     */
    CapsuleCms.init = function () {
        $('#capsule-cms-open-sidebar').click(function () {
            CapsuleCms.openSidebar();
        });

        $('#capsule-cms-sidebar-button-close').click(function () {
            CapsuleCms.closeSidebar();
        });

        $('#capsule-cms-sidebar-button-toggle-pin').click(function () {
            CapsuleCms.togglePinSidebar();
        });
    };

    /**
     * Open sidebar
     */
    CapsuleCms.openSidebar = function () {
        $('body').addClass('capsule-cms-sidebar-open');
        CapsuleCms.setIsSidebarOpen(true);
    };

    /**
     * Close sidebar
     */
    CapsuleCms.closeSidebar = function () {
        $('body').removeClass('capsule-cms-sidebar-open');
        CapsuleCms.setIsSidebarOpen(false);
    };

    /**
     * Pin sidebar
     */
    CapsuleCms.pinSidebar = function () {
        $('body').addClass('capsule-cms-sidebar-pin');
        CapsuleCms.setIsSidebarPin(true);
    };

    /**
     * Unpin sidebar
     */
    CapsuleCms.unpinSidebar = function () {
        $('body').removeClass('capsule-cms-sidebar-pin');
        CapsuleCms.setIsSidebarPin(false);
    };

    /**
     * Toggle pin sidebar
     */
    CapsuleCms.togglePinSidebar = function () {
        if ($('body').hasClass('capsule-cms-sidebar-pin')) {
            CapsuleCms.unpinSidebar();
        } else {
            CapsuleCms.pinSidebar();
        }
    };

    /**
     * Returns cookie stored data
     *
     * @returns {*}
     */
    CapsuleCms.getCookieData = function () {
        var data = Cookies.getJSON(CapsuleCms.getCookieKey());
        var type = typeof(data);
        if ('object' !== type.toLowerCase()) {
            data = {};
            Cookies.set(CapsuleCms.getCookieKey(), data);
        }
        return data;
    };

    /**
     * Set pin sidebar state
     *
     * @param value
     */
    CapsuleCms.setIsSidebarPin = function (value) {
        var data = CapsuleCms.getCookieData();
        data.sidebar_pin = !!value;
        Cookies.set(CapsuleCms.getCookieKey(), data);
    };

    /**
     * Set pin sidebar state
     *
     * @param value
     */
    CapsuleCms.setIsSidebarOpen = function (value) {
        var data = CapsuleCms.getCookieData();
        data.sidebar_open = !!value;
        Cookies.set(CapsuleCms.getCookieKey(), data);
    };

    /**
     * Call initialization
     */
    CapsuleCms.init();
});