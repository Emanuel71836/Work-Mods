// Import the functions you need from the SDKs you need
import { initializeApp } from "firebase/app";
import { getAnalytics } from "firebase/analytics";
// TODO: Add SDKs for Firebase products that you want to use
// https://firebase.google.com/docs/web/setup#available-libraries

// Your web app's Firebase configuration
// For Firebase JS SDK v7.20.0 and later, measurementId is optional
const firebaseConfig = {
  apiKey: "AIzaSyBgU2y-cl3n2HSl70jE4yhjQtFwGwC3cjw",
  authDomain: "work-mods.firebaseapp.com",
  projectId: "work-mods",
  storageBucket: "work-mods.firebasestorage.app",
  messagingSenderId: "215308060127",
  appId: "1:215308060127:web:2ba923815e199ad817306a",
  measurementId: "G-V2ZCG3JTRK"
};

// Initialize Firebase
const app = initializeApp(firebaseConfig);
const analytics = getAnalytics(app);
