/**
 * Company: CETAM
 * Project: QParking
 * File: bank_card_screen.dart
 * Created on: 13/12/2025
 * Created by: Rodrigo Peña Vega
 * Modified by: Rodrigo Peña Vega
 * Approved by: Gamaliel Juarez Loyde
 *
 * Changelog:
 * - ID: 1 | Modified on: 13/12/2025 |
 * Modified by: Rodrigo Peña Vega |
 * Description: Added bank card screen.|
 * - ID: 2 | Modified on: 13/12/2025 |
 * Modified by: Rodrigo Peña |
 * Description: Implemented subscription activation logic on payment confirmation.
 * - ID: 3 | Modified on: 14/12/2025 |
 * Modified by: Gamaliel Alejandro Juarez Loyde |
 * Description: Modify payment methods. |
 */

import 'package:flutter/material.dart';
import 'package:flutter_riverpod/flutter_riverpod.dart';
import 'package:go_router/go_router.dart';
import 'package:qparking/core/constants/constants_exports.dart';
import 'package:qparking/core/theme/app_theme.dart';
import 'package:qparking/core/utils/app_alerts.dart';
import 'package:qparking/features/bank_card/business/payment_provider.dart';
import '../../../../core/icons/app_icons.dart';
import '../../../../core/widgets/app_icon.dart';

class BankCardScreen extends ConsumerWidget {
  const BankCardScreen({super.key});

