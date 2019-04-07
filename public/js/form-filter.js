/**
 * Created by vincent on 5/18/17.
 */
var formFilter = $('#formFilter');
var inputFilter = $('.inputFilter');
var btnFilter = $('#btnFilter');
var table = $('#table');
var selectFilter = $('.selectFilter');

function getChecked(input) {
    return input.map(function () {
        return $(this).val();
    }).get();
}

$(document).on('change', '.check_all', function () {
    if ($(this).is(":checked")) {
        $('.check_item').prop('checked', true);
    } else {
        $('.check_item').prop('checked', false);
    }
});

var formImport = $('#formImport');

(function ($) {
    $.fn.checkAll = function (item) {
        var self = this;
        $(document).on('change', this, function () {
            if (self.is(":checked")) {
                $(item).prop('checked', true);
            } else {
                $(item).prop('checked', false);
            }
        });
        return this;
    };

    function filterAjax(url, data, table) {
        $.ajax({
            url: url,
            method: 'GET',
            data: data,
            beforeSend: function () {
                //table.html('Loading ...')
            },
            success: function (data) {
                table.html(data);
            },
            error: function () {
                table.html('Error..')
            }
        })
    }

    $.fn.formFilter = function (inputFilter, selectFilter, btnFilter, table) {
        var self = this;
        if (inputFilter) {
            inputFilter.on("keydown", function (event) {
                if (event.which === 13) {
                    event.preventDefault();
                    console.log('filter begin');
                    console.log(table);
                    var data = self.serialize();
                    var url = self.attr('action');
                    filterAjax(url, data, table);
                }
            });
        }
        if (selectFilter) {
            selectFilter.change(function () {
                console.log('filter begin');
                var data = self.serialize();
                var url = self.attr('action');
                filterAjax(url, data, table);
            });
        }
        if (btnFilter) {
            btnFilter.click(function () {
                var data = self.serialize();
                var url = self.attr('action');
                filterAjax(url, data, table);
            });
        }
        return this;
    };

    $(document).on('click', '#linkPaginate li a', function (e) {
        e.preventDefault();
        var url = $(this).attr('href');
        var data = formFilter.serialize();
        filterAjax(url, data, table);
    });

    $(document).on('click', '#searchVocabularyTable li a', function (e) {
        e.preventDefault();
        var url = $(this).attr('href');
        var data = $('#formSearchVocabulary').serialize();
        filterAjax(url, data, $('#searchVocabularyTable'));
    });

    $(document).on('change', '#importFile', function () {
        var files = event.target.files;
        event.stopPropagation(); // Stop stuff happening
        event.preventDefault(); // Totally stop stuff happening
        var data = new FormData();
        $.each(files, function (key, value) {
            data.append(key, value);
        });
        var url = $(this).attr('route');
        $.ajax({
            url: url,
            type: 'POST',
            data: data,
            cache: false,
            dataType: 'json',
            processData: false, // Don't process the files
            contentType: false, // Set content type to false as jQuery will tell the server its a query string request
            success: function (data, textStatus, jqXHR) {
                alert('Import success');
            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert('ERRORS: ' + textStatus);
            }
        });
        $(this).prop('disable', true);
    });

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

//$('.check_all').checkAll('.check_item');

formFilter.formFilter(inputFilter, selectFilter, btnFilter, table);

var exportData = $('#exportData');
exportData.click(function () {
    var route = $(this).attr('route');
    var action = formFilter.attr('action');
    formFilter.attr('action', route);
    formFilter.submit();
    formFilter.attr('action', action);
});



