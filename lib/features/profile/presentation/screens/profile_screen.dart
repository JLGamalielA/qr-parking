/**
 * Company: CETAM
 * Project: QParking
 * File: profile_screen.dart
 * Created on: 25/11/2025
 * Created by: Gamaliel Alejandro Juarez Loyde
 * Approved by: Daniel Yair Mendoza Alvarez
 *
 * Changelog:
 * - ID: 1 | Modified on: 30/11/2025 |
 * Modified by: Carlos Adair Bautista Godinez |
 * Description: Standarization of icons |
 * - ID: 2 | Modified on: 04/12/2025 |
 * Modified by: Gamaliel Alejandro Juarez Loyde |
 * Description: Add subscriptions |
 * - ID: 3 | Modified on: 04/12/2025 |
 * Modified by: Gamaliel Alejandro Juarez Loyde |
 * Description: Add payment methods |
 */

import 'package:flutter/material.dart';
import 'package:flutter_riverpod/flutter_riverpod.dart';
import 'package:go_router/go_router.dart';
import 'package:qparking/core/constants/constants_exports.dart';
import 'package:qparking/core/widgets/app_icon.dart';
import 'package:qparking/core/icons/app_icons.dart';
import 'package:qparking/features/bank_card/business/payment_provider.dart';
import 'package:qparking/features/subscriptions/presentation/screens/subscriptions_screen.dart'; // To access selectedPlanProvider

class ProfileScreen extends ConsumerWidget {
  const ProfileScreen({super.key});

