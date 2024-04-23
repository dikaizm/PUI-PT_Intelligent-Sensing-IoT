import './bootstrap'
import pdfmake from 'pdfmake'
import DataTable from 'datatables.net-bs5'
import 'datatables.net-buttons-bs5'
import 'datatables.net-buttons/js/buttons.html5.mjs'
import 'datatables.net-buttons/js/buttons.print.mjs'
import 'datatables.net-staterestore-bs5'
import 'datatables.net-responsive-bs5'

new DataTable('#dataTables', {
    dom: 'Bfrtip',
    responsive: true,
})
