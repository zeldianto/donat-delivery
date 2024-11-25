const btnBack = document.getElementById("btnBack");
const showForm = document.getElementById('btnShowForm');
const formEditOutlet = document.getElementById('formEditOutlet');

btnBack.addEventListener("click", () => {
    window.location.href = "outlet.php";
});


formEditOutlet.style.display = 'none';

showForm.onclick = function () {
    formEditOutlet.style.display = formEditOutlet.style.display === 'none' ? 'block' : 'none';
};

