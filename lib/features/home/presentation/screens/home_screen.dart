/**
 * Company: CETAM
 * Project: QParking
 * File: home_screen.dart
 * Created on: 15/11/2025
 * Created by: Daniel Yair Mendoza Alvarez
 * Approved by: Daniel Yair Mendoza Alvarez
 *
 * Changelog:
 * - ID: 1 | Modified on: 25/11/2025 |
 * Modified by: Gamaliel Alejandro Juarez Loyde |
 * Description: Main screen layout |
 * - ID: 2 | Modified on: 30/11/2025 |
 * Modified by: Carlos Adair Bautista Godinez |
 * Description: Standarization of icons |
 * - ID: 3 | Modified on: 13/12/2025 |
 * Modified by: Rodrigo Peña Vega |
 * Description: Enabled navigation to ProfileScreen on user initials tap in AppBar |
 */

import 'package:flutter/material.dart';
import 'package:flutter_riverpod/flutter_riverpod.dart';
import 'package:go_router/go_router.dart';
import 'package:qparking/core/theme/app_theme.dart';
import 'package:qparking/core/widgets/app_icon.dart';
import 'package:qparking/core/icons/app_icons.dart';
import 'package:qparking/core/widgets/slide_menu.dart';
import 'package:qparking/features/bank_card/business/payment_provider.dart';

const double _kStandardBorderRadius = 12.0;

class HomeScreen extends ConsumerWidget {
  const HomeScreen({super.key});

