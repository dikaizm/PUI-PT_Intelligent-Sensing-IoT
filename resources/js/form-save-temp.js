document.addEventListener('DOMContentLoaded', function () {
    const currentEndpoint = window.location.pathname;
    const storedEndpoint = localStorage.getItem('endpoint');

    if (storedEndpoint !== currentEndpoint) {
        localStorage.clear();
        localStorage.setItem('endpoint', currentEndpoint);
    }

    function saveTempSelectDropdown(field) {
        const skemaContainer = document.getElementById(`${field}-container`);
        const skemaSelect = document.getElementById(field);

        const savedSkema = localStorage.getItem(field);
        if (savedSkema) {
            if (savedSkema === 'Lainnya') {
                // If 'Lainnya' is selected, create a new input field
                const inputField = document.createElement('input');
                inputField.setAttribute('type', 'text');
                inputField.setAttribute('name', `${field}_lainnya`);
                inputField.setAttribute('id', `${field}_lainnya`);
                inputField.setAttribute('required', true);
                inputField.classList.add('input-other-pos', 'rounded-right');
                // inputField.setAttribute('placeholder', placeholderOther);

                const inputVal = localStorage.getItem(`${field}_lainnya`);
                if (inputVal) {
                    inputField.value = inputVal;
                }

                // Append the new input field to the select container
                skemaContainer.appendChild(inputField);

                // Adjust styles and classes for 'Lainnya' selection
                skemaContainer.classList.remove('select-default-pos');
                skemaContainer.classList.add('select-other-pos');

                skemaSelect.style.width = '124px'; // Adjust select field width
            }
            skemaSelect.value = savedSkema;
        }

        skemaSelect.addEventListener('change', function () {
            const skemaVal = skemaSelect.value;
            localStorage.setItem(field, skemaVal);
        });

        const skemaVal = skemaSelect.value;
        if (skemaVal === 'Lainnya') {
            const input = document.getElementById(`${field}_lainnya`);

            input.addEventListener('input', function () {
                const inputVal = input.value;
                localStorage.setItem(`${field}_lainnya`, inputVal);
            })
        }
    };

    saveTempSelectDropdown('skema');
    saveTempSelectDropdown('jenisPenelitian');
});
