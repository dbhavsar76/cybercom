const Base = function() {};

Base.prototype = {
    alert: function(message = null) {
        alert(message);
    },
    url: null,
    params: {},
    method: 'post',

    load: function() {
        $.ajax({
            method: this.getMethod(),
            url: this.getUrl(),
            data: this.getParams(),
            success: function(response, status) {
                $.each(response.element, function (i, element) {
                    $(element.selector).html(element.html);
                });
            },
        });
    },

    setUrl: function(url) {
        this.url = url;
        return this;
    },
    getUrl: function() {
        return this.url;
    },

    setMethod: function(method) {
        this.method = method;
        return this;
    },
    getMethod: function() {
        return this.method;
    },

    setParams: function(params) {
        this.params = params;
        return this;
    },
    resetParams: function() {
        this.params = {};
        return this;
    },
    getParams: function(key) {
        if (typeof key === 'undefined') {
            return this.params;
        }
        if (typeof this.params[key] === 'undefined') {
            return null;
        }
        return this.params[key];
    },
    addParam: function(key, value) {
        this.params[key] = value;
        return this;
    },
    removeParam: function(key) {
        if (typeof this.params[key] !== 'undefined') {
            delete this.params[key];
        }
        return this;
    }
};

let object = new Base();