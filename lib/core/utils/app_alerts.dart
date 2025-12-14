/**
 * Company: CETAM
 * Project: QParking
 * File: app_alerts.dart
 * Created on: 13/12/2025
 * Created by: Rodrigo Peña Vega
 * Approved by: Gamaliel Alejandro Juarez Loyde
 *
 * Changelog:
 * - ID: 1 | Modified on: 14/12/2025 |
 * Modified by: Gamaliel Alejandro Juarez Loyde |
 * Description: Added showAuthRequiredDialog |
 * - ID: 2 | Modified on: 14/12/2025 |
 * Modified by: Fix Bot |
 * Description: Added card alerts. |
 */

import 'package:flutter/material.dart';
import 'package:flutter/services.dart'; // Needed for input formatters
import 'package:go_router/go_router.dart';
// Ensure these imports point to your corrected files
import 'package:qparking/core/theme/app_theme.dart';
import 'package:qparking/core/constants/constants_exports.dart';

// Enum to control the alert type internally
enum _AlertType { success, error, warning, info }

class AppAlerts {
  // Private constructor to prevent instantiation
  AppAlerts._();

  // ===========================================================================
  // SECTION 1: STANDARD ALERTS (Toast/Snackbars & Basic Dialogs)
  // ===========================================================================

  static void showSuccess({
    required BuildContext context,
    required String title,
    required String message,
    VoidCallback? onOk,
  }) {
    _showDialog(
      context: context,
      type: _AlertType.success,
      title: title,
      message: message,
      onOk: onOk,
    );
  }

  static void showError({
    required BuildContext context,
    required String title,
    required String message,
    VoidCallback? onOk,
  }) {
    _showDialog(
      context: context,
      type: _AlertType.error,
      title: title,
      message: message,
      onOk: onOk,
    );
  }

  static void showWarning({
    required BuildContext context,
    required String title,
    required String message,
    VoidCallback? onOk,
    bool isDismissible = true,
  }) {
    _showDialog(
      context: context,
      type: _AlertType.warning,
      title: title,
      message: message,
      onOk: onOk,
      isDismissible: isDismissible,
    );
  }

  // ===========================================================================
  // SECTION 2: SPECIALIZED DIALOGS (Biometric, Security, Forms)
  // ===========================================================================

  static void showAuthRequiredDialog({
    required BuildContext context,
    required VoidCallback onRetry,
  }) {
    showDialog(
      context: context,
      barrierDismissible: false,
      builder: (context) => AlertDialog(
        backgroundColor: WHITE_COLOR,
        shape: RoundedRectangleBorder(borderRadius: BorderRadius.circular(16)),
        contentPadding: const EdgeInsets.all(24),
        content: Column(
          mainAxisSize: MainAxisSize.min,
          children: [
            Container(
              padding: const EdgeInsets.all(16),
              decoration: BoxDecoration(
                color: WARNING_COLOR.withOpacity(0.1),
                shape: BoxShape.circle,
              ),
              child: const Icon(
                Icons.gpp_bad_outlined,
                size: 40,
                color: WARNING_COLOR,
              ),
            ),
            const SizedBox(height: 16),
            const Text(
              'Autenticación Requerida',
              textAlign: TextAlign.center,
              style: TextStyle(
                fontFamily: 'Noto Sans',
                fontSize: 18,
                fontWeight: FontWeight.bold,
                color: GRAY_900,
              ),
            ),
            const SizedBox(height: 8),
            const Text(
              'Para proteger tu cuenta, es necesario verificar tu identidad antes de mostrar el código de acceso.',
              textAlign: TextAlign.center,
              style: TextStyle(
                fontFamily: 'Noto Sans',
                fontSize: 14,
                color: GRAY_600,
                height: 1.5,
              ),
            ),
          ],
        ),
        actionsPadding: const EdgeInsets.fromLTRB(16, 0, 24, 24),
        actionsAlignment: MainAxisAlignment.end,
        actions: [
          ElevatedButton(
            onPressed: () {
              Navigator.pop(context);
              onRetry();
            },
            style: ElevatedButton.styleFrom(
              backgroundColor: Colors.transparent,
              foregroundColor: WARNING_COLOR,
              elevation: 0,
              shadowColor: Colors.transparent,
              shape: RoundedRectangleBorder(
                borderRadius: BorderRadius.circular(8),
              ),
              padding: const EdgeInsets.symmetric(horizontal: 24, vertical: 12),
            ),
            child: const Text(
              'Revisar',
              style: TextStyle(
                fontFamily: 'Noto Sans',
                fontWeight: FontWeight.bold,
                fontSize: 16,
              ),
            ),
          ),
        ],
      ),
    );
  }

