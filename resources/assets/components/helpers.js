module.exports = {
    isEmpty: function (item) {
        // null and undefined are "empty"
        if (item == null) return true;
        if (item == 'undefined') return true;

        //For Array
        // Assume if it has a length property with a non-zero value
        // that that property is correct.
        if (item.length > 0)    return false;
        if (item.length === 0)  return true;

        // If it isn't an object at this point
        // it is empty, but it can't be anything *but* empty
        // Is it empty?  Depends on your application.
        if (typeof item !== "object") return true;

        // Otherwise, does it have any properties of its own?
        // Note that this doesn't handle
        // toString and valueOf enumeration bugs in IE < 9
        for (var key in item) {
            if (hasOwnProperty.call(item, key)) return false;
        }
        return true;
    },
    getTempId: function () {
        var d = new Date();
        var n = d.getTime();
        return n;
    },
    /**
     *  an array containing one item will be returned if allowEmpty==false
     * return array
     * */
    objToArray: function (myObj, closure, allowEmpty = true) {
        var y = [];

        if (!this.isEmpty(myObj)) {
            for (var key in myObj) {
                y.push(closure(key, myObj[key]));
            }
        }

        if (y.length == 0 && !allowEmpty) {
            y.push(closure('', ''));
        }

        return y;
    },
    ifDuplicateTitles: function (list) {
        var listTitles = list.map(function (item) {
            return item.title
        });
        var uniqueTitles = listTitles.unique();
        return listTitles.length != uniqueTitles.length;
    },
    unsetValue: function (type = 'string') {
        switch (type) {
            case 'string':
                return '';
            case 'array':
                return [];
            case 'number':
                return 0;
            default:
                return '';
        }
    },
    addressObjToText: function (addressObj) {
        if (this.isEmpty(addressObj)) {
            return '未輸入地址';
        }
        return addressObj.city.title +
            addressObj.area.zip +
            addressObj.area.title +
            addressObj.street;
    },
    filePath: function (obj, defaultPath) {
        if (!obj) {
            return defaultPath;
        }

        return obj.filepath;
    },
    emptyString: '',
    emptyArray: [],
    emptyObj: {}
}


Array.prototype.unique = function () {
    var arr = [];
    for (var i = 0; i < this.length; i++) {
        if (arr.indexOf(this[i]) == (-1)) {
            arr.push(this[i]);
        }
    }
    return arr;
}


