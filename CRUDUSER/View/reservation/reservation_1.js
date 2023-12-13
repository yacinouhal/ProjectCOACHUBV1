// reservation.js

// Function to validate reservation form
function validateReservationForm() {
  var nom = document.getElementById('nom').value;
  var prenom = document.getElementById('prenom').value;
  var date_reservation = document.getElementById('date_reservation').value;
  var email = document.getElementById('email').value;
  var tel = document.getElementById('telephone').value;

  // Simple validation example (customize as needed)
  if (nom === '' || prenom === '' || date_reservation === '' || email === '' || tel === '') {
      alert('Tous les champs doivent être remplis');
      return false;
  }

  // You can add more specific validation logic here

  return true;
}

// Add event listener to the form
document.getElementById('reservationForm').addEventListener('submit', function (event) {
  if (!validateReservationForm()) {
      event.preventDefault(); // Prevent form submission if validation fails
  }
});
