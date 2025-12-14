/**
 * Company: CETAM
 * Project: QParking
 * File: biometric_auth_service.dart
 * Created on: 14/12/2025
 * Created by: Gamaliel Alejandro Juarez Loyde
 * Approved by: Daniel Yair Mendoza Alvarez
 *
 * Changelog:
 * - ID: 1 | Modified on: 14/12/2025 |
 * Modified by: Gamaliel Alejandro Juarez Loyde |
 * Description: Implementation of biometric authentication logic using local_auth. |
 */

import 'package:flutter/services.dart';
import 'package:local_auth/local_auth.dart';
import 'package:local_auth/error_codes.dart' as auth_error;

class BiometricAuthService {
  final LocalAuthentication _auth = LocalAuthentication();

  Future<bool> get isDeviceSupported async {
    try {
      final bool canAuthenticateWithBiometrics = await _auth.canCheckBiometrics;
      final bool canAuthenticate =
          canAuthenticateWithBiometrics || await _auth.isDeviceSupported();
      return canAuthenticate;
    } on PlatformException catch (_) {
      return false;
    }
  }

  Future<bool> authenticate() async {
    try {
      return await _auth.authenticate(
        localizedReason: 'Por favor, autentícate para generar tu código QR',
        options: const AuthenticationOptions(
          stickyAuth: true,
          biometricOnly: false, // Allows PIN/Pattern backup if biometrics fail
          useErrorDialogs: true,
        ),
      );
    } on PlatformException catch (e) {
      if (e.code == auth_error.notAvailable) {
        // Biometrics not available on this device
        return false;
      } else if (e.code == auth_error.lockedOut) {
        // User is locked out due to too many failed attempts
        return false;
      }
      return false;
    }
  }
}