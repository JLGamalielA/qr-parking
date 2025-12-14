/**
 * Company: CETAM
 * Project: QParking
 * File: auth_status_provider.dart
 * Created on: 14/12/2025
 * Created by: Gamaliel Alejandro Juarez Loyde
 * Approved by: Daniel Yair Mendoza
 * Description: Riverpod providers for tracking user login and mandatory setup status.
 */

import 'package:flutter_riverpod/flutter_riverpod.dart';

/// State: Tracks if the user is currently authenticated.
final isLoggedInProvider = StateProvider<bool>((ref) => false);

/// State: Tracks if the user needs to complete the mandatory subscription setup.
final needsSubscriptionSetupProvider = StateProvider<bool>((ref) => true);