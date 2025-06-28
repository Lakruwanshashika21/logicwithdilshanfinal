// Import the functions you need from the SDKs you need
import { initializeApp } from "firebase/app";
import { getAnalytics } from "firebase/analytics";
// TODO: Add SDKs for Firebase products that you want to use
// https://firebase.google.com/docs/web/setup#available-libraries

// Your web app's Firebase configuration
// For Firebase JS SDK v7.20.0 and later, measurementId is optional
const firebaseConfig = {
  apiKey: "AIzaSyC4bg2EL6a-h8hNpLNN8iLyYOSnACHw2CQ",
  authDomain: "logicwithdilshan-db720.firebaseapp.com",
  projectId: "logicwithdilshan-db720",
  storageBucket: "logicwithdilshan-db720.firebasestorage.app",
  messagingSenderId: "842089662515",
  appId: "1:842089662515:web:e3650bf5ef0ba6051afb46",
  measurementId: "G-JDXHGTERLH"
};

// Initialize Firebase
const app = initializeApp(firebaseConfig);
const analytics = getAnalytics(app);