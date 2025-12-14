/**
 * Company: CETAM
 * Project: QParking
 * File: subscription_screen.dart
 * Created on: 04/12/2025
 * Created by: Gamaliel Alejandro Juarez Loyde
 * Approved by: Daniel Yair Mendoza
 *
 * Changelog:
 * - ID: 1 | Modified on: 13/12/2025 |
 * Modified by: Rodrigo Peña Vega |
 * Description: Updated plans to Basic and Premium with specific feature visibility. |
 */

import 'package:flutter/material.dart';
import 'package:flutter_riverpod/flutter_riverpod.dart';
import 'package:go_router/go_router.dart';
import 'package:qparking/core/constants/constants_exports.dart';
import 'package:qparking/core/theme/app_theme.dart';
import 'package:qparking/core/widgets/widgets_exports.dart';
import 'package:qparking/features/bank_card/business/payment_provider.dart';


final selectedPlanProvider = StateProvider<int>((ref) => 0);

class SubscriptionsScreen extends ConsumerStatefulWidget {
  const SubscriptionsScreen({super.key});

  @override
  ConsumerState<SubscriptionsScreen> createState() => _SubscriptionsScreenState();
}

class _SubscriptionsScreenState extends ConsumerState<SubscriptionsScreen> {

  @override
  Widget build(BuildContext context) {
    final selectedPlanIndex = ref.watch(selectedPlanProvider);

    return Scaffold(
      backgroundColor: SCAFFOLD_BACKGROUND,
      appBar: AppBar(
        backgroundColor: AppTheme.primary,
        elevation: 0,
        centerTitle: true,
        leading: IconButton(
          icon: const Icon(Icons.arrow_back, color: Colors.white),
          onPressed: () => context.pop(),
        ),
        title: const Text(
          'Planes y Suscripciones',
          style: TextStyle(
            color: Colors.white,
            fontWeight: FontWeight.w700,
            fontSize: 20,
            fontFamily: 'Noto Sans',
          ),
        ),
      ),
      body: SafeArea(
        child: SingleChildScrollView(
          padding: const EdgeInsets.symmetric(horizontal: 24.0, vertical: 32.0),
          child: Column(
            crossAxisAlignment: CrossAxisAlignment.center,
            children: [
              const SizedBox(height: 32),
              // --- Plan Cards ---

              _buildPlanCard(
                context: context,
                index: 0,
                currentSelectedIndex: selectedPlanIndex,
                title: 'Básico',
                price: 'Gratis',
                features: ['Acceso estándar', 'Historial de 7 días', 'Soporte básico'],
                onTap: () {
                  // Direct update for free plan
                  _updateSelectedPlan(0);
                },
              ),
              const SizedBox(height: 24),

              _buildPlanCard(
                context: context,
                index: 1,
                currentSelectedIndex: selectedPlanIndex,
                title: 'Premium Mensual',
                price: '\$99.00 / mes',
                features: [
                  'Acceso prioritario',
                  'Historial ilimitado',
                  'Facturación automática',
                  'Sin anuncios'
                ],
                onTap: () {
                  // Show payment confirmation before updating
                  _showPaymentConfirmation(1, 'Premium Mensual', '\$99.00');
                },
              ),
              const SizedBox(height: 24),

              _buildPlanCard(
                context: context,
                index: 2,
                currentSelectedIndex: selectedPlanIndex,
                title: 'Anual Pro',
                price: '\$990.00 / año',
                features: [
                  'Todo lo de Premium',
                  '2 meses gratis',
                  'Soporte VIP 24/7',
                  'Reportes de gastos'
                ],
                onTap: () {
                  _showPaymentConfirmation(2, 'Anual Pro', '\$990.00');
                },
              ),

              const SizedBox(height: 32),
            ],
          ),
        ),
      ),
    );
  }

  /// Displays a dialog to confirm payment method or change it
  void _showPaymentConfirmation(int index, String planName, String price) {
    final paymentState = ref.read(paymentModelProvider);
    final activeCard = paymentState.activeCard;
    final bool hasCard = activeCard != null;

    final String cardText = hasCard
        ? '${activeCard['type']} terminada en ${activeCard['number'].substring(activeCard['number'].length - 4)}'
        : 'Ningún método de pago activo';

    final IconData cardIcon = hasCard
        ? Icons.credit_card
        : Icons.credit_card_off;

    final Color iconColor = hasCard
        ? (activeCard['color'] ?? PRIMARY_COLOR)
        : GRAY_400;

    showDialog(
      context: context,
      builder: (BuildContext context) {
        return AlertDialog(
          backgroundColor: WHITE_COLOR,
          shape: RoundedRectangleBorder(borderRadius: BorderRadius.circular(16)),
          contentPadding: const EdgeInsets.all(24),
          title: const Text(
            'Confirmar Suscripción',
            textAlign: TextAlign.center,
            style: TextStyle(
              fontFamily: 'Noto Sans',
              fontSize: 18,
              fontWeight: FontWeight.w700,
              color: GRAY_900,
            ),
          ),
          content: Column(
            mainAxisSize: MainAxisSize.min,
            children: [
              Container(
                padding: const EdgeInsets.all(16),
                decoration: BoxDecoration(
                  color: iconColor.withOpacity(0.1),
                  shape: BoxShape.circle,
                ),
                child: Icon(cardIcon, size: 32, color: iconColor),
              ),
              const SizedBox(height: 16),
              // Details
              Text(
                'Estás a punto de suscribirte al plan $planName por $price.',
                textAlign: TextAlign.center,
                style: const TextStyle(
                  fontFamily: 'Noto Sans',
                  fontSize: 14,
                  color: GRAY_600,
                ),
              ),
              const SizedBox(height: 12),
              // Payment Method Info (Dynamic)
              Text(
                hasCard ? 'Método de pago seleccionado:' : 'Acción requerida:',
                style: const TextStyle(fontSize: 12, color: GRAY_500),
              ),
              const SizedBox(height: 4),
              Text(
                cardText,
                textAlign: TextAlign.center,
                style: TextStyle(
                  fontFamily: 'Noto Sans',
                  fontSize: 14,
                  fontWeight: hasCard ? FontWeight.w600 : FontWeight.w500,
                  color: hasCard ? GRAY_900 : AppTheme.danger,
                ),
              ),
            ],
          ),
          actionsPadding: const EdgeInsets.fromLTRB(16, 0, 16, 24),
          actions: [
            Column(
              crossAxisAlignment: CrossAxisAlignment.stretch,
              children: [
                // Button 1: Pay (if card exists) OR Add Card (if no card)
                ElevatedButton(
                  // Disabled if no card exists, as per request.
                  onPressed: hasCard
                      ? () {
                    Navigator.pop(context);
                    _updateSelectedPlan(index);
                  }
                      : () {
                    // Navigate to add card screen when "Agregar Tarjeta" is the action
                    Navigator.pop(context);
                    context.push('/add_card');
                  },
                  style: ElevatedButton.styleFrom(
                    // If no card, change color to primary for CTA, else success for payment
                    backgroundColor: hasCard ? SUCCESS_COLOR : PRIMARY_COLOR,
                    foregroundColor: WHITE_COLOR,
                    // If no card, the button is not disabled, it's a primary CTA to add a card.
                    shape: RoundedRectangleBorder(
                      borderRadius: BorderRadius.circular(8),
                    ),
                    padding: const EdgeInsets.symmetric(vertical: 12),
                  ),
                  child: Text(
                    // If card exists, show "Pagar...". If not, show "Agregar Tarjeta".
                    hasCard ? 'Pagar con esta tarjeta' : 'Agregar Tarjeta',
                    style: const TextStyle(
                      fontFamily: 'Noto Sans',
                      fontWeight: FontWeight.bold,
                    ),
                  ),
                ),
                const SizedBox(height: 12),

                // Button 2: Change Method (if card exists) OR HIDE (if no card)
                if (hasCard)
                  OutlinedButton(
                    onPressed: () {
                      Navigator.pop(context);
                      context.push('/bank_card');
                    },
                    style: OutlinedButton.styleFrom(
                      side: const BorderSide(color: PRIMARY_COLOR),
                      foregroundColor: PRIMARY_COLOR,
                      shape: RoundedRectangleBorder(
                        borderRadius: BorderRadius.circular(8),
                      ),
                      padding: const EdgeInsets.symmetric(vertical: 12),
                    ),
                    child: const Text(
                      'Cambiar método de pago',
                      style: TextStyle(
                        fontFamily: 'Noto Sans',
                        fontWeight: FontWeight.bold,
                      ),
                    ),
                  )
                else
                // If there is no card, the primary button already shows "Agregar Tarjeta"
                // and the request implies a single action. We remove the secondary button.
                  const SizedBox.shrink(),
              ],
            ),
          ],
        );
      },
    );
  }

  /// Updates the global state to reflect the new active plan
  void _updateSelectedPlan(int index) {
    // Update the provider state
    ref.read(selectedPlanProvider.notifier).state = index;

    ScaffoldMessenger.of(context).showSnackBar(
      const SnackBar(
        content: Text(
          'Plan actualizado correctamente',
          style: TextStyle(fontFamily: 'Noto Sans'),
        ),
        backgroundColor: SUCCESS_COLOR,
        duration: Duration(seconds: 2),
      ),
    );
  }

  /// Helper method to build a consistent Plan Card
  Widget _buildPlanCard({
    required BuildContext context,
    required int index,
    required int currentSelectedIndex,
    required String title,
    required String price,
    required List<String> features,
    required VoidCallback onTap,
  }) {

    final bool isCurrent = currentSelectedIndex == index;

    final Color cardBackgroundColor = isCurrent ? GRAY_50 : WHITE_COLOR;
    final Color borderColor = isCurrent ? GRAY_400 : GRAY_200;
    final double borderWidth = isCurrent ? 1.5 : 1.0;

    return Container(
      width: double.infinity,
      padding: const EdgeInsets.all(24),
      decoration: BoxDecoration(
        color: cardBackgroundColor,
        borderRadius: BorderRadius.circular(24),
        border: Border.all(color: borderColor, width: borderWidth),
        boxShadow: [
          if (!isCurrent)
            BoxShadow(
              color: GRAY_900.withOpacity(0.05),
              blurRadius: 20,
              offset: const Offset(0, 10),
            ),
        ],
      ),
      child: Column(
        crossAxisAlignment: CrossAxisAlignment.start,
        children: [
          // Title & Price
          Row(
            mainAxisAlignment: MainAxisAlignment.spaceBetween,
            children: [
              Text(
                title,
                style: TextStyle(
                  fontSize: 18,
                  fontWeight: FontWeight.w700,
                  color: isCurrent ? GRAY_600 : GRAY_900,
                  fontFamily: 'Noto Sans',
                ),
              ),
              if (isCurrent)
                Container(
                  padding: const EdgeInsets.symmetric(horizontal: 12, vertical: 4),
                  decoration: BoxDecoration(
                    color: GRAY_200,
                    borderRadius: BorderRadius.circular(20),
                  ),
                  child: const Text(
                    'Actual',
                    style: TextStyle(
                      fontSize: 12,
                      fontWeight: FontWeight.bold,
                      color: GRAY_600,
                    ),
                  ),
                ),
            ],
          ),
          const SizedBox(height: 8),
          Text(
            price,
            style: TextStyle(
              fontSize: 24,
              fontWeight: FontWeight.w800,
              color: isCurrent ? GRAY_500 : PRIMARY_COLOR,
              fontFamily: 'Noto Sans',
            ),
          ),
          const SizedBox(height: 24),
          const Divider(height: 1, color: GRAY_200),
          const SizedBox(height: 24),

          // Features List
          ...features.map((feature) => Padding(
            padding: const EdgeInsets.only(bottom: 12.0),
            child: Row(
              children: [
                const Icon(Icons.check_circle, color: SUCCESS_COLOR, size: 20),
                const SizedBox(width: 12),
                Expanded(
                  child: Text(
                    feature,
                    style: const TextStyle(
                      fontSize: 14,
                      color: GRAY_600,
                      fontFamily: 'Noto Sans',
                    ),
                  ),
                ),
              ],
            ),
          )),

          const SizedBox(height: 24),

          // Action Button
          SizedBox(
            width: double.infinity,
            height: 48,
            child: ElevatedButton(
              onPressed: isCurrent ? null : onTap,
              style: ElevatedButton.styleFrom(
                backgroundColor: isCurrent ? GRAY_300 : PRIMARY_COLOR,
                foregroundColor: WHITE_COLOR,
                elevation: 0,
                shape: RoundedRectangleBorder(
                  borderRadius: BorderRadius.circular(12),
                ),
              ),
              child: Text(
                isCurrent ? 'Plan Actual' : 'Seleccionar Plan',
                style: const TextStyle(
                  fontWeight: FontWeight.w700,
                  fontSize: 16,
                  fontFamily: 'Noto Sans',
                ),
              ),
            ),
          ),
        ],
      ),
    );
  }
}