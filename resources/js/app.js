import './bootstrap'
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
    responsive: true,
    dom: 'Bfrtip',
    layout: {
        topStart: {
            buttons: [
                {
                    extend: 'pdf',
                    text: 'PDF',
                    customize: function (doc) {
                        doc.content.splice(1, 0, {
                            margin: [0, 0, 0, 12],
                            alignment: 'center',
                        })
                    },
                },
                {},
            ],
        },
    },
})
