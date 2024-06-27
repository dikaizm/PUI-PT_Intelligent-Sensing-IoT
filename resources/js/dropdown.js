document.addEventListener('DOMContentLoaded', function () {
    // const urlPath = window.location.pathname;
    // if (urlPath !== '/penelitian/create' || urlPath !== '/output-detail/create') return

    // Get endpoint
    const endpoint = window.location.pathname;
    if (!endpoint.startsWith('/penelitian')) return;

    function dropdownWithOther(field, placeholderOther) {
        // Get the container for the select element
        const selectContainer = document.getElementById(`${field}-container`);
        // Add a default positioning class to the select container
        selectContainer.classList.add('select-default-pos');

        // Get the select element itself
        const selectField = document.getElementById(field);

        // Listen for changes in the select element
        selectField.addEventListener('change', function () {
            // Get the current selected value of the select element
            const selectValue = selectField.value;

            // Check if the selected value is not 'Lainnya'
            if (selectValue !== 'Lainnya') {
                // If not 'Lainnya', remove any existing input field
                const inputField = document.getElementById(`${field}_lainnya`);
                if (inputField) {
                    inputField.remove();
                }

                // Adjust styles and classes for non-'Lainnya' selection
                selectField.style.width = '100%';
                selectContainer.classList.remove('select-other-pos');
                selectContainer.classList.add('select-default-pos');

                return; // Exit the function early
            }

            // If 'Lainnya' is selected, create a new input field
            const inputField = document.createElement('input');
            inputField.setAttribute('type', 'text');
            inputField.setAttribute('name', `${field}_lainnya`);
            inputField.setAttribute('id', `${field}_lainnya`);
            inputField.setAttribute('required', true);
            inputField.classList.add('input-other-pos', 'rounded-right');
            inputField.setAttribute('placeholder', placeholderOther);

            // Append the new input field to the select container
            selectContainer.appendChild(inputField);

            // Adjust styles and classes for 'Lainnya' selection
            selectContainer.classList.remove('select-default-pos');
            selectContainer.classList.add('select-other-pos');

            selectField.style.width = '124px'; // Adjust select field width
        });
    }

    // Call the function for each dropdown field
    dropdownWithOther('skema', 'Masukkan skema lainnya');
    dropdownWithOther('jenisPenelitian', 'Masukkan jenis penelitian lainnya');
});