  @override
  Widget build(BuildContext context, WidgetRef ref) {
    final planIndex = ref.watch(selectedPlanProvider);
    final String currentPlanName = _getPlanName(planIndex);
    final paymentState = ref.watch(paymentModelProvider);
    final defaultCard = paymentState.activeCard;

    return Scaffold(
      backgroundColor: SCAFFOLD_BACKGROUND,
      appBar: AppBar(
        backgroundColor: PRIMARY_COLOR,
        elevation: 0,
        centerTitle: true,
        leading: IconButton(
          icon: const Icon(Icons.arrow_back, color: WHITE_COLOR),
          onPressed: () => context.pop(),
        ),
        title: const Text(
          'Mi expediente',
          style: TextStyle(
              color: WHITE_COLOR,
              fontWeight: FontWeight.w400,
              fontSize: 20,
              fontFamily: 'Noto Sans'
          ),
        ),
        actions: [
          IconButton(
            icon: const AppIcon(name: AppIconName.bell, color: WHITE_COLOR),
            onPressed: () {},
          ),
          Padding(
            padding: const EdgeInsets.only(right: 16, left: 8),
            child: CircleAvatar(
              radius: 18,
              backgroundColor: GRAY_700,
              child: const Text(
                'Us',
                style: TextStyle(
                    color: WHITE_COLOR,
                    fontSize: 12,
                    fontWeight: FontWeight.w600,
                    fontFamily: 'Noto Sans'
                ),
              ),
            ),
          ),
        ],
      ),
      body: SafeArea(
        child: SingleChildScrollView(
          padding: const EdgeInsets.all(24),
          child: Column(
            crossAxisAlignment: CrossAxisAlignment.stretch,
            children: [
              // --- User Card ---
              Container(
                padding: const EdgeInsets.all(20),
                decoration: BoxDecoration(
                  color: WHITE_COLOR,
                  borderRadius: BorderRadius.circular(16),
                  boxShadow: [
                    BoxShadow(
                        color: Colors.black.withOpacity(0.05),
                        blurRadius: 10,
                        offset: const Offset(0, 4)
                    ),
                  ],
                ),
                child: Row(
                  children: [
                    CircleAvatar(
                      radius: 30,
                      backgroundColor: GRAY_200,
                      child: const Text(
                          'Us',
                          style: TextStyle(
                              fontSize: 20,
                              fontWeight: FontWeight.w700,
                              color: PRIMARY_COLOR,
                              fontFamily: 'Noto Sans'
                          )
                      ),
                    ),
                    const SizedBox(width: 16),
                    Expanded(
                      child: Column(
                        crossAxisAlignment: CrossAxisAlignment.start,
                        children: const [
                          Text(
                              'Usuario QParking',
                              style: TextStyle(
                                  fontSize: 16,
                                  fontWeight: FontWeight.w700,
                                  color: PRIMARY_COLOR,
                                  fontFamily: 'Noto Sans'
                              )
                          ),
                          SizedBox(height: 4),
                          Text(
                              'usuario@qparking.com',
                              style: TextStyle(fontSize: 13, color: GRAY_600, fontFamily: 'Noto Sans')
                          ),
                          SizedBox(height: 4),
                          Text(
                              'Rol: Usuario',
                              style: TextStyle(
                                  fontSize: 13,
                                  color: GRAY_600,
                                  fontWeight: FontWeight.w500,
                                  fontFamily: 'Noto Sans'
                              )
                          ),
                        ],
                      ),
                    ),
                  ],
                ),
              ),
              const SizedBox(height: 24),

              // --- Section: User Data ---
              _SectionCard(
                title: 'Datos del usuario',
                child: Column(
                  children: const [
                    _ProfileInput(label: 'Nombre completo', value: 'Usuario QParking'),
                    SizedBox(height: 16),
                    _ProfileInput(label: 'Correo electrónico', value: 'usuario@qparking.com'),
                    SizedBox(height: 16),
                    _ProfileInput(label: 'Teléfono', value: '55 1234 5678'),
                    SizedBox(height: 16),
                  ],
                ),
              ),
              const SizedBox(height: 24),

              // --- Account & Subscription ---
              _SectionCard(
                title: 'Cuenta y Suscripción',
                child: Column(
                  children: [
                    Row(
                      children: [
                        const Icon(Icons.workspace_premium, color: WARNING_COLOR, size: 36),
                        const SizedBox(width: 16),
                        Expanded(
                          child: Column(
                            crossAxisAlignment: CrossAxisAlignment.start,
                            children: [
                              const Text('Plan actual', style: TextStyle(fontSize: 12, color: GRAY_500, fontFamily: 'Noto Sans')),
                              Text(
                                  currentPlanName,
                                  style: const TextStyle(
                                      fontSize: 18,
                                      fontWeight: FontWeight.w700,
                                      color: PRIMARY_COLOR,
                                      fontFamily: 'Noto Sans'
                                  )
                              ),
                            ],
                          ),
                        ),
                      ],
                    ),
                    const SizedBox(height: 24),
                    Align(
                      alignment: Alignment.centerRight,
                      child: SizedBox(
                        width: 180,
                        height: 44,
                        child: ElevatedButton.icon(
                          onPressed: () => context.push('/subscriptions'),
                          style: ElevatedButton.styleFrom(
                              backgroundColor: PRIMARY_COLOR,
                              foregroundColor: WHITE_COLOR,
                              shape: RoundedRectangleBorder(borderRadius: BorderRadius.circular(8))
                          ),
                          icon: const Icon(Icons.upgrade, size: 18, color: WHITE_COLOR),
                          label: const Text('Cambiar plan', style: TextStyle(color: WHITE_COLOR, fontFamily: 'Noto Sans')),
                        ),
                      ),
                    ),
                  ],
                ),
              ),
              const SizedBox(height: 24),

              // --- Payment Methods ---
              _SectionCard(
                title: 'Métodos de Pago',
                child: Column(
                  children: [
                    if (defaultCard != null)
                      _PaymentMethodItem(
                        brand: defaultCard['type'],
                        last4: defaultCard['number'].toString().length > 4
                            ? defaultCard['number'].substring(defaultCard['number'].length - 4)
                            : '****',
                        color: defaultCard['color'],
                        onTap: () => context.push('/bank_card'),
                      )
                    else
                      const Padding(
                        padding: EdgeInsets.only(bottom: 12),
                        child: Text("Sin tarjetas registradas.", style: TextStyle(color: GRAY_600, fontFamily: 'Noto Sans')),
                      ),

                    const SizedBox(height: 16),

                    // Button to Manage
                    SizedBox(
                      width: double.infinity,
                      height: 44,
                      child: OutlinedButton.icon(
                        onPressed: () => context.push('/bank_card'),
                        style: OutlinedButton.styleFrom(
                          foregroundColor: PRIMARY_COLOR,
                          side: const BorderSide(color: PRIMARY_COLOR),
                          shape: RoundedRectangleBorder(borderRadius: BorderRadius.circular(8)),
                        ),
                        icon: const Icon(Icons.credit_card, size: 18),
                        label: const Text('Gestionar mis tarjetas', style: TextStyle(fontFamily: 'Noto Sans', fontWeight: FontWeight.bold)),
                      ),
                    ),
                  ],
                ),
              ),

              const SizedBox(height: 40),
            ],
          ),
        ),
      ),
    );
  }

