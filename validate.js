function doValidate() {
    try {
        let em = document.getElementById('email').value;
        let pw = document.getElementById('pass').value;

        if (em == "" || pw == "") {
            alert("Both fields must be filled out");
            return false;
        }
        if (em.indexOf('@') == -1) {
            alert("Invalid email address");
            return false;
        }
        return true;
    } catch(e) {
        return false;
    }
}
