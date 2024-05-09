import 'package:firebase_core/firebase_core.dart';
import 'package:flutter/foundation.dart';

Future initFirebase() async {
  if (kIsWeb) {
    await Firebase.initializeApp(
        options: FirebaseOptions(
            apiKey: "AIzaSyBdzqHLydsJf7AlHdqKqIR0kZTWRKMZKjA",
            authDomain: "recetario-736c3.firebaseapp.com",
            projectId: "recetario-736c3",
            storageBucket: "recetario-736c3.appspot.com",
            messagingSenderId: "968433854561",
            appId: "1:968433854561:web:1466dee82e6bab764c2220"));
  } else {
    await Firebase.initializeApp();
  }
}