  /// Specialized Dialog for Editing Card Details
  static void showEditCardDialog({
    required BuildContext context,
    required String cardNumberLast4,
    required String currentHolder,
    required String currentExpiry,
    required Function(String holder, String expiry) onSave,
  }) {
    final holderController = TextEditingController(text: currentHolder);
    final expiryController = TextEditingController(text: currentExpiry);

    showDialog(
      context: context,
      barrierDismissible: false,
      builder: (context) => AlertDialog(
        backgroundColor: WHITE_COLOR,
        shape: RoundedRectangleBorder(borderRadius: BorderRadius.circular(16)),
        title: const Text(
          'Editar Tarjeta',
          style: TextStyle(fontFamily: 'Noto Sans', fontWeight: FontWeight.bold),
        ),
        content: Column(
          mainAxisSize: MainAxisSize.min,
          children: [
            Text(
              'Tarjeta terminada en $cardNumberLast4',
              style: const TextStyle(color: GRAY_600, fontSize: 12),
            ),
            const SizedBox(height: 16),
            TextField(
              controller: holderController,
              textCapitalization: TextCapitalization.characters,
              decoration: const InputDecoration(
                labelText: 'Nombre del Titular',
                border: OutlineInputBorder(),
                filled: true,
                fillColor: GRAY_50,
              ),
            ),
            const SizedBox(height: 12),
            TextField(
              controller: expiryController,
              keyboardType: TextInputType.number,
              inputFormatters: [
                FilteringTextInputFormatter.digitsOnly,
                LengthLimitingTextInputFormatter(4),
                _ExpiryDateFormatter(),
              ],
              decoration: const InputDecoration(
                labelText: 'Expiración (MM/YY)',
                hintText: 'MM/AA',
                counterText: "",
                border: OutlineInputBorder(),
                filled: true,
                fillColor: GRAY_50,
              ),
            ),
          ],
        ),
        actions: [
          TextButton(
            onPressed: () => Navigator.pop(context),
            child: const Text('Cancelar', style: TextStyle(color: GRAY_600)),
          ),
          ElevatedButton(
            onPressed: () {
              if (holderController.text.isEmpty || expiryController.text.length < 5) {
                showToast(context: context, message: 'Verifica los datos', isError: true);
                return;
              }
              onSave(holderController.text.toUpperCase(), expiryController.text);
              Navigator.pop(context);
            },
            style: ElevatedButton.styleFrom(
              backgroundColor: PRIMARY_COLOR,
              foregroundColor: WHITE_COLOR,
              shape: RoundedRectangleBorder(borderRadius: BorderRadius.circular(8)),
            ),
            child: const Text('Actualizar'),
          ),
        ],
      ),
    );
  }

  // ===========================================================================
  // SECTION 3: PRIVATE HELPERS
  // ===========================================================================

