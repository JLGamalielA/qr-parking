/**
 * Company: CETAM
 * Project: QParking
 * File: app_dialog.dart
 * Created on: 13/12/2025
 * Created by: Daniel Yair Mendoza Alvarez
 * Approved by: Daniel Yair Mendoza Alvarez
 *
 * Changelog:
 * - ID: 1 | Modified on: 27/11/2025 |
 * Modified by: Gamaliel Alejandro Juarez Loyde |
 * Description: Generic Dialog component implementation  |
 * - ID: 2 | Modified on: 30/11/2025 |
 * Modified by: Carlos Adair Bautista Godinez |
 * Description: Standarization of icons |
 * - ID: 3 | Modified on: 13/12/2025 |
 * Modified by: Rodrigo Peña Vega |
 * Description: Refactored to use Factory Constructors
 */

library;

import 'package:flutter/material.dart';
import 'package:go_router/go_router.dart';
import '../theme/app_theme.dart';
import '../icons/app_icons.dart';
import 'app_icon.dart';


class AppDialog extends StatelessWidget {
  final String title;
  final String message;
  final AppIconName? icon;
  final Color? iconColor;
  final String? primaryButtonText;
  final VoidCallback? onPrimaryPressed;
  final String? secondaryButtonText;
  final VoidCallback? onSecondaryPressed;
  final bool isDestructive;

  const AppDialog({
    super.key,
    required this.title,
    required this.message,
    this.icon,
    this.iconColor,
    this.primaryButtonText,
    this.onPrimaryPressed,
    this.secondaryButtonText,
    this.onSecondaryPressed,
    this.isDestructive = false,
  });

  /// Success Alert

  factory AppDialog.success({
    required String title,
    required String message,
    VoidCallback? onConfirm,
  }) {
    return AppDialog(
      title: title,
      message: message,
      icon: AppIconName.success,
      iconColor: AppTheme.success,
      primaryButtonText: "Aceptar",
      onPrimaryPressed: onConfirm,
    );
  }

  /// Danger/Error Alert

  factory AppDialog.danger({
    required String title,
    required String message,
    VoidCallback? onRetry,
  }) {
    return AppDialog(
      title: title,
      message: message,
      icon: AppIconName.error,
      iconColor: AppTheme.danger,
      primaryButtonText: "Cerrar",
      onPrimaryPressed: onRetry,
      isDestructive: true,
    );
  }

  /// Warning Alert

  factory AppDialog.warning({
    required String title,
    required String message,
    VoidCallback? onConfirm,
  }) {
    return AppDialog(
      title: title,
      message: message,
      icon: AppIconName.warning,
      iconColor: AppTheme.warning,
      primaryButtonText: "Revisar",
      onPrimaryPressed: onConfirm,
    );
  }

  /// Info Alert

  factory AppDialog.info({
    required String title,
    required String message,
    VoidCallback? onConfirm,
  }) {
    return AppDialog(
      title: title,
      message: message,
      icon: AppIconName.info,
      iconColor: AppTheme.info,
      primaryButtonText: "Entendido",
      onPrimaryPressed: onConfirm,
    );
  }

  /// Question/Confirm Alert

  factory AppDialog.confirm({
    required String title,
    required String message,
    required VoidCallback onConfirm,
    VoidCallback? onCancel,
  }) {
    return AppDialog(
      title: title,
      message: message,
      icon: AppIconName.help,
      iconColor: AppTheme.primary,
      primaryButtonText: "Confirmar",
      onPrimaryPressed: onConfirm,
      secondaryButtonText: "Cancelar",
      onSecondaryPressed: onCancel,
      isDestructive: true,
    );
  }

  @override
  Widget build(BuildContext context) {
    return AlertDialog(
      backgroundColor: AppTheme.white,
      surfaceTintColor: AppTheme.white,
      shape: RoundedRectangleBorder(borderRadius: BorderRadius.circular(16)),

      // Icon Sup
      icon: icon != null
          ? AppIcon(
        name: icon!,
        size: 48,
        color: iconColor ?? AppTheme.primary,
      )
          : null,

      // Title
      title: Text(
        title,
        textAlign: TextAlign.center,
        style: const TextStyle(
          fontSize: 20,
          fontWeight: FontWeight.w700,
          color: AppTheme.primary,
        ),
      ),

      // Message
      content: Text(
        message,
        textAlign: TextAlign.center,
        style: const TextStyle(
          fontSize: 15,
          color: AppTheme.gray600,
          height: 1.5,
        ),
      ),

      actionsAlignment: MainAxisAlignment.center,
      actions: [
        if (secondaryButtonText != null)
          TextButton(
            onPressed: onSecondaryPressed ?? () => context.pop(),
            style: TextButton.styleFrom(
              foregroundColor: AppTheme.gray500,
              textStyle: const TextStyle(fontWeight: FontWeight.w600),
            ),
            child: Text(secondaryButtonText!),
          ),

        if (primaryButtonText != null)
          ElevatedButton(
            onPressed: onPrimaryPressed ?? () => context.pop(),
            style: ElevatedButton.styleFrom(
              backgroundColor: isDestructive ? AppTheme.danger : AppTheme.primary,
              foregroundColor: AppTheme.white,
              elevation: 0,
              padding: const EdgeInsets.symmetric(horizontal: 24, vertical: 12),
              shape: RoundedRectangleBorder(
                borderRadius: BorderRadius.circular(8),
              ),
            ),
            child: Text(primaryButtonText!),
          ),
      ],
    );
  }
}