  @override
  Widget build(BuildContext context, WidgetRef ref) {
    final paymentProvider = ref.watch(paymentModelProvider);
    final cards = paymentProvider.cards;
    final selectedCardId = paymentProvider.selectedCardId;

    return Scaffold(
      backgroundColor: SCAFFOLD_BACKGROUND,
      appBar: AppBar(
        backgroundColor: PRIMARY_COLOR,
        elevation: 0,
        centerTitle: true,
        leading: IconButton(
          icon: const Icon(Icons.arrow_back, color: AppTheme.white),
          onPressed: () => context.pop(),
        ),
        title: const Text(
          'Métodos de Pago',
          style: TextStyle(
            color: AppTheme.white,
            fontWeight: FontWeight.w700,
            fontSize: 20,
            fontFamily: 'Noto Sans',
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
      body: cards.isEmpty
          ? _buildEmptyState()
          : Column(
        children: [
          Expanded(
            child: ListView.builder(
              padding: const EdgeInsets.all(24),
              itemCount: cards.length,
              itemBuilder: (context, index) {
                final card = cards[index];
                final isSelected = card['id'] == selectedCardId;
                // Pasamos 'ref' para poder ejecutar acciones
                return _buildCardItem(context, ref, card, isSelected);
              },
            ),
          ),
        ],
      ),
      floatingActionButton: FloatingActionButton.extended(
        onPressed: () => context.push('/add_card'),
        backgroundColor: PRIMARY_COLOR,
        icon: const Icon(Icons.add_card, color: WHITE_COLOR),
        label: const Text(
          'Agregar Tarjeta',
          style: TextStyle(
            color: WHITE_COLOR,
            fontWeight: FontWeight.bold,
            fontFamily: 'Noto Sans',
          ),
        ),
      ),
    );
  }

  Widget _buildCardItem(BuildContext context, WidgetRef ref, Map<String, dynamic> card, bool isSelected) {
    return InkWell(
      onTap: () {
        if (!isSelected) {
          // Select card
          ref.read(paymentModelProvider).selectCard(card['id']);
          AppAlerts.showToast(
              context: context,
              message: 'Método de pago principal actualizado'
          );
        }
      },
      borderRadius: BorderRadius.circular(16),
      child: Container(
        margin: const EdgeInsets.only(bottom: 16),
        padding: const EdgeInsets.all(20),
        decoration: BoxDecoration(
          color: WHITE_COLOR,
          borderRadius: BorderRadius.circular(16),
          boxShadow: [
            BoxShadow(
              color: isSelected
                  ? SUCCESS_COLOR.withOpacity(0.15)
                  : GRAY_900.withOpacity(0.05),
              blurRadius: isSelected ? 12 : 10,
              offset: const Offset(0, 4),
            ),
          ],
          border: Border.all(
              color: isSelected ? SUCCESS_COLOR : GRAY_200,
              width: isSelected ? 2.0 : 1.0
          ),
        ),
        child: Column(
          crossAxisAlignment: CrossAxisAlignment.start,
          children: [
            Row(
              mainAxisAlignment: MainAxisAlignment.spaceBetween,
              children: [
                Row(
                  children: [
                    Icon(Icons.credit_card, color: card['color'], size: 28),
                    const SizedBox(width: 8),
                    Text(
                      card['type'],
                      style: const TextStyle(
                        fontWeight: FontWeight.bold,
                        fontSize: 16,
                        color: GRAY_800,
                        fontFamily: 'Noto Sans',
                      ),
                    ),
                  ],
                ),

                if (isSelected)
                  Container(
                    padding: const EdgeInsets.symmetric(horizontal: 10, vertical: 4),
                    decoration: BoxDecoration(
                      color: SUCCESS_COLOR.withOpacity(0.1),
                      borderRadius: BorderRadius.circular(20),
                      border: Border.all(color: SUCCESS_COLOR.withOpacity(0.2)),
                    ),
                    child: const Row(
                      children: [
                        Icon(Icons.check_circle, size: 14, color: SUCCESS_COLOR),
                        SizedBox(width: 6),
                        Text(
                          'Principal',
                          style: TextStyle(
                            fontSize: 12,
                            fontWeight: FontWeight.bold,
                            color: SUCCESS_COLOR,
                          ),
                        ),
                      ],
                    ),
                  )
                else
                  PopupMenuButton<String>(
                    icon: const Icon(Icons.more_vert, color: GRAY_500),
                    onSelected: (value) {
                      if (value == 'edit') {
                        _onEditCard(context, ref, card);
                      } else if (value == 'delete') {
                        _confirmDeleteCard(context, ref, card, isSelected);
                      }
                    },
                    itemBuilder: (context) => [
                      const PopupMenuItem(
                        value: 'edit',
                        child: Row(
                          children: [
                            Icon(Icons.edit_square, size: 20, color: GRAY_600),
                            SizedBox(width: 12),
                            Text('Editar'),
                          ],
                        ),
                      ),
                      const PopupMenuItem(
                        value: 'delete',
                        child: Row(
                          children: [
                            Icon(Icons.delete, size: 20, color: AppTheme.danger),
                            SizedBox(width: 12),
                            Text('Eliminar', style: TextStyle(color: AppTheme.danger)),
                          ],
                        ),
                      ),
                    ],
                  ),
              ],
            ),
            const SizedBox(height: 24),

            Text(
              card['number'],
              style: TextStyle(
                fontSize: 20,
                fontWeight: FontWeight.w600,
                letterSpacing: 2.0,
                color: isSelected ? GRAY_900 : GRAY_700,
                fontFamily: 'Noto Sans',
              ),
            ),
            const SizedBox(height: 16),

            Row(
              mainAxisAlignment: MainAxisAlignment.spaceBetween,
              children: [
                Column(
                  crossAxisAlignment: CrossAxisAlignment.start,
                  children: [
                    const Text(
                      'TITULAR',
                      style: TextStyle(fontSize: 10, color: GRAY_500, letterSpacing: 1.0),
                    ),
                    Text(
                      card['holder'],
                      style: const TextStyle(fontWeight: FontWeight.w600, color: GRAY_800),
                    ),
                  ],
                ),
                Column(
                  crossAxisAlignment: CrossAxisAlignment.end,
                  children: [
                    const Text(
                      'EXPIRA',
                      style: TextStyle(fontSize: 10, color: GRAY_500, letterSpacing: 1.0),
                    ),
                    Text(
                      card['expiry'],
                      style: const TextStyle(fontWeight: FontWeight.w600, color: GRAY_800),
                    ),
                  ],
                ),
              ],
            ),
          ],
        ),
      ),
    );
  }

  Widget _buildEmptyState() {
    return Center(
      child: Column(
        mainAxisAlignment: MainAxisAlignment.center,
        children: const [
          Icon(Icons.credit_card_off, size: 64, color: GRAY_300),
          SizedBox(height: 16),
          Text(
            'No tienes tarjetas guardadas',
            style: TextStyle(fontSize: 16, color: GRAY_500, fontFamily: 'Noto Sans'),
          ),
        ],
      ),
    );
  }

  void _onEditCard(BuildContext context, WidgetRef ref, Map<String, dynamic> card) {
    AppAlerts.showEditCardDialog(
      context: context,
      cardNumberLast4: card['number'].substring(card['number'].length - 4),
      currentHolder: card['holder'],
      currentExpiry: card['expiry'],
      onSave: (newHolder, newExpiry) {
        // Update card in Provider
        ref.read(paymentModelProvider).updateCard(card['id'], newHolder, newExpiry);
        AppAlerts.showToast(context: context, message: 'Tarjeta actualizada');
      },
    );
  }

  void _confirmDeleteCard(BuildContext context, WidgetRef ref, Map<String, dynamic> card, bool isSelected) {
    if (isSelected) {
      AppAlerts.showWarning(
          context: context,
          title: "Acción no permitida",
          message: "No puedes eliminar tu tarjeta principal. Selecciona otra primero.",
          isDismissible: true
      );
      return;
    }

    AppAlerts.showWarning(
      context: context,
      title: 'Eliminar Tarjeta',
      message: '¿Estás seguro de que deseas eliminar esta tarjeta?',
      onOk: () {
        // Remove card in Provider
        ref.read(paymentModelProvider).deleteCard(card['id']);
        AppAlerts.showToast(context: context, message: 'Tarjeta eliminada correctamente');
      },
    );
  }
}