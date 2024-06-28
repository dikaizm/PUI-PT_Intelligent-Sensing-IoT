import 'jquery'
import pdfMake from "pdfmake/build/pdfmake.js";
// import pdfFonts from "pdfmake/build/vfs_fonts.js";

import DataTable from 'datatables.net-bs5'
import 'datatables.net-buttons-bs5'
import 'datatables.net-buttons/js/buttons.html5.mjs'
import 'datatables.net-buttons/js/buttons.print.mjs'
import 'datatables.net-staterestore-bs5'
import 'datatables.net-responsive-bs5'

// pdfMake.vfs = pdfFonts.pdfMake.vfs;
pdfMake.fonts = {
    Roboto: {
        normal:
            "https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.66/fonts/Roboto/Roboto-Regular.ttf",
        bold: "https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.66/fonts/Roboto/Roboto-Medium.ttf",
        italics:
            "https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.66/fonts/Roboto/Roboto-Italic.ttf",
        bolditalics:
            "https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.66/fonts/Roboto/Roboto-MediumItalic.ttf",
    },
};

new DataTable('#dataTables', {
    responsive: false,
    dom: 'B<"row mt-2 mb-2"<"col-sm-2"l><"col-sm-6"><"col-sm-4"f>>rt<"row"<"col-sm-9"i><"col-sm-3 mb-2"p>>',
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


document.addEventListener('DOMContentLoaded', function () {
    // Load outputs data
    const outputs = window.outputs;
    const statusOutput = window.statusOutput;
    const editOutputUrls = window.editOutputUrls;

    // DataTable initialization
    var table = new DataTable('#dataTables_output', {
        responsive: false,
        dom: 'B<"row mt-2 mb-2"<"col-sm-2"l><"col-sm-6"><"col-sm-4"f>>rt<"row"<"col-sm-9"i><"col-sm-3 mb-2"p>>',
        searching: true,
        lengthMenu: [10, 25, 50, 75, 100],
        pageLength: 10,
        pagingType: 'full_numbers',
        language: {
            info: '_START_ - _END_ dari _TOTAL_ data',
        },
        order: [[0, 'asc']], // Initial sorting column (change as needed)
    });

    // Function to format row details
    function format(d, id) {
        // `d` is the original data object for the row
        const output = outputs.find(output => output.id == id);
        if (!output) return '';

        const outputDetails = output.output_details;
        if (!outputDetails) return '';

        const rows = outputDetails.map((item, index) => {
            const status = statusOutput.find(status => status.id == item.status_output_id);

            const publishDate = item.published_at ? item.published_at : '-';

            const editUrl = editOutputUrls.find(url => url.id == item.id);

            return `
                <tr>
                    <td>${index + 1}</td>
                    <td>${item.jenis_output_key}</td>
                    <td>${item.judul}</td>
                    <td>${status.name}</td>
                    <td>${publishDate}</td>
                    <td>
    ${item.tautan ?
                    `<a href="${item.tautan}" target="_blank">
            <i class="lni lni-link"></i>
        </a>` :
                    `<i class="lni lni-link"></i>`}
</td>

                    <td style="border-left: none; border-top: none; border-right: none; padding: 12px; text-align: center !important;">
                        <a type="button" href=${editUrl.route}>
                        <i class="lni lni-pencil" style="color: black;"></i>
                        </a>

                        <a type="button" data-bs-toggle="modal" data-bs-target="#modalArchive${item.id}">
                        <i class="lni lni-archive" style="color: gray;"></i>
                        </a>

                        <a type="button" data-bs-toggle="modal" data-bs-target="#modalDelete${item.id}">
                        <i class="lni lni-trash-can" style="color: red;"></i>
                        </a>

                    </td>
                </tr>
            `;
        }).join(' ');

        return `
            <table cellpadding="5" cellspacing="0" border="0"  class="table-striped table-bordered table">
                <thead>
                    <tr>
                        <td>No</td>
                        <td>Output</td>
                        <td>Judul Luaran</td>
                        <td>Status Output</td>
                        <td>Tanggal Publish / Granted</td>
                        <td>Tautan</td>
                        <td>Action</td>
                    </tr>
                </thead>
                <tbody>
                    ${rows}
                </tbody>
            </table>`;
    }


    const btnPagination = document.querySelector('.dt-paging');
    if (btnPagination) {
        btnPagination.addEventListener('click', function () {
            btnAccordionListener(table, format);
        });
    }

    // Event listener for clicking on detail buttons
    btnAccordionListener(table, format);
});


function btnAccordionListener(table, format) {
    // Event listener for clicking on detail buttons
    const btnDetails = document.querySelectorAll('[id^="btn_output_detail_"]');

    btnDetails.forEach(btn => {
        btn.addEventListener('click', function () {
            const id = btn.id.split('_')[3];

            const tr = $(this).closest('tr');
            const row = table.row(tr);

            const icon = this.querySelector('.icon-detail-caret');
            if (row.child.isShown()) {
                // This row is already open - close it
                row.child.hide();
                tr.removeClass('shown');
                icon.style.transform = 'rotate(0deg)';
            } else {
                // Open this row
                row.child(format(row.data(), id)).show();
                tr.addClass('shown');
                icon.style.transform = 'rotate(180deg)';
            }
        });
    });
}
