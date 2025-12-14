/**
 * Company: CETAM
 * Project: QParking
 * File: slide_menu.dart
 * Created on: 15/11/2025
 * Created by: Daniel Yair Mendoza Alvarez
 * Approved by: Daniel Yair Mendoza Alvarez
 *
 * Changelog:
 * - ID: 1 | Modified on: 25/11/2025 |
 * Modified by: Gamaliel Alejandro Juarez Loyde
 * Description: Implementation of Drawer/Navigation Rail |
 *- ID: 2 | Modified on: 27/11/2025 |
 * Modified by: Gamaliel Alejandro Juarez Loyde
 * Description: Replaced profile icon with profile image |
 * - ID: 3 | Modified on: 13/12/2025 |
 * Modified by: Rodrigo Peña Vega
 * Description: Restored Company Logo, increased button size, and fixed vertical spacing |
 */
library;

import 'package:flutter/material.dart';
import 'package:go_router/go_router.dart';
import 'package:flutter_riverpod/flutter_riverpod.dart'; // NEW: Import Riverpod

import '../theme/app_theme.dart';
import '../icons/app_icons.dart';
import 'app_icon.dart';
// Import Auth Status Providers
import '../../features/auth/business/auth_status_provider.dart';

// Converted to ConsumerWidget to access Riverpod ref
class SlideMenu extends ConsumerWidget {
  const SlideMenu({super.key});

  @override
  Widget build(BuildContext context, WidgetRef ref) {
    const String sistemaqp = "Sistema QParking";

    return Drawer(
      backgroundColor: AppTheme.primary,
      surfaceTintColor: AppTheme.primary,
      shape: const RoundedRectangleBorder(
        borderRadius: BorderRadius.only(
          topRight: Radius.circular(0),
          bottomRight: Radius.circular(0),
        ),
      ),
      child: SafeArea(
        child: Column(
          children: [
            // --- HEADER ---
            Container(
              padding: const EdgeInsets.fromLTRB(12, 30, 12, 10),
              child: Column(
                crossAxisAlignment: CrossAxisAlignment.start,
                children: [
                  Padding(
                    padding: const EdgeInsets.symmetric(horizontal: 12.0),
                    child: Row(
                      crossAxisAlignment: CrossAxisAlignment.center,
                      children: [
                        const CircleAvatar(
                          radius: 28,
                          backgroundColor: Colors.transparent,
                          backgroundImage: AssetImage('assets/images/logo_qparking.png'),
                        ),
                        const SizedBox(width: 16),
                        Expanded(
                          child: Column(
                            crossAxisAlignment: CrossAxisAlignment.start,
                            children: const [
                              Text(
                                sistemaqp,
                                style: TextStyle(
                                  color: AppTheme.white,
                                  fontWeight: FontWeight.bold,
                                  fontSize: 16,
                                ),
                                overflow: TextOverflow.ellipsis,
                              ),
                            ],
                          ),
                        ),
                      ],
                    ),
                  ),
                ],
              ),
            ),

            const Divider(color: AppTheme.gray600, height: 1),
            const SizedBox(height: 10),

            // Section Title
            const Padding(
              padding: EdgeInsets.symmetric(horizontal: 24, vertical: 8),
              child: Align(
                alignment: Alignment.centerLeft,
                child: Text(
                  'OPERACIÓN',
                  style: TextStyle(
                    color: AppTheme.gray500,
                    fontSize: 11,
                    fontWeight: FontWeight.w700,
                    letterSpacing: 1.0,
                  ),
                ),
              ),
            ),

            // Navigation Items
            Expanded(
              child: ListView(
                padding: const EdgeInsets.symmetric(horizontal: 12),
                children: [
                  _DrawerItem(
                    iconName: AppIconName.home,
                    label: 'Inicio',
                    isActive: true,
                    onTap: () {
                      context.pop();
                      context.go('/home');
                    },
                  ),

                  // OPCIÓN: MAPA
                  _DrawerItem(
                    iconName: AppIconName.map,
                    label: 'Estacionamientos',
                    onTap: () {
                      context.pop();
                      context.push('/map');
                    },
                  ),

                  _DrawerItem(
                    iconName: AppIconName.card,
                    label: 'Métodos de Pagos',
                    onTap: () {
                      context.pop();
                      context.push('/bank_card');
                    },
                  ),
                  _DrawerItem(
                    iconName: AppIconName.list,
                    label: 'Actividad',
                    onTap: () {
                      context.pop();
                      context.push('/activity');
                    },
                  ),
                  _DrawerItem(
                    iconName: AppIconName.userTie,
                    label: 'Solicitudes',
                    onTap: () {
                      context.pop();
                      context.push('/show_requests');
                    },
                  ),
                ],
              ),
            ),

            // Footer - Logout
            Padding(
              padding: const EdgeInsets.all(24),
              child: _DrawerItem(
                iconName: AppIconName.logout,
                label: 'Cerrar sesión',
                textColor: AppTheme.gray400,
                iconColor: AppTheme.gray400,
                onTap: () {
                  // --- LÓGICA DE CIERRE DE SESIÓN (Riverpod) ---
                  // 1. Resetear el estado de login
                  ref.read(isLoggedInProvider.notifier).state = false;

                  // 2. Opcional: Resetear el flag de suscripción obligatoria para simular
                  // que el usuario deberá elegir plan al volver a entrar.
                  ref.read(needsSubscriptionSetupProvider.notifier).state = true;

                  // 3. Navegar a la pantalla de login (GoRouter handles cleanup)
                  context.go('/login');
                },
              ),
            ),
          ],
        ),
      ),
    );
  }
}

class _DrawerItem extends StatelessWidget {
  final AppIconName? iconName;
  final String? imagePath;
  final String label;
  final VoidCallback onTap;
  final bool isActive;
  final Color? textColor;
  final Color? iconColor;

  const _DrawerItem({
    super.key,
    this.iconName,
    this.imagePath,
    required this.label,
    required this.onTap,
    this.isActive = false,
    this.textColor,
    this.iconColor,
  }) : assert(iconName != null || imagePath != null, 'Provide iconName or imagePath');

  @override
  Widget build(BuildContext context) {
    final finalIconColor = iconColor ?? (isActive ? AppTheme.white : AppTheme.gray400);
    final finalTextColor = textColor ?? (isActive ? AppTheme.white : AppTheme.gray50);

    return ListTile(
      leading: _buildLeadingIcon(finalIconColor),
      title: Text(
        label,
        style: TextStyle(
          fontSize: 15,
          fontWeight: isActive ? FontWeight.w600 : FontWeight.w400,
          color: finalTextColor,
        ),
      ),
      dense: true,
      contentPadding: const EdgeInsets.symmetric(horizontal: 12, vertical: 2),
      onTap: onTap,
      shape: RoundedRectangleBorder(borderRadius: BorderRadius.circular(8)),
      tileColor: isActive ? AppTheme.white.withOpacity(0.1) : null,
    );
  }

  Widget _buildLeadingIcon(Color color) {
    if (imagePath != null) {
      return Image.asset(imagePath!, width: 24, height: 24, fit: BoxFit.contain);
    }
    return AppIcon(
      name: iconName!,
      size: 20,
      color: color,
    );
  }
}