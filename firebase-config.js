// firebase-config.js
import { initializeApp } from "https://www.gstatic.com/firebasejs/9.6.1/firebase-app.js";

const firebaseConfig = {
  apiKey: "AIzaSyBgU2y-cl3n2HSl70jE4yhjQtFwGwC3cjw",
  authDomain: "work-mods.firebaseapp.com",
  projectId: "work-mods",
  storageBucket: "work-mods.firebasestorage.app",
  messagingSenderId: "215308060127",
  appId: "1:215308060127:web:2ba923815e199ad817306a"
};

// AQUI ESTÁ A CORREÇÃO: Usamos 'export const' para que o login.html possa usar o objeto 'app'
export const app = initializeApp(firebaseConfig);