  static void _showDialog({
    required BuildContext context,
    required _AlertType type,
    required String title,
    required String message,
    VoidCallback? onOk,
    bool isDismissible = true,
  }) {
    Color mainColor;
    IconData iconData;
    String btnText;

    switch (type) {
      case _AlertType.success:
        mainColor = SUCCESS_COLOR;
        iconData = Icons.check_circle_outline;
        btnText = "Continuar";
        break;
      case _AlertType.error:
        mainColor = AppTheme.danger;
        iconData = Icons.error_outline;
        btnText = "Entendido";
        break;
      case _AlertType.warning:
        mainColor = WARNING_COLOR;
        iconData = Icons.warning_amber_rounded;
        btnText = "Aceptar";
        break;
      case _AlertType.info:
        mainColor = INFO_COLOR;
        iconData = Icons.info_outline;
        btnText = "Aceptar";
        break;
    }

    showDialog(
      context: context,
      barrierDismissible: isDismissible,
      builder: (BuildContext context) {
        return Dialog(
          elevation: 0,
          backgroundColor: Colors.transparent,
          child: Container(
            padding: const EdgeInsets.all(24),
            decoration: BoxDecoration(
              color: WHITE_COLOR,
              borderRadius: BorderRadius.circular(16),
              boxShadow: [
                BoxShadow(
                  color: Colors.black.withOpacity(0.1),
                  blurRadius: 20,
                  offset: const Offset(0, 10),
                ),
              ],
            ),
            child: Column(
              mainAxisSize: MainAxisSize.min,
              children: [
                Container(
                  width: 72,
                  height: 72,
                  decoration: BoxDecoration(
                    color: mainColor.withOpacity(0.1),
                    shape: BoxShape.circle,
                  ),
                  child: Icon(
                    iconData,
                    size: 36,
                    color: mainColor,
                  ),
                ),
                const SizedBox(height: 24),
                Text(
                  title,
                  textAlign: TextAlign.center,
                  style: const TextStyle(
                    fontFamily: 'Noto Sans',
                    fontSize: 20,
                    fontWeight: FontWeight.w700,
                    color: PRIMARY_COLOR,
                  ),
                ),
                const SizedBox(height: 12),
                Text(
                  message,
                  textAlign: TextAlign.center,
                  style: const TextStyle(
                    fontFamily: 'Noto Sans',
                    fontSize: 15,
                    color: GRAY_600,
                    height: 1.5,
                  ),
                ),
                const SizedBox(height: 32),
                SizedBox(
                  width: double.infinity,
                  height: 48,
                  child: ElevatedButton(
                    style: ElevatedButton.styleFrom(
                      backgroundColor: mainColor,
                      foregroundColor: WHITE_COLOR,
                      elevation: 0,
                      shape: RoundedRectangleBorder(
                        borderRadius: BorderRadius.circular(12),
                      ),
                    ),
                    onPressed: () {
                      context.pop();
                      if (onOk != null) onOk();
                    },
                    child: Text(
                      btnText,
                      style: const TextStyle(
                        fontFamily: 'Noto Sans',
                        fontWeight: FontWeight.w700,
                        fontSize: 16,
                      ),
                    ),
                  ),
                ),
              ],
            ),
          ),
        );
      },
    );
  }

  static void showToast({
    required BuildContext context,
    required String message,
    bool isError = false,
  }) {
    ScaffoldMessenger.of(context).showSnackBar(
      SnackBar(
        content: Text(
          message,
          style: const TextStyle(
              fontWeight: FontWeight.w600,
              color: WHITE_COLOR,
              fontFamily: 'Noto Sans'
          ),
        ),
        backgroundColor: isError ? AppTheme.danger : PRIMARY_COLOR,
        behavior: SnackBarBehavior.floating,
        shape: RoundedRectangleBorder(borderRadius: BorderRadius.circular(8)),
        margin: const EdgeInsets.all(16),
        duration: const Duration(seconds: 3),
      ),
    );
  }
}

// Internal Formatter for AppAlerts inputs
class _ExpiryDateFormatter extends TextInputFormatter {
  @override
  TextEditingValue formatEditUpdate(
      TextEditingValue oldValue, TextEditingValue newValue) {
    final newText = newValue.text;
    if (newValue.selection.baseOffset == 0) return newValue;
    var buffer = StringBuffer();
    for (int i = 0; i < newText.length; i++) {
      buffer.write(newText[i]);
      var nonZeroIndex = i + 1;
      if (nonZeroIndex % 2 == 0 && nonZeroIndex != newText.length) {
        buffer.write('/');
      }
    }
    var string = buffer.toString();
    return newValue.copyWith(
      text: string,
      selection: TextSelection.collapsed(offset: string.length),
    );
  }
}