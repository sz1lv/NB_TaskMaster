//Bejelenkezés után a profile.php által kezelt jelszó módosítás függvénybe írandó szöveget ellenőrzöm
function updatePasswordCheck() {
    var pw = document.getElementById("updatePassword").value;
    pw = pw.trim();
    document.getElementById("updatePasswordError").innerHTML = "";
    //Hossz- és karakterellenőrzés
    if (pw.length > 7 && pw.length < 26) {
          if (pw.search(/[a-z]/) < 0) {
              document.getElementById("updatePasswordError").innerHTML = "Tartalmaznia kell kisbetűt!";
          }
          if (pw.search(/[A-Z]/) < 0) {
              document.getElementById("updatePasswordError").innerHTML = "Tartalmaznia kell nagybetűt!";
          }
          if (pw.search(/[0-9]/) < 0) {
              document.getElementById("updatePasswordError").innerHTML = "Tartalmaznia kell számot!";
          }
    } else {
        document.getElementById("updatePasswordError").innerHTML = "A jelszónak 8 és 25 karakter közöttinek kell lennie!";
    }
}

//Új jelszó és új jelszó megerősítés szövege egyezik-e
//Ha nem egyezik, nem kerül felvételre az adatbázisba (profile.php)
function updatePasswordConfirmCheck() {
    if (updatePassword.value != updatePasswordConfirm.value) {
        document.getElementById("updatePasswordConfirmError").innerHTML = "A jelszavak nem egyeznek!";
    } else if (updatePassword.value == updatePasswordConfirm.value) {
        document.getElementById("updatePasswordConfirmError").innerHTML = "";
    }
}