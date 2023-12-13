document.addEventListener('DOMContentLoaded', function () {
    const problemForm = document.getElementById('problemForm');
    const nameInput = document.getElementById('name');
    const contactInput = document.getElementById('contact');

    problemForm.addEventListener('submit', function (event) {
        if (!isValidName(nameInput.value)) {
            alert('Please enter a valid name (only letters and spaces).');
            event.preventDefault();
        }

        if (!isValidContact(contactInput.value)) {
            alert('Please enter a valid email or phone number.');
            event.preventDefault(); 
        }
    });

    function isValidName(name) {
        const namePattern = /^[A-Za-z ]+$/;
        return namePattern.test(name);
    }

    function isValidContact(contact) {
        const contactPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$|^\d{10,}$/;
        return contactPattern.test(contact);
    }
});
