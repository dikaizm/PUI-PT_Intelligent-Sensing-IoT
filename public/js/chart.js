//Grafik donat penelitian
document.addEventListener('DOMContentLoaded', function() {
    const ctx1 = document.getElementById('donatPenelitian').getContext('2d');
    const data1 = {
        labels: ['Submitted', 'Review', 'Accepted', 'Rejected', 'On Going', 'Finished'],
        datasets: [{
            data: [15, 29, 25, 32, 12, 4],
            backgroundColor: [
                'rgba(20,92,133,255)',
                'rgba(233,115,45,255)',
                'rgba(28,106,32,255)',
                'rgba(16,159,208,255)',
                'rgba(160,43,145,255)',
                'rgba(86,162,51,255)',
            ],
            hoverOffset: 10
        }]
    };
    const config1 = {
        type: 'doughnut',
        data: data1,
        options: {
            maintainAspectRatio: false,
            responsive: true,
            plugins: {
                legend: {
                    position: 'bottom',
                }
            }
        }
    };
    new Chart(ctx1, config1);
});

//Grafik donat output
document.addEventListener('DOMContentLoaded', function() {
    const ctx2 = document.getElementById('donatOutput').getContext('2d');
    const data2 = {
        labels: ['Publikasi', 'HKI', 'Video', 'Foto Prototipe/Produk'],
        datasets: [{
            data: [12, 52, 22, 4],
            backgroundColor: [
                'rgba(20,92,133,255)',
                'rgba(233,115,45,255)',
                'rgba(28,106,32,255)',
                'rgba(16,159,208,255)'
            ],
            hoverOffset: 10
        }]
    };
    const config2 = {
        type: 'doughnut',
        data: data2,
        options: {
            maintainAspectRatio: false,
            responsive: true,
            plugins: {
                legend: {
                    position: 'bottom',
                }
            }
        }
    };
    new Chart(ctx2, config2);
});

//Diagram balok output
document.addEventListener('DOMContentLoaded', function() {
    // Horizontal Bar Chart 1
    const DATA_COUNT1 = 4;
    const NUMBER_CFG1 = {count: DATA_COUNT1, min: 0, max: 70};
    const labels1 = ['Prototype', 'Video', 'HKI', 'Publikasi'];
    const data1 = {
        labels: labels1,
        datasets: [
            {
                label: 'Target',
                data: [10, 10, 20, 50],
                borderColor: 'rgba(233,113,52,255)',
                backgroundColor: 'rgba(233,113,52,255)',
            },
            {
                label: 'Tahun 1',
                data: [30, 19, 27, 65],
                borderColor: 'rgba(21,95,131,255)',
                backgroundColor: 'rgba(21,95,131,255)',
            },
            {
                label: 'Tahun 2',
                data: [20, 13, 23, 52],
                borderColor: 'rgba(79,149,218,255)',
                backgroundColor: 'rgba(79,149,218,255)',
            }
        ]
    };
    const config1 = {
        type: 'bar',
        data: data1,
        options: {
            indexAxis: 'y',
            elements: {
                bar: {
                    borderWidth: 2,
                }
            },
            responsive: true,
            plugins: {
                legend: {
                    position: 'bottom',
                }
            }
        },
    };
    const ctx1 = document.getElementById('barchartOutput').getContext('2d');
    new Chart(ctx1, config1);
});

//Diagram balok penelitian
document.addEventListener('DOMContentLoaded', function() {
    const DATA_COUNT2 = 2;
    const NUMBER_CFG2 = {count: DATA_COUNT2, min: 0, max: 200};
    const labels2 = ['Tahun 1','Tahun 2'];
    const data2 = {
        labels: labels2,
        datasets: [
            {
                label: 'Target',
                data: [100, 100],
                borderColor: 'rgba(233,113,52,255)',
                backgroundColor: 'rgba(233,113,52,255)',
            },
            {
                label: 'Jumlah Penelitian',
                data: [180, 150],
                borderColor: 'rgba(21,95,131,255)',
                backgroundColor: 'rgba(21,95,131,255)',
            }
        ]
    };
    const config2 = {
        type: 'bar',
        data: data2,
        options: {
            indexAxis: 'y',
            elements: {
                bar: {
                    borderWidth: 2,
                }
            },
            responsive: true,
            plugins: {
                legend: {
                    position: 'bottom',
                }
            }
        },
    };
    const ctx2 = document.getElementById('barchartPublikasi').getContext('2d');
    new Chart(ctx2, config2);
});
