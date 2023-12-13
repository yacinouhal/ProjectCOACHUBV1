alert("Script is running!");

function validateForm2() {
    var nom = document.getElementById('nom').value;
    var adresse = document.getElementById('adresse').value;
    var idProd2 = document.getElementById('idProd2').value;

    // Validate nom and adresse (allow only letters and spaces)
    var nameRegex = /^[A-Za-z\s]+$/;
    if (!nameRegex.test(nom)) {
        alert('Enter a valid name (only letters and spaces allowed)');
        return false;
    }

    // Validate adresse (allow letters, numbers, and spaces)
    var addressRegex = /^[A-Za-z0-9\s]+$/;
    if (!addressRegex.test(adresse)) {
        alert('Enter a valid address (only letters, numbers, and spaces allowed)');
        return false;
    }

    // Validate idProd2 (allow only numbers)
    var numberRegex = /^[0-9]+$/;
    if (!numberRegex.test(idProd2)) {
        alert('Enter a valid number for Id Prod2');
        return false;
    }

    return true; // Submit the form if all validations pass
}