  String _getPlanName(int index) {
    switch (index) {
      case 0: return 'Básico (Gratis)';
      case 1: return 'Premium Mensual';
      case 2: return 'Anual Pro';
      default: return 'Desconocido';
    }
  }
}

// --- Custom Widgets ---

class _SectionCard extends StatelessWidget {
  final String title;
  final Widget child;
  const _SectionCard({required this.title, required this.child});
  @override
  Widget build(BuildContext context) {
    return Container(
      padding: const EdgeInsets.all(24),
      decoration: BoxDecoration(
        color: WHITE_COLOR,
        borderRadius: BorderRadius.circular(16),
        boxShadow: [BoxShadow(color: Colors.black.withOpacity(0.05), blurRadius: 10, offset: const Offset(0, 4))],
      ),
      child: Column(crossAxisAlignment: CrossAxisAlignment.start, children: [
        Text(title, style: const TextStyle(fontSize: 18, fontWeight: FontWeight.w700, color: PRIMARY_COLOR, fontFamily: 'Noto Sans')),
        const SizedBox(height: 24),
        child,
      ]),
    );
  }
}

class _ProfileInput extends StatelessWidget {
  final String label;
  final String value;
  const _ProfileInput({required this.label, required this.value});
  @override
  Widget build(BuildContext context) {
    return TextFormField(
      initialValue: value,
      readOnly: true,
      style: const TextStyle(color: GRAY_700, fontSize: 15, fontFamily: 'Noto Sans'),
      decoration: InputDecoration(
        labelText: label,
        labelStyle: const TextStyle(color: GRAY_500),
        enabledBorder: OutlineInputBorder(borderRadius: BorderRadius.circular(8), borderSide: const BorderSide(color: GRAY_300)),
        focusedBorder: OutlineInputBorder(borderRadius: BorderRadius.circular(8), borderSide: const BorderSide(color: GRAY_300)),
        filled: true,
        fillColor: WHITE_COLOR,
      ),
    );
  }
}

class _PaymentMethodItem extends StatelessWidget {
  final String brand;
  final String last4;
  final Color? color;
  final VoidCallback onTap;

  const _PaymentMethodItem({
    required this.brand,
    required this.last4,
    this.color,
    required this.onTap,
  });

  @override
  Widget build(BuildContext context) {
    return InkWell(
      onTap: onTap,
      borderRadius: BorderRadius.circular(8),
      child: Container(
        padding: const EdgeInsets.symmetric(horizontal: 16, vertical: 12),
        decoration: BoxDecoration(
          border: Border.all(color: SUCCESS_COLOR.withOpacity(0.5)),
          borderRadius: BorderRadius.circular(8),
          color: SUCCESS_COLOR.withOpacity(0.05),
        ),
        child: Row(
          children: [
            Icon(Icons.credit_card, color: color ?? PRIMARY_COLOR),
            const SizedBox(width: 12),
            Expanded(
              child: Column(
                crossAxisAlignment: CrossAxisAlignment.start,
                children: [
                  Text(brand, style: const TextStyle(fontWeight: FontWeight.bold, color: GRAY_900, fontFamily: 'Noto Sans')),
                  Text('**** $last4', style: const TextStyle(color: GRAY_600, fontSize: 12, fontFamily: 'Noto Sans')),
                ],
              ),
            ),
            const Icon(Icons.check_circle, color: SUCCESS_COLOR, size: 20),
          ],
        ),
      ),
    );
  }
}
