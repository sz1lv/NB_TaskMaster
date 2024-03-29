//Regisztráció - felhasználónév megfelelésének vizsgálata kliensoldalon, hibaüzenetekkel
function usernameCheck() {
    var hossz = document.getElementById("regName").value;
    hossz = hossz.trim();
    document.getElementById("usernameError").innerHTML = "";
    if (hossz.length > 7 && hossz.length < 26) {
        //Beírt név első karakterének vizsgálata
        if (isFinite(hossz[0])) {
            document.getElementById("usernameError").innerHTML = "A felhasználónév nem kezdődhez számmal!";
        }
    } else {
        document.getElementById("usernameError").innerHTML = "A felhasználónévnek 8 és 25 karakter közöttinek kell lennie!";
    }
}

//Regisztráció - jelszó megfelelésének ellenőrzése
function passwordCheck() {
    var pw = document.getElementById("regPassword").value;
    pw = pw.trim();
    document.getElementById("passwError").innerHTML = "";
    if (pw.length > 7 && pw.length < 26) {
          //Van-e benne kisbetű
          if (pw.search(/[a-z]/) < 0) {
              document.getElementById("passwError").innerHTML = "Tartalmaznia kell kisbetűt!";
          }
          //Van-e benne nagybetű
          if (pw.search(/[A-Z]/) < 0) {
              document.getElementById("passwError").innerHTML = "Tartalmaznia kell nagybetűt!";
          }
          //Van-e benne szám
          if (pw.search(/[0-9]/) < 0) {
              document.getElementById("passwError").innerHTML = "Tartalmaznia kell számot!";
          }
    } else {
        document.getElementById("passwError").innerHTML = "A jelszónak 8 és 25 karakter közöttinek kell lennie!";
    }
}

//Regisztráció - új jelszó ismetelt bekérésése utáni vizsgálat
function passwordConfirm() {
    //Id által ismertek, .value a beírt értéket jelzi
    if (regPassword.value != regPasswordConfirm.value) {
        document.getElementById("confirmError").innerHTML = "A jelszavak nem egyeznek!";
    } else if (regPassword.value == regPasswordConfirm.value) {
        document.getElementById("confirmError").innerHTML = "";
    }
}

//Regisztráció - email validálása
//Letisztítom az esetleges szóközöket, tabulátorokat
// '@' létezik-e, illetve van-e karakter utána
function emailCheck() {
    var email = document.getElementById("regEmail").value;
    email = email.trim();
    document.getElementById("emailError").innerHTML = "";
    if (email.search(/[a-z,0-9][@][a-z]/) < 0) {
        document.getElementById("emailError").innerHTML = "Nem érvényes email formátum!";
    }
}