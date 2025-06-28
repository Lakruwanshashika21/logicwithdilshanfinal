// Firebase Configuration (Compat)
const firebaseConfig = {
  apiKey: "AIzaSyC4bg2EL6a-h8hNpLNN8iLyYOSnACHw2CQ",
  authDomain: "logicwithdilshan-db720.firebaseapp.com",
  projectId: "logicwithdilshan-db720",
  storageBucket: "logicwithdilshan-db720.appspot.com",
  messagingSenderId: "842089662515",
  appId: "1:842089662515:web:e3650bf5ef0ba6051afb46",
  measurementId: "G-JDXHGTERLH"
};

firebase.initializeApp(firebaseConfig);
const db = firebase.firestore();

function pss() {
  const password = document.getElementById("password").value;
  const repassword = document.getElementById("repassword").value;

  if (password !== repassword) {
    document.getElementById("out").innerHTML = "Passwords do not match!";
    return false;
  } else {
    document.getElementById("out").innerHTML = "";
    return true;
  }
}

document.addEventListener("DOMContentLoaded", function () {
  const classDiv = document.getElementById("classContainer");
  const physical = document.getElementById("physical");
  if (physical && classDiv) {
    classDiv.style.display = physical.value === "Yes" ? "block" : "none";

    physical.addEventListener("change", function () {
      classDiv.style.display = this.value === "Yes" ? "block" : "none";
    });
  }

  const form = document.getElementById("signupForm");
  if (form) {
    form.addEventListener("submit", function (e) {
      e.preventDefault();

      if (!pss()) return;

      const name = document.getElementById("name").value.trim();
      const address = document.getElementById("address").value.trim();
      const phone = document.getElementById("phone").value.trim();
      const alYear = document.getElementById("alYear").value.trim();
      const physical = document.getElementById("physical").value;
      const classIfYes = document.getElementById("classIfYes").value;

      if (!name || !address || !phone || !alYear) {
        alert("Please fill all required fields.");
        return;
      }

      db.collection("students").add({
        name,
        address,
        phone,
        alYear,
        physical,
        classIfYes: physical === "Yes" ? classIfYes : null,
        timestamp: firebase.firestore.FieldValue.serverTimestamp()
      })
      .then(() => {
        alert("Student registered successfully!");
        form.reset();
        document.getElementById("classContainer").style.display = "none";
      })
      .catch((error) => {
        console.error("Error adding document: ", error);
        alert("Failed to register. Try again.");
      });
    });
  }
});


fetch('session_data.php')
  .then(response => response.json())
  .then(data => {
    if (data.logged_in) {
      document.getElementById("loginBtn").style.display = "none";
      document.getElementById("signupBtn").style.display = "none";
      const welcome = document.getElementById("userWelcome");
      welcome.style.display = "inline-block";
      welcome.innerHTML = `👋 Hello, ${data.name} (${data.email})`;
    }
  });



