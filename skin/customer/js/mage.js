$.ajaxSetup({
    cache: false
});

const Base = function() {};

Base.prototype = {
    url: null,
    params: {},
    method: 'post',
    form: null,

    load: function() {
        let self = this;
        $.ajax({
            method: this.getMethod(),
            url: this.getUrl(),
            data: this.getParams(),
            contentType: false,
            cache: false,
            processData:false,
            success: function(response) {
                if (typeof response.layout !== 'undefined') {
                    changeLayout(response.layout);
                }
                if (typeof response.element !== 'undefined') {
                    self.handleHtml(response.element);
                }
                if (typeof response.scripts !== 'undefined') {
                    self.handleScripts(response.scripts);
                }
                if (typeof response.ajaxRedirect !== 'undefined') {
                    self.handleAjaxRedirect(response.ajaxRedirect);
                }
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
        if (typeof this.params === 'string') {
            this.params = this.params.concat(`&${key}=${value}`);
        } else {
            this.params[key] = value;
        }
        return this;
    },
    removeParam: function(key) {
        if (typeof this.params[key] !== 'undefined') {
            delete this.params[key];
        }
        return this;
    },

    setForm: function(formId) {
        this.form = $(formId);
        this.setUrl(this.form.attr('action'));
        this.setParams(new FormData(this.form.get(0)));
        return this;
    },

    handleHtml: function(element) {
        if (Array.isArray(element)) {
            $(element).each(function(i, e) {
                $(e.selector).html(e.html);
            });
        } else {
            $(element.selector).html(element.html);
        }
    },
    handleScripts: function(scripts) {
        $(scripts).each(function(i, scriptUrl) {
            $.getScript(scriptUrl);
        });
    },
    handleAjaxRedirect: function(ajaxRedirectUrl) {
        this.resetParams().setUrl(ajaxRedirectUrl).load();
    }
};

function changeLayout(layout) {
    if (document.layout === layout) return;
    
    if (layout === 'oneColumn') {
        $('#left').addClass('d-none').html('');
        $('#mid').removeClass('col-8 col-10').addClass('col-12');
        $('#right').addClass('d-none').html('');
    } else if (layout === 'twoColumnWithLeftSidebar') {
        $('#left').removeClass('d-none');
        $('#mid').removeClass('col-8 col-12').addClass('col-10');
        $('#right').addClass('d-none').html('');
    } else if (layout === 'threeColumn') {
        $('#left').removeClass('d-none');
        $('#mid').removeClass('col-10 col-12').addClass('col-8');
        $('#right').removeClass('d-none');
    }

    document.layout = layout;
}
