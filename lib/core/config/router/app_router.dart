/**
 * Company: CETAM
 * Project: QParking
 * File: app_router.dart
 * Created on: 15/11/2025
 * Created by: Daniel Yair Mendoza Alvarez
 * Approved by: Gamaliel Alejandro Juarez Loyde
 *
 * Changelog:
 * - ID: 1 | Modified on: 27/11/2025 |
 * Modified by: Gamaliel Alejandro Juarez Loyde |
 * Description: Configuration of application routes |
 * - ID: 2 | Modified on: 04/12/2025 |
 * Modified by: Gamaliel Alejandro Juarez Loyde |
 * Description: Added subscription route and Payment Methods route |
 * - ID: 3 | Modified on: 12/12/2025 |
 * Modified by: Rodrigo Peña Vega |
 * Description: Removed '/add_credit' route definition. |
 * - ID: 4 | Modified on: 13/12/2025 |
 * Modified by: Rodrigo Peña Vega |
 * Description: Implemented redirection logic for mandatory subscriptions.
 * - ID: 5 | Modified on: 13/12/2025 |
 * Modified by: Rodrigo Peña Vega |
 * Description: Standardized imports and English comments.
 * - ID: 6 | Modified on: 14/12/2025 |
 * Modified by: Gamaliel Alejandro Juarez Loyde |
 * Description: Removed mandatory subscription redirection to allow direct access to Home. |
 */
library;

import 'package:go_router/go_router.dart';
import 'package:flutter_riverpod/flutter_riverpod.dart';

// --- Core & Auth Imports ---
import '../../../features/auth/auth_exports.dart';
import '../../../features/auth/business/auth_status_provider.dart'; // NEW: Auth status providers

// --- Feature Exports (Barrel Files) ---
import '../../../features/home/home_exports.dart';
import '../../../features/qr_generator/qr_generator_exports.dart';
import '../../../features/activity/activity_exports.dart';
import '../../../features/bank_card/bank_card_exports.dart';
import '../../../features/bank_card/presentation/screens/add_bank_card_screen.dart';
import '../../../features/map/presentation/screens/parking_map_screen.dart';
import '../../../features/profile/profile_exports.dart';
import '../../../features/special_user_request/special_user_request_exports.dart';
import '../../../features/subscriptions/subscriptions_exports.dart';


// Global Router Provider
final appRouterProvider = Provider<GoRouter>((ref) {

  // Watch necessary authentication state providers
  final isLoggedIn = ref.watch(isLoggedInProvider);
  final needsSubscription = ref.watch(needsSubscriptionSetupProvider);

  return GoRouter(
    initialLocation: '/home',

    // --- REDIRECT LOGIC ---
    redirect: (context, state) {
      final loggingIn = state.uri.toString() == '/login';
      final creatingAccount = state.uri.toString() == '/register';
      final goingToSubscriptions = state.uri.toString() == '/subscriptions';

      // 1. Not logged in: Always go to login, unless creating account.
      if (!isLoggedIn) {
        return loggingIn || creatingAccount ? null : '/login';
      }

      // 2. Logged in, but MANDATORY SUBSCRIPTION PENDING
      if (isLoggedIn && needsSubscription) {
        // If they try to go anywhere other than /subscriptions, send them there.
        return goingToSubscriptions ? null : '/subscriptions';
      }

      // 3. Logged in and MANDATORY STEP COMPLETE
      // If they try to go to /login or /register, send them to /home
      if (loggingIn || creatingAccount) {
        return '/home';
      }

      // No redirection needed
      return null;
    },

    routes: [
      // --- Authentication Routes ---
      GoRoute(
        path: '/login',
        builder: (context, state) => const LoginScreen(),
      ),
      GoRoute(
        path: '/register',
        builder: (context, state) => const RegisterScreen(),
      ),

      // --- Main Application Routes ---
      GoRoute(
        path: '/home',
        builder: (context, state) => const HomeScreen(),
      ),

      // --- Feature Routes ---
      GoRoute(
        path: '/qr_generator',
        builder: (context, state) => const QrGeneratorScreen(),
      ),
      GoRoute(
        path: '/activity',
        builder: (context, state) => const ActivityScreen(),
      ),
      GoRoute(
        path: '/profile',
        builder: (context, state) => const ProfileScreen(),
      ),

      // --- Map Route ---
      GoRoute(
        path: '/map',
        builder: (context, state) => const ParkingMapScreen(),
      ),

      // --- Special User Request Routes ---
      GoRoute(
        path: '/show_requests',
        builder: (context, state) => const ShowSpecialUserRequests(),
      ),
      GoRoute(
        path: '/create_special_user_request',
        builder: (context, state) => const CreateSpecialUserRequest(),
      ),

      // --- Subscription & Payment Routes ---
      GoRoute(
        path: '/subscriptions',
        builder: (context, state) => const SubscriptionsScreen(),
      ),
      GoRoute(
        path: '/bank_card',
        builder: (context, state) => const BankCardScreen(),
      ),
      GoRoute(
        path: '/add_card',
        builder: (context, state) => const AddBankCardScreen(),
      ),
    ],
  );
});