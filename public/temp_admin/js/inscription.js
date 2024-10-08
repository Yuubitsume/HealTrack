document.addEventListener('DOMContentLoaded', function() {
    const roleSelect = document.getElementById('role');
    const medecinFields = document.getElementById('medecin-fields');
    const patientFields = document.getElementById('patient-fields');

    roleSelect.addEventListener('change', function() {
        const selectedRole = this.value;

        // Masquer toutes les sections de champs
        medecinFields.style.display = 'none';
        patientFields.style.display = 'none';

        // Afficher la section correspondante en fonction du choix
        if (selectedRole === 'medecin') {
            medecinFields.style.display = 'block';
        } else if (selectedRole === 'patient') {
            patientFields.style.display = 'block';
        }
    });
});
