/**
 *
 * @param data
 * @param append_to
 * @constructor
 */
function AplAdminMenu(data, append_to) {
    append_to = append_to || $('body');
    var instanceName = data.id;

    /**
     * static init
     *
     * @param self o same object
     * @param c same function
     */
    (function(o, c) {
        if (undefined === c.instances) {
            c.instances = new Array();
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
    })(this, arguments.callee);



}