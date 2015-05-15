/*global Backbone */
var app = app || {};

(function () {
    'use strict';

    app.Todo = Backbone.Model.extend({
        defaults: {
            task: ''
        },
        toggleCompleted: function () {
            this.save({
                complete: !this.get('complete')
            });
        },
        sync: function (method, model, options) {
            model.attributes = _.omit(model.attributes, 'id');
            Backbone.Model.prototype.sync.call(this, method, model, options);
        },
        /*        
         * */
        url: function () {
            var path = this.id ? "/" + this.id : "";
            return "/todos" + path;
            /*return "http://nztodo.app.dev/app_dev.php/todos/" + this.id;*/
        },
        toJSON: function () {
            return {todo: this.attributes};
        }
    });
})();
