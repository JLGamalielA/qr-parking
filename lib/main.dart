/**
 * Company: CETAM
 * Project: QParking
 * File: main.dart
 * Created on: 15/11/2025
 * Created by: Daniel Yair Mendoza Alvarez
 * Approved by: Daniel Yair Mendoza Alvarez
 *
 * Changelog:
 * - ID: 1 | Modified on: 13/12/2025 |
 * Modified by: Rodrigo Peña Vega |
 * Description: Configured localization to force. |
 */



import 'package:flutter/material.dart';
import 'package:flutter/services.dart';
// Removed: import 'package:provider/provider.dart';
import 'package:flutter_riverpod/flutter_riverpod.dart'; // Using standard Riverpod import
import 'package:flutter_localizations/flutter_localizations.dart';
import 'package:qparking/core/config/router/app_router.dart';
import 'package:qparking/core/theme/app_theme.dart';
import 'package:qparking/l10n/app_localizations.dart';

void main() {
  WidgetsFlutterBinding.ensureInitialized();

  SystemChrome.setPreferredOrientations([
    DeviceOrientation.portraitUp,
  ]);

  runApp(const ProviderScope(child: QParkingApp()));
}

class QParkingApp extends ConsumerWidget {
  const QParkingApp({super.key});

  @override
  Widget build(BuildContext context, WidgetRef ref) {
    final router = ref.watch(appRouterProvider);

    return MaterialApp.router(
      title: 'QParking',
      debugShowCheckedModeBanner: false,

      // --- Theme Configuration ---
      theme: AppTheme().getTheme(),

      // --- Router Configuration ---
      routerConfig: router,

      // --- Localization Configuration ---
      localizationsDelegates: const [
        AppLocalizations.delegate,
        GlobalMaterialLocalizations.delegate,
        GlobalWidgetsLocalizations.delegate,
        GlobalCupertinoLocalizations.delegate,
      ],
      supportedLocales: const [
        Locale('es'), // Spanish (Primary)
        Locale('en'), // English
      ],
    );
  }
}