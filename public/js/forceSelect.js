/**
 * Created by cuongpm on 12/22/17.
 */
(function ($) {
    $.fn.magicSelect = function (config) {
        var route = config.route;
        console.log(route);
        var isSelected = config.isSelect;
        console.log(isSelected);
        var self = this;
        var url = route.val();
        console.log(url);
        self.change(function () {
            var data = {test_domain_id: self.val()};
            console.log(data);

            $.ajax({
                url: url,
                data: data,
                method: "GET",
                success: function (data) {
                    console.log(data);
                    var option = optionCate(data);
                    isSelected.html(option);
                },
                error: function (err) {
                    alert('error')
                }
            });

            function optionCate(data) {
                var option = '<option value="">Select option</option>';
                Object.keys(data).forEach(function (key) {
                    option += '<option value="' + key + '">' + data[key] + '</option>';
                });
                return option;
            }
        });
        return this;
    };
}($));

/*
var routeCategoryList = $('#routeCategoryList');
var domainSelect = $('#domain_id');
var categorySelect = $('#test_category_id');
var config = {
    route: routeCategoryList,
    isSelect: categorySelect
};
domainSelect.magicSelect(config);*/