  @override
  Widget build(BuildContext context, WidgetRef ref) {
    const String userInitials = "Us";

    final paymentState = ref.watch(paymentModelProvider);
    final activeCard = paymentState.activeCard;

    return Scaffold(
      backgroundColor: AppTheme.gray50,
      appBar: AppBar(
        backgroundColor: AppTheme.primary,
        elevation: 0,
        centerTitle: true,
        iconTheme: const IconThemeData(color: AppTheme.white),
        title: const Text(
          'Inicio',
          style: TextStyle(
            fontSize: 20,
            fontWeight: FontWeight.w700,
            color: AppTheme.white,
          ),
        ),
        actions: [
          IconButton(
            onPressed: () {},
            icon: const AppIcon(
              name: AppIconName.bell,
              color: AppTheme.white,
              size: 22,
            ),
          ),
          Padding(
            padding: const EdgeInsets.only(right: 16.0, left: 4.0),
            child: InkWell(
              onTap: () => context.push('/profile'),
              borderRadius: BorderRadius.circular(18),
              child: CircleAvatar(
                radius: 18,
                backgroundColor: AppTheme.white.withOpacity(0.2),
                child: const Text(
                  userInitials,
                  style: TextStyle(
                    color: AppTheme.white,
                    fontWeight: FontWeight.bold,
                    fontSize: 14,
                  ),
                ),
              ),
            ),
          ),
        ],
      ),
      drawer: const SlideMenu(),
      body: SafeArea(
        child: SingleChildScrollView(
          padding: const EdgeInsets.symmetric(horizontal: 24, vertical: 24),
          child: Column(
            crossAxisAlignment: CrossAxisAlignment.stretch,
            children: [
              // Welcome Header
              Container(
                margin: const EdgeInsets.only(bottom: 40),
                child: RichText(
                  textAlign: TextAlign.center,
                  text: const TextSpan(
                    children: [
                      TextSpan(
                        text: '¡Bienvenido a QParking,\n',
                        style: TextStyle(
                          fontSize: 24,
                          fontWeight: FontWeight.w800,
                          color: AppTheme.primary,
                          height: 1.3,
                        ),
                      ),
                      TextSpan(
                        text: '¡Usuario QParking!',
                        style: TextStyle(
                          fontSize: 24,
                          fontWeight: FontWeight.w500,
                          color: AppTheme.primary,
                          height: 1.3,
                        ),
                      ),
                    ],
                  ),
                ),
              ),

              const Center(
                child: AppIcon(
                  name: AppIconName.qrCode,
                  size: 120,
                  color: AppTheme.primary,
                ),
              ),
              const SizedBox(height: 32),

              // Action Buttons
              SizedBox(
                height: 56,
                child: ElevatedButton.icon(
                  style: ElevatedButton.styleFrom(
                    backgroundColor: AppTheme.primary,
                    foregroundColor: AppTheme.white,
                    elevation: 0,
                    shape: RoundedRectangleBorder(
                      borderRadius: BorderRadius.circular(_kStandardBorderRadius),
                    ),
                  ),
                  onPressed: () => context.push('/qr_generator'),
                  icon: const AppIcon(
                      name: AppIconName.qrCode,
                      color: AppTheme.white,
                      size: 24
                  ),
                  label: const Text(
                    'Generar Código QR',
                    style: TextStyle(
                      fontWeight: FontWeight.w700,
                      fontSize: 16,
                    ),
                  ),
                ),
              ),
              const SizedBox(height: 48),
              // Payment Method Card
              const Text(
                'Método de pago activo',
                style: TextStyle(
                  fontSize: 14,
                  fontWeight: FontWeight.w600,
                  color: AppTheme.gray600,
                  letterSpacing: 0.5,
                ),
              ),
              const SizedBox(height: 12),

              // Lógica de UI para mostrar tarjeta
              if (activeCard == null)
                Material(
                  color: AppTheme.white,
                  borderRadius: BorderRadius.circular(_kStandardBorderRadius),
                  child: InkWell(
                    onTap: () => context.push('/bank_card'),
                    borderRadius: BorderRadius.circular(_kStandardBorderRadius),
                    child: Container(
                      padding: const EdgeInsets.symmetric(horizontal: 16, vertical: 16),
                      decoration: BoxDecoration(
                        borderRadius: BorderRadius.circular(_kStandardBorderRadius),
                        border: Border.all(color: AppTheme.gray200),
                      ),
                      child: Row(
                        children: const [
                          Icon(Icons.credit_card_off, color: AppTheme.gray400),
                          SizedBox(width: 12),
                          Text(
                            'Sin método de pago',
                            style: TextStyle(
                                color: AppTheme.gray500,
                                fontSize: 14,
                                fontWeight: FontWeight.w500
                            ),
                          ),
                          Spacer(),
                          Text(
                            'Seleccionar',
                            style: TextStyle(
                                color: AppTheme.primary,
                                fontWeight: FontWeight.bold,
                                fontSize: 14
                            ),
                          ),
                        ],
                      ),
                    ),
                  ),
                )
              else
                Material(
                  color: AppTheme.white,
                  borderRadius: BorderRadius.circular(_kStandardBorderRadius),
                  child: InkWell(
                    onTap: () => context.push('/bank_card'),
                    borderRadius: BorderRadius.circular(_kStandardBorderRadius),
                    child: Container(
                      padding: const EdgeInsets.symmetric(horizontal: 16, vertical: 16),
                      decoration: BoxDecoration(
                        borderRadius: BorderRadius.circular(_kStandardBorderRadius),
                        border: Border.all(color: AppTheme.success.withOpacity(0.3)),
                        boxShadow: [
                          BoxShadow(
                            color: AppTheme.primary.withOpacity(0.05),
                            blurRadius: 8,
                            offset: const Offset(0, 2),
                          ),
                        ],
                      ),
                      child: Row(
                        children: [
                          Icon(
                              Icons.credit_card,
                              color: activeCard['color'] ?? AppTheme.primary,
                              size: 28
                          ),
                          const SizedBox(width: 16),
                          Expanded(
                            child: Column(
                              crossAxisAlignment: CrossAxisAlignment.start,
                              children: [
                                Text(
                                  activeCard['type'] ?? 'Tarjeta',
                                  style: const TextStyle(
                                    fontSize: 16,
                                    fontWeight: FontWeight.w700,
                                    color: AppTheme.primary,
                                  ),
                                ),
                                const SizedBox(height: 2),
                                Text(
                                  activeCard['number'] ?? '****',
                                  style: const TextStyle(
                                    fontSize: 14,
                                    fontWeight: FontWeight.w400,
                                    color: AppTheme.gray600,
                                  ),
                                ),
                              ],
                            ),
                          ),
                          const AppIcon(
                              name: AppIconName.forward,
                              size: 20,
                              color: AppTheme.gray400
                          ),
                        ],
                      ),
                    ),
                  ),
                ),

              const SizedBox(height: 24),
            ],
          ),
        ),
      ),
    );
  }
}