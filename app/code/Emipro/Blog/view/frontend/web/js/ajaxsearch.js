/**
 * Copyright © 2016 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
/*jshint browser:true jquery:true*/
define([
    'jquery',
    'mage/template',
    'text!./templates/ajaxresult.html',
    'jquery/ui'
], function ($, mageTemplate, resultTmpl){
    "use strict";

    $.widget('mage.emiproblog', {
        options: {
            filterGroup: "[data-role='filter_group']",
            filter: "[data-role='filter']",
            filterField: "[data-role='filter-field']",
            filterValue: "[data-role='filter-value']",
            filterCondition: "[data-role='condition-type']",
            resultContainer: "[data-role='ajaxresultdata']",
            messagesSelector: '[data-placeholder="messages"]',
            url: '',
            pageSize: 10,
            currentPage: 1,
            template: resultTmpl
        },

        /**
         * Bind handlers to events
         */
        _create: function () {
            this._on({'click [data-role="search_post"]': $.proxy(this._search, this)});
        },

        /**
         * Method triggers an AJAX request to make API query
         * @private
         */
        _search: function () {
            var self = this;

            $('body').find(self.options.messagesSelector).empty();
            this.element.find(this.options.resultContainer).empty();
            var params = {
                "searchCriteria": {
                    "filter_groups": [],
                    "current_page": self.options.currentPage,
                    "page_size": self.options.pageSize
                }
            };
            $(self.options.filterGroup).each(function () {
                var filters = [];
                $(this).children(self.options.filter).each(function () {
                    filters.push({
                        field: $(this).find(self.options.filterField).val(),
                        value: $(this).find(self.options.filterValue).val(),
                        condition_type: $(this).find(self.options.filterCondition).val()
                    });
                });
                params.searchCriteria.filter_groups.push({"filters": filters});
            });
           
            $.ajax({
                url: self.options.url,
                dataType: 'json',
                data: params,
                context: $('body'),
                showLoader: true
            }).done(function (data) {
                self._drawResultTable(data);
            }).fail(function (response) {
                var msg = $("<div/>").addClass("message notice").text(response.responseJSON.message);
                this.find(self.options.messagesSelector).prepend(msg);
            });
        },

        /**
         * Display results
         * @param data
         * @private
         */
        _drawResultTable: function(data){
            var tmpl = mageTemplate(this.options.template);
            tmpl = tmpl({data: data});
            this.element.find(this.options.resultContainer).append($(tmpl));
        }
    })

    return $.mage.emiproblog;
});
