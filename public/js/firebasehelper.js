//Initialize Firebase
import { initializeApp } from 'https://www.gstatic.com/firebasejs/9.14.0/firebase-app.js';
import { getStorage, ref, getDownloadURL } from 'https://www.gstatic.com/firebasejs/9.14.0/firebase-storage.js';
const firebaseConfig = {
    apiKey: "AIzaSyDrQnBzhOFfjrIqmOUabkt14wvx-LVnzug",
    authDomain: "sharity-f983e.firebaseapp.com",
    databaseURL: "https://sharity-f983e-default-rtdb.firebaseio.com",
    projectId: "sharity-f983e",
    storageBucket: "sharity-f983e.appspot.com",
    messagingSenderId: "599803730946",
    appId: "1:599803730946:web:e7ebe55992577653831b1b",
    measurementId: "G-2NTKV2NYYB"
};
const app = initializeApp(firebaseConfig);
const storage = getStorage(app);

export function setImage(itemID, imageLink) {
    getDownloadURL(ref(storage, imageLink))
        .then((url) => {
            $('#image'+itemID).attr('src', url);
        });
}
