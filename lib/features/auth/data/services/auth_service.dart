/**
 * Company: CETAM
 * Project: QParking
 * File: auth_service.dart
 * Created on: 14/12/2025
 * Created by: Fix Bot
 * Description: Service layer to handle user authentication (login/registration) with the backend API.
 * Prepared for Laragon/API connection.
 */

class AuthService {
  // CONFIGURATION FOR LARAGON / LOCALHOST
  // static const String _baseUrl = 'http://10.0.2.2/qparking/api';

  // --- MOCK PERSISTENCE ---
  // Simulates a persistent database flag for the 'user@cetam.mx' account.
  // Once set to false, this account is recognized as having completed setup.
  static bool _userCetamNeedsSetup = true;

  /// Simulates a user login API call.
  /// Throws an exception if credentials fail or if the network request fails.
  Future<Map<String, dynamic>> login(String email, String password) async {
    // Simulate network delay
    await Future.delayed(const Duration(seconds: 2));

    // --- MOCK LOGIC (Replace with real HTTP request to Laragon API) ---
    if (email == 'user@cetam.mx' && password == '12345') {
      // 1. Check current setup status
      final bool needsSetup = _userCetamNeedsSetup;

      // 2. If it was a first time, update the mock persistence state
      if (needsSetup) {
        _userCetamNeedsSetup = false;
      }

      return {
        'token': 'mock-jwt-token',
        'user_id': '12345',
        // Returns true only on the very first attempt (Login #1)
        'is_first_login': needsSetup,
      };
    } else if (email == 'known@user.com' && password == 'password123') {
      return {
        'token': 'mock-jwt-token',
        'user_id': '67890',
        'is_first_login': false, // Simulates returning user (different account)
      };
    } else if (email == 'error@cetam.mx') {
      // Simulate API/Network Error
      throw Exception('Network connection failed.');
    } else {
      // Simulate Invalid Credentials response
      throw Exception('Credenciales inválidas. Verifica tu correo y contraseña.');
    }
  }

  /// Basic email validation utility.
  bool isValidEmail(String email) {
    return RegExp(r'^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$').hasMatch(email);
  }
}