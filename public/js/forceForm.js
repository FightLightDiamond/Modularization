/**
 * Created by cuongpm on 12/20/17.
 */
/**
 * Created by vincent on 5/18/17.
 */
function getChecked(input) {
    return input.map(function () {
        return $(this).val();
    }).get();
}

/**
 * rememberEnd
 * @type {{}}
 */

(function ($) {
    $.fn.checkAll = function (item) {
        var self = this;
        $(document).on('change', '#' + self.attr('id'), function () {
            if (self.is(":checked")) {
                $(item).each(function () {
                    $(this).prop('checked', true);
                })
            } else {
                $(item).each(function () {
                    $(this).prop('checked', false);
                })
            }
        });
        return this;
    };

    $.fn.magicFormer = function (config) {
        var inputIn = config.inputIn;
        var selectIn = config.selectIn;
        var btnIn = config.btnIn;
        var tableIn = config.tableIn;
        var remember = false;
        var review = true;
        if (config.check !== undefined) {
            remember = config.check.remember;
            var allCheck = config.check.allCheck;
            var itemCheck = config.check.itemCheck;
            review = config.check.review;
            var itemSelected = config.check.itemSelected;
            var valueSelected = config.check.valueSelected;
        }
        if (config.myItem !== undefined) {
            var tableItem = config.myItem.table;
        }
        var selfForm = this;
        var items = {};
        if (config.check !== undefined) {
            function reviewing() {
                if (review) {
                    var temp = '';
                    Object.keys(items).forEach(function (key) {
                        temp += '<tr>' +
                            '<input checked type="hidden" name="test_case_ids[]" value="' + key + '">' +
                            '<td>' + items[key] + '</td>' +
                            '<td class="text-center">' +
                            '<button value="' + key + '" type="button" class="btn btn-xs btn-danger ' + valueSelected + '">' +
                            '<i class="fa fa-remove"></i>' +
                            '</button>' +
                            '</td>' +
                            '</td>' +
                            '</tr>';
                    });
                    itemSelected.html(temp);
                }
            }

            $(document).on('click', '.' + valueSelected, function () {
                var self = $(this);
                var value = self.val();
                self.parents('tr').remove();
                delete items[value];
                backStatus(items);
            });

            function saveStatus(self) {
                if (remember) {
                    var val = self.val();
                    var check = self.is(':checked');
                    if (check) {
                        items[val] = self.attr('nick');
                    } else {
                        delete items[val];
                    }
                }
            }

            function backStatus(items) {
                if (remember) {
                    $(itemCheck).each(function () {
                        var self = $(this);
                        var val = self.val();
                        if (Object.keys(items).indexOf(val) > -1) {
                            self.prop('checked', true);
                        } else {
                            self.prop('checked', false);
                        }
                    });
                    console.log(items);
                }
            }

            function toggleCheck(self) {
                if (self.is(":checked")) {
                    $(itemCheck).prop('checked', true);
                } else {
                    $(itemCheck).prop('checked', false);
                }
            }

            $(document).on('change', itemCheck, function () {
                var self = $(this);
                saveStatus(self);
                reviewing();
                //console.log(items);
            });
            $(document).on('change', allCheck, function () {
                var self = $(this);
                toggleCheck(self);
                $(itemCheck).each(function () {
                    var selfItem = $(this);
                    saveStatus(selfItem);
                });
                reviewing();
                //console.log(items);
            });
        }

        function filterAjax(url, data) {
            $.ajax({
                url: url,
                method: 'GET',
                data: data,
                beforeSend: function () {
                    //table.html('Loading ...')
                },
                success: function (data) {
                    tableIn.html(data);
                    $('[data-toggle="popover"]').popover();
                    $('.btnPopover').hover(function () {
                        $(this).popover('show');
                    });
                    backStatus(items)
                },
                error: function () {
                    tableIn.html('Error..')
                }
            })
        }

        function paginate(url, data, table) {
            $.ajax({
                url: url,
                method: 'GET',
                data: data,
                beforeSend: function () {
                    //table.html('Loading ...')
                },
                success: function (data) {
                    //console.log(data);
                    table.html(data);
                    //backStatus(items)
                },
                error: function () {
                    table.html('Error..')
                }
            })
        }

        if (inputIn) {
            inputIn.on("keydown", function (event) {
                if (event.which === 13) {
                    event.preventDefault();
                    var data = selfForm.serialize();
                    var url = selfForm.attr('action');
                    //console.log(data);
                    //console.log(url);
                    filterAjax(url, data);
                }
            });
        }
        if (selectIn) {
            selectIn.change(function () {
                var data = selfForm.serialize();
                var url = selfForm.attr('action');
                //console.log(data);
                // console.log(url);
                filterAjax(url, data);
            });
        }
        if (btnIn) {
            btnIn.click(function () {
                var data = selfForm.serialize();
                var url = selfForm.attr('action');
                filterAjax(url, data);
            });
        }
        /**
         * Paginate
         */
        $(document).on('click', '#' + tableIn.attr('id') + ' li a', function (e) {
            e.preventDefault();
            var url = $(this).attr('href');
            var data = selfForm.serialize();
            filterAjax(url, data);
        });

        $(document).on('click', '#' + tableItem.attr('id') + ' li a', function (e) {
            e.preventDefault();
            var url = $(this).attr('href');
            var data = {};
            paginate(url, data, tableItem);
        });

        return this;
    };

    var confirmSure = $('.confirmSure');
    var confirmYes = $('#confirmYes');
    var formDestroy;
    confirmSure.click(function () {
        formDestroy = $(this).parent('form');
        console.log(formDestroy);
    });
    confirmYes.click(function () {
        formDestroy.submit();
    });

}($));
/*
 var formFilter = $('#formFilter');
 var inputFilter = $('.inputFilter');
 var btnFilter = $('#btnFilter');
 var table = $('#table');
 var selectFilter = $('.selectFilter');
 var itemSelected = $('#itemSelected');
 var checkAllCheck = '.check_all';
 var checkItemCheck = '.check_item';
 var exportData = $('#exportData');

 var config = {
 inputIn: inputFilter,
 selectIn: selectFilter,
 btnIn: btnFilter,
 tableIn: table,
 check: {
 remember: false,
 allCheck: checkAllCheck,
 itemCheck: checkItemCheck,
 itemSelected: itemSelected,
 review: false
 }
 };
 formFilter.magicFormer(config);
 */



