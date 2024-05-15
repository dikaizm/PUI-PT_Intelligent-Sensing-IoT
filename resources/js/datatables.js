import 'jquery'
import pdfMake from 'pdfmake/build/pdfmake'
import pdfFonts from 'pdfmake/build/vfs_fonts'
import DataTable from 'datatables.net-bs5'
import 'datatables.net-buttons-bs5'
import 'datatables.net-buttons/js/buttons.html5.mjs'
import 'datatables.net-buttons/js/buttons.print.mjs'
import 'datatables.net-staterestore-bs5'
import 'datatables.net-responsive-bs5'

pdfMake.vfs = pdfFonts.pdfMake.vfs

new DataTable('#dataTables', {
    responsive: false,
    dom: 'B<"row mt-2"<"col-sm-2"l><"col-sm-6"><"col-sm-4"f>>rt<"row"<"col-sm-9"i><"col-sm-3 mb-2"p>>',
    searching: true,
    lengthMenu: [10, 25, 50, 75, 100],
    pageLength: 10,
    pagingType: 'full_numbers',
    language: {
        info: '_START_ - _END_ dari _TOTAL_ data',
    },
})
new DataTable('#dataTables2', {
    responsive: false,
    dom: 'frt<"row"<"col-sm-9"i><"col-sm-3 mb-2"p>>',
    searching: true,
    lengthMenu: [10, 25, 50, 75, 100],
    pageLength: 10,
    pagingType: 'full_numbers',
    language: {
        info: '_START_ - _END_ dari _TOTAL_ data',
    },
})

new DataTable('#selectAuthorTables', {
    processing: true,
    serverSide: true,
    ajax: {
        url: 'users/search',
        dataSrc: 'data',
    },
    columns: [
        {
            data: 'id',
            render: function (data) {
                return `<input type="checkbox" value="${data}" name="user_id[]">`
            },
            orderable: false,
            searchable: false,
        },
        { data: 'name' },
        {
            data: 'id',
            render: function (data) {
                return `<input type="checkbox" value="1" name="is_ketua[${data}]">`
            },
            orderable: false,
            searchable: false,
        },
        {
            data: 'id',
            render: function (data) {
                return `<input type="checkbox" value="1" name="is_corresponding[${data}]">`
            },
            orderable: false,
            searchable: false,
        },
    ],
    dom: 'B<"row mt-2"<"col-sm-2"l><"col-sm-6"><"col-sm-4"f>>rt<"row"<"col-sm-9"i><"col-sm-3 mb-2"p>>',
    searching: true,
    lengthMenu: [10, 25, 50, 75, 100],
    pageLength: 10,
    pagingType: 'full_numbers',
    language: {
        info: '_START_ - _END_ dari _TOTAL_ data',
    },
    initComplete: function () {
        var input = $('.dataTables_filter input').unbind()
        var self = this.api()
        var $searchButton = $('<button>')
            .text('Search')
            .click(function () {
                self.search(input.val()).draw()
            })
        $('.dataTables_filter').append($searchButton)
    },
})
