/*-------------------------------------------------------------------- */
/* $ timeliner plugin v0.1.0
/* Author: Furqan Aziz <furqan.dvlcloud@gmail.com>
/* Licensed under the MIT license
/*-------------------------------------------------------------------- */

// TODO List:
// Need date format config for pointer
// Need date format config for item date label
// Need bootbox confirm for delete confimation
// Need bootstrap notification for any success or danger messages
// Need waypoints for long page loading
// Pass get/put/post/delete urls and plugin must do rest of work by default alongwith hooks
// Need animate.css for scrolling animation
// Tests need to be added
// minified and dist version needed to be added
// Code improvements and refactoring

;(function ( $, window, document, undefined ) {

    /**
     * Plugin name
     */
    var pluginName = 'timeliner';

    /**
     * The plugin constructor
     * @param {DOM Element} element The DOM element where plugin is applied
     * @param {Object} options Options passed to the constructor
     */
    function Timeliner(_element, _options) {
        // Contain raw items 
        this.items = [];

        // Store a reference to the source element
        this.el = _element;

        // Store a $ reference  to the source element
        this.$el = $(_element);

        // Set a random (and normally unique) id for the object
        this.instanceId = Math.round(new Date().getTime() + (Math.random() * 100));

        // Initialize the plugin instance
        this.options(_options);
        this.config.addBtnId = this.config.addBtnId || pluginName + "-add-btn-" + this.instanceId;
        this.config.addFrmId = this.config.addFrmId || pluginName + "-add-frm-" + this.instanceId;
        this.init();
    };

    /**
     * Set up your Plugin protptype with desired methods.
     * It is a good practice to implement 'init' and 'destroy' methods.
     */
    Timeliner.prototype = {
        // Set the instance options extending the plugin defaults and
        // the options passed by the user
        options: function( _options){
            this.config = $.extend({}, $.fn[pluginName].defaults, _options);
            return this;
        },
        /**
         * Initialize the plugin instance.
         * Set any other attribtes, store any other element reference, register
         * listeners, etc
         */
        init: function() {
            this.add(this.$el.find(this.config.itemSelector)).render();
            if($.type(this.config.onInit) === "function"){
                this.config.onInit.call(this, this);
            }
            return this;
        },
        add: function(_item){
            var self = this;
            if($.type(_item) === "string"){
                var el = $(_item);
                if(el instanceof $ && el.hasOwnProperty('selector')){
                    self.add(el);
                }else{
                    self.add(el.find(this.config.itemSelector));
                }
            }else if(_item instanceof $ && _item.hasOwnProperty('selector')){
                _item.each(function(_key, _value){
                    self.add($(_value));
                });
            }else if(_item instanceof $ && _item.hasOwnProperty('context')){
                self.add(fetchHtmlItem.call(this, _item, this.config));
            }else if($.type(_item) === "array"){
                $.each(_item, function(_key, _value){
                    self.add($(_value));
                });
            }else if($.type(_item) === "object"){
                pushItem.call(this, _item);
            }

            return this;
        },
        render: function(){
            var html = '',
                script = '',
                self = this;

            // Adding add new button and form
            if(self.config.addBtnTpl){
                var btn = getHtml.call(self, 'addBtnTpl');
                html += addAttr.call(self, btn, 'id', self.config.addBtnId);
            }

            // Adding add new form
            if(self.config.formTpl){
                var frm = getHtml.call(self, 'formTpl');
                frm = addAttr.call(self, frm, 'id', self.config.addFrmId);
                frm = addCss.call(self, frm, 'display', 'none');
                html += getHtml.call(self,'sectionTpl', frm);
            }

            // Sorting items in original array and Dividing into sections
            var sorted = {}
            self.items.sort(self.config.sortComparer);
            $.each(self.items, function( _index, _item ) {
                var point = self.config.pointFormater.call(self, _item);
                sorted[point] = sorted[point] || [];
                sorted[point].push(_item);
            });

            // Preparing html and attaching into html
            for(var _point in sorted){
                if(!sorted.hasOwnProperty(_point)) continue;
                var items = "";
                html += getHtml.call(self, 'pointTpl', _point);
                $.each(sorted[_point], function(_index, _item){
                    items += _item.$html;
                });
                html += getHtml.call(self,'sectionTpl', items);
            }
            
            // Add html into Spin and then render
            this.$el.empty().html(getHtml.call(self, 'spineTpl', html));

            // Adding javascript events for add form
            if(self.config.formTpl){

                // Binding add form and add button together
                if(self.config.addBtnTpl){
                    $("#" + self.config.addBtnId).click(function(){
                        $("#" + self.config.addFrmId).toggle();
                    });
                }

                // Submit button event handling
                $("#" +  self.config.addFrmId).submit(function(e){
                    e.preventDefault();
                    var item = fetchFormItem(e, this, self.config);
                    self.config.onAdd(item, function(_item){
                        self.add(_item).render();
                    });
                });

                // Cancel button event handling
                $("#" +  self.config.addFrmId).find('[type="reset"]').click(function(e){
                    e.preventDefault();
                    self.render();
                });

                // Add calender to the date field
                $("#" +  self.config.addFrmId).find('.datepicker').datepicker();
            }

            // Adding edit and delete actions
            for(var _point in sorted){
                if(!sorted.hasOwnProperty(_point)) continue;
                $.each(sorted[_point], function(_index, _item){
                    if(self.config.editBtnTpl && self.config.formTpl){
                        $("#" + _item.$edtBtnId).click(function(e){

                            // Making form for the item clicked
                            var frm = getHtml.call(self, 'formTpl');
                            frm = addAttr.call(self, frm, 'id', _item.$edtFrmId);
                            $(this).parents('li:first').replaceWith(frm);

                            // Filling form inputs data
                            frm = $("#" + _item.$edtFrmId);
                            $.each(_item, function(_key, _value){
                                if(_key[0] !== "$"){
                                    frm.find('[name="'+_key+'"]').val(_value);
                                }
                            });

                            // Submit button event handling
                            $("#" +  _item.$edtFrmId).submit(function(e){
                                e.preventDefault();
                                var item = fetchFormItem(e, this, self.config);
                                self.config.onEdit(item, function(_item){
                                    self.add(_item).render();
                                });
                            });

                            // Cancel button event handling
                            $("#" +  _item.$edtFrmId).find('[type="reset"]').click(function(e){
                                e.preventDefault();
                                self.render();
                            });

                            // Add calender to the date field
                            $("#" +  _item.$edtFrmId).find('.datepicker').datepicker();
                        });
                    }

                    if(self.config.deleteBtnTpl){
                        $("#" + _item.$delBtnId).click(function(e){
                            self.config.onDelete(_item, function(_item){
                                self.delete(_item.$pk).render();
                            });
                        });
                    }
                });
            }

            return this;
        },
        delete: function(_id){
            var index = findWhere.call(this, _id);
            if(index > -1){
                this.items.splice(index, 1);
            }
            return this;
        },
        destroy: function(){
            // Remove child nodes
            this.$el.empty();
            // Remove any attached data from your plugin
            this.$el.removeData();
        }
    };

    /* -------------------------------------------------- */
    /* Helper functions for prototype
    /* -------------------------------------------------- */
    // fetching data from rendered html item
    var fetchHtmlItem = function(_obj, _options){
        
        // initializing item and self
        var item = {}, self = this;

        // Fetching default item
        var fetchDefault = function(_obj, _selector, _options){
            var el = $(_obj).find(_selector);
            return $.trim(el.val() || el.text());
        };

        // Fetching ID function
        var fetchId = function(_obj, _options){
            var date  = fetchDefault(_obj, ".timeliner_date", _options);
            var title =  fetchDefault(_obj, ".timeliner_label", _options);

            return title.concat("-")
                        .concat(date)
                        .replace(/[^a-z0-9-]/gi, '-')
                        .replace(/-+/g, '-')
                        .replace(/^-|-$/g, '')
                        .toLowerCase();
        };

        // Fetching Class function
        var fetchClass = function(_obj, _options){
            var klass = $(_obj).attr("class").replace("timeliner_element", "");
            return $.trim(klass);
        };

        // mapping for html to object
        var mapping = {
            'id'      : fetchId,
            'class'   : fetchClass,
            'date'    : ".timeliner_date",
            'title'   : ".timeliner_label",
            'content' : ".content",
        };

        // ietrate mapping and fetch things from html
        $.each(mapping, function(_key, _value){
            if($.type(_value) === "string" ){
                item[_key] = fetchDefault(_obj, _value, self.config);
            }else if($.type(_value) === "function" ){
                item[_key] = _value(_obj, self.config);
            }
        });
        
        return item;
    }

    // fetching data from add/edit form
    var fetchFormItem = function(_event, _form, _options){
        var item = {}, self = this;
        var inputs = $(_form).find(".form-control");

        // ietrate mapping and fetch things from html
        $.each(inputs, function(_key, _value){
            var el = $(_value);
            item[el.attr('name')] = $.trim(el.val() || el.text());
        });
        return item;
    }

    var prepareForm = function(_id, _data){

    }

    // Find item if already exist
    var findWhere = function(_id){
        if(!_id) return -1;
        var self = this, index = -1;
        $.each(self.items, function(_index, _item){
            if(_item[self.config.pk] == _id){
                index = _index;
            }
        });
        return index;
    }

    // Adding a new or replacing edited data of any item
    var pushItem = function(_obj){
        if(_obj.hasOwnProperty(this.config.pk) && _obj[this.config.pk]){
            _obj.$pk = _obj[this.config.pk];
        }

        if(_obj.hasOwnProperty(this.config.dk) && _obj[this.config.dk]){
            _obj.$dk = new Date(_obj[this.config.dk]);
        }

        _obj.$edtFrmId = _obj.$pk + '-edit-frm';
        _obj.$edtBtnId = _obj.$pk + '-edit-btn';
        _obj.$delBtnId = _obj.$pk + '-delete-btn';

        var edtBtn = getHtml.call(this,'editBtnTpl');
        var delBtn = getHtml.call(this,'deleteBtnTpl');
        edtBtn = addAttr.call(this, edtBtn, 'id', _obj.$edtBtnId);
        delBtn = addAttr.call(this, delBtn, 'id', _obj.$delBtnId);

        var html = getHtml.call(this, 'itemTpl', _obj);
        html = html.replace('{{edit-button}}', edtBtn);
        html = html.replace('{{delete-button}}', delBtn);
        _obj.$html = html;


        if(_obj.$pk && _obj.$dk){
            var index = findWhere.call(this, _obj.$pk)
            if(index !== -1){
                this.items[index] = _obj;
            }else{
                this.items.unshift(_obj);
            }
        }
    }

    var elToHtml = function(_el){
        return $(_el).wrap('<p>').parent().html();
    }

    var addCss = function(_html, _attr, _val){
        return elToHtml($(_html).css(_attr, _val));
    }

    var addAttr = function(_html, _attr, _val){
        return elToHtml($(_html).attr(_attr, _val));
    }

    var getHtml = function(_tpl, _data){

        var html = this.config[_tpl];
        _data = _data || "";
        html = html || "";

        if($.type(_data) === "string"){
            html = html.replace("{{data}}", _data);
        }else if($.type(_data) === "object"){
            $.each(_data, function(_key, _value){
                if(_key[0] !== "$"){
                    html = html.replace('{{'+_key+'}}', _value);
                }
            });
        }

        return html;
    }

    // ------- TRASHED: start ------- //
    var getScript = function(_selector, _events){
        var script = '',
            self = this;
        if(this.config[_events] && $.type(this.config[_events]) === "object"){
            for(e in this.config[_events]){
                var func = function(e){ this.config[_events][e].call(this, e, this.config); }
                script += '$("#' + this.config[_selector] + '").on("' + e + '", ' + func + ')';
            }
        }
        return script;
    }

    // loading template file html via ajax
    var ajax = function(url) {
        var response, success, error;
        $.ajax({
            url: url,
            success: function (_result) {
                response = _result;
            },
            error: function(_result){
                response = _result;
            },
            async: false
        });
        return response;
    }
    // ------- TRASHED: end ------- //

    /* -------------------------------------------------- */
    /* Events and call backs
    /* -------------------------------------------------- */
    var onAdd = function(_data, _callback){
        _data['id'] = _data.title.concat("-")
                    .concat(_data.date)
                    .replace(/[^a-z0-9-]/gi, '-')
                    .replace(/-+/g, '-')
                    .replace(/^-|-$/g, '')
                    .toLowerCase();

        _callback(_data);
    }

    var onEdit = function(_data, _callback){
        _callback(_data);
    }

    var onDelete = function(_data, _callback){
        if(confirm("Are you sure to delete ?")){
            _callback(_data);
        }
    }

    /* -------------------------------------------------- */
    /* Bootstrap fetch item mapping functions
    /* -------------------------------------------------- */
    var sortComparer = function(_a, _b){
        return _b.$dk.getTime() - _a.$dk.getTime();
    };

    var dateFormater = function(){

    }

    var pointFormater = function(_obj){
        var months = ["January", "February", "March", "April", 
                    "May", "June", "July", "August", "September",
                    "October", "November", "December"];

        return months[_obj.$dk.getMonth()] + " " + _obj.$dk.getFullYear();
    };

    /* -------------------------------------------------- */
    /* Bootstrap Tpls 
    /* -------------------------------------------------- */
    var spineTpl = '<div class="timeliner"><div class="spine"></div>{{data}}</div>';
    var pointTpl = '<div class="date_separator"><span>{{data}}</span></div>';
    var sectionTpl = '<ul class="columns">{{data}}</ul>';
    var itemTpl = 
        '<li >\
            <div class="timeliner_element {{class}}">\
                <div class="timeliner_title">\
                    <span class="timeliner_label">{{title}}</span><span class="timeliner_date">{{date}}</span>\
                </div>\
                <div class="content">{{content}}</div>\
                <div class="readmore">\
                    {{delete-button}} {{edit-button}}\
                    </a>\
                </div>\
            </div>\
        </li>';
    var formTpl = 
        '<li>\
            <div class="timeliner_element" style="float: none;">\
                <form role="form" class="form-horizontal timeline_element" >\
                <input type="hidden" name="id" class="form-control" >\
                <div class="timeline_title"> &nbsp; </div>\
                <div class="content">\
                    <div class="form-group">\
                        <label class="col-sm-2 control-label" for="form-field-2"> Date </label>\
                        <div class="col-sm-9">\
                            <input type="text" placeholder="Post Date" name="date" class="form-control datepicker" required="required" data-date-format="dd M yyyy">\
                        </div>\
                    </div>\
                    <div class="form-group">\
                        <label class="col-sm-2 control-label" for="form-field-1"> Title </label>\
                        <div class="col-sm-9">\
                            <input type="text" placeholder="Title" name="title" class="form-control" required="required">\
                        </div>\
                    </div>\
                    <div class="form-group">\
                        <label class="col-sm-2 control-label" for="form-field-12"> Content </label>\
                        <div class="col-sm-9">\
                            <textarea placeholder="Description Content" name="content" class="form-control" required="required"></textarea>\
                        </div>\
                    </div>\
                    <div class="form-group">\
                        <label class="col-sm-2 control-label" for="form-field-12"> Background </label>\
                        <div class="col-sm-9">\
                            <select class="form-control" name="class" >\
                                <option value="" seleted="selected">None</option>\
                                <option value="bricky">Red</option>\
                                <option value="green">Green</option>\
                                <option value="purple">Purple</option>\
                                <option value="teal">Teal</option>\
                            </select>\
                        </div>\
                    </div>\
                </div>\
                <div class="readmore">\
                    <button class="btn" type="reset"><i class="fa fa-times"></i> Cancel</button>\
                    <button class="btn btn-success" type="submit"><i class="fa fa-save"></i> Save</button>\
                </div>\
                </form>\
            </div>\
        </li>';
    // Buttons Templates
    var addBtnTpl = 
        '<div class="date_separator">\
            <button class="btn btn-info">\
                <i class="fa fa-plus"></i> New\
            </button>\
        </div>';
    var editBtnTpl = '<button class="btn btn-success" ><i class="fa fa-pencil"></i> </button>';
    var deleteBtnTpl = '<button class="btn btn-danger" ><i class="fa fa-trash"></i> </button>';

    /* -------------------------------------------------- */
    /* Registering plugin with jquery function
    /* -------------------------------------------------- */
    $.fn[pluginName] = function(_options) {

        if (_options === undefined || typeof _options === 'object') {
            // Creates a new plugin instance, for each selected element, and
            // stores a reference withint the element's data
            var self = this[0];
            if (!$.data(self, 'plugin_' + pluginName)) {
                $.data(self, 'plugin_' + pluginName, new Timeliner(self, _options));
            }
            return $.data(self, 'plugin_' + pluginName);
        }
    };

    /* -------------------------------------------------- */
    /* Default options of timeliner
    /* -------------------------------------------------- */
    $.fn[pluginName].defaults = {
        // Primary key and dates are coming here
        pk                      : 'id',
        dk                      : 'date',
        itemSelector            : 'div.timeliner_element',
        // Add new button form and handling
        itemTpl                 : itemTpl,
        formTpl                 : formTpl,
        pointTpl                : pointTpl,
        spineTpl                : spineTpl,
        sectionTpl              : sectionTpl,
        addBtnId                : undefined,
        addBtnTpl               : addBtnTpl,
        addFrmId                : undefined,
        editBtnTpl              : editBtnTpl,
        deleteBtnTpl            : deleteBtnTpl,
        // Callbacks events for server side handling
        onAdd                   : onAdd,
        onEdit                  : onEdit,
        onDelete                : onDelete,
        // Some functions to help the customization
        sortComparer            : sortComparer,
        dateFormater            : dateFormater,
        pointFormater           : pointFormater,
    };

})( jQuery, window, document );