// Import Firebase SDKs
import { initializeApp } from "https://www.gstatic.com/firebasejs/11.3.1/firebase-app.js";
import { getAuth, createUserWithEmailAndPassword, signInWithEmailAndPassword, sendPasswordResetEmail, GoogleAuthProvider, FacebookAuthProvider, signInWithPopup } from "https://www.gstatic.com/firebasejs/11.3.1/firebase-auth.js";
import { getFirestore, setDoc, doc } from "https://www.gstatic.com/firebasejs/11.3.1/firebase-firestore.js";
import { getAnalytics } from "https://www.gstatic.com/firebasejs/11.3.1/firebase-analytics.js";

// Firebase Configuration
const firebaseConfig = {
    apiKey: "AIzaSyDyq0KVaORm3Dxg4NE5CEhj5dgwqe-PEzc",
    authDomain: "gymmembership-6d009.firebaseapp.com",
    databaseURL: "https://gymmembership-6d009-default-rtdb.firebaseio.com",
    projectId: "gymmembership-6d009",
    storageBucket: "gymmembership-6d009.firebasestorage.app",
    messagingSenderId: "498434821720",
    appId: "1:498434821720:web:f78f990535af3ebcb1842d",
    measurementId: "G-H0RZE4FVFZ"
};

// Initialize Firebase
const app = initializeApp(firebaseConfig);
const auth = getAuth(app);
const db = getFirestore(app);
const analytics = getAnalytics(app);

// SIGNUP HANDLER
document.getElementById('signup-form').addEventListener('submit', async (event) => {
    event.preventDefault();

    const name = document.getElementById('signup-name').value.trim();
    const email = document.getElementById('signup-email').value.trim();
    const password = document.getElementById('signup-password').value;
    const confirmPass = document.getElementById('confirm-password').value;

    if (!name || !email || !password || !confirmPass) {
        showError('Please fill in all fields');
        return;
    }
    if (password !== confirmPass) {
        showError('Passwords do not match');
        return;
    }
    if (password.length < 6) {
        showError('Password must be at least 6 characters');
        return;
    }

    try {
        const userCredential = await createUserWithEmailAndPassword(auth, email, password);
        await setDoc(doc(db, "users", userCredential.user.uid), { name, email });

        alert('Account created successfully! You can now log in.');
        document.getElementById('login-tab')?.click();
    } catch (error) {
        console.error("Firestore Write Error:", error);
        showError(error.message);
    }
});

// LOGIN HANDLER
document.getElementById('login-form').addEventListener('submit', async (event) => {
    event.preventDefault();

    const email = document.getElementById('login-email').value.trim();
    const password = document.getElementById('login-password').value;

    if (!email || !password) {
        showError('Please fill in all fields');
        return;
    }

    try {
        await signInWithEmailAndPassword(auth, email, password);
        alert('Login successful! Redirecting to dashboard...');
        // Redirect logic goes here (e.g., window.location.href = "dashboard.html";)
    } catch (error) {
        showError(error.message);
    }
});

// PASSWORD RESET HANDLER
document.getElementById('forgot-password').addEventListener('click', async (event) => {
    event.preventDefault();
    const email = prompt('Enter your email to reset your password:');

    if (email) {
        try {
            await sendPasswordResetEmail(auth, email);
            alert(`Password reset email sent to ${email}`);
        } catch (error) {
            showError(error.message);
        }
    }
});

// GOOGLE LOGIN
document.getElementById('google-login').addEventListener('click', async () => {
    const provider = new GoogleAuthProvider();
    try {
        await signInWithPopup(auth, provider);
        alert('Google login successful!');
    } catch (error) {
        showError(error.message);
    }
});

// FACEBOOK LOGIN
document.getElementById('facebook-login').addEventListener('click', async () => {
    const provider = new FacebookAuthProvider();
    try {
        await signInWithPopup(auth, provider);
        alert('Facebook login successful!');
    } catch (error) {
        showError(error.message);
    }
});
