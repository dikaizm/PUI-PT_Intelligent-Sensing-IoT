document.addEventListener('DOMContentLoaded', function() {

    // Cek jika halaman output-detail ada
    const btnOutputDetails = document.querySelectorAll('[id^="btn_output_detail_"]');
    if (!btnOutputDetails) return;

    const outputDetailRows = document.querySelectorAll('[id^="output_detail_rows_"]');
    if (!outputDetailRows) return;

    // btnOutputDetails.forEach(btn => {
    //     btn.addEventListener('click', function() {
    //         console.log('clicked')

    //         const penelitianId = this.getAttribute('data-penelitian-id');
    //         const outputDetailRow = document.getElementById(`output_detail_rows_${penelitianId}`);

    //         if (outputDetailRow) {
    //             outputDetailRow.classList.toggle('d-none');

    //             const icon = this.querySelector('.icon-detail-caret');
    //             if (icon) {
    //                 icon.style.transform = outputDetailRow.classList.contains('d-none') ? 'rotate(0deg)' : 'rotate(180deg)';
    //             }
    //         }
    //     });
    // })
});
