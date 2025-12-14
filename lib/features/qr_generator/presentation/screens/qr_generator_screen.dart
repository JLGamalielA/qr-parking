/**
 * Company: CETAM
 * Project: QParking
 * File: qr_generator_screen.dart
 * Created on: 15/11/2025
 * Created by: Daniel Yair Mendoza Alvarez
 * Approved by: Daniel Yair Mendoza Alvarez
 *
 * Changelog:
 * - ID: 1 | Modified on: 25/11/2025 |
 * Modified by: Gamaliel Alejandro Juarez |
 * Description: Added Biometric Authentication. |
 */


import 'dart:async';
import 'package:flutter/material.dart';
import 'package:go_router/go_router.dart';
import 'package:qparking/core/theme/app_theme.dart';
import 'package:qr_flutter/qr_flutter.dart';
import 'package:qparking/core/constants/constants_exports.dart';
import 'package:qparking/core/utils/biometric_auth_service.dart';
import 'package:qparking/core/utils/app_alerts.dart';

class QrGeneratorScreen extends StatefulWidget {
  const QrGeneratorScreen({super.key});

  @override
  State<QrGeneratorScreen> createState() => _QrGeneratorScreenState();
}

class _QrGeneratorScreenState extends State<QrGeneratorScreen> {
  // Service Injection
  final BiometricAuthService _biometricService = BiometricAuthService();

  // State
  bool _isAuthenticated = false;
  bool _isLoading = true; // Start loading for auto-auth
  int _timeLeft = 30;
  Timer? _timer;

  // Mock Data
  final String _qrData = "https://qparking.cetam.mx/access/${DateTime.now().millisecondsSinceEpoch}";

  @override
  void initState() {
    super.initState();
    // Trigger authentication automatically when screen loads
    WidgetsBinding.instance.addPostFrameCallback((_) {
      _authenticate();
    });
  }

  @override
  void dispose() {
    _timer?.cancel();
    super.dispose();
  }

  /// Triggers biometric prompt. Calls centralized AppAlerts on failure.
  Future<void> _authenticate() async {
    setState(() => _isLoading = true);

    final bool authenticated = await _biometricService.authenticate();

    if (mounted) {
      setState(() {
        _isAuthenticated = authenticated;
        _isLoading = false;
      });

      if (authenticated) {
        _startTimer();
      } else {
        // USO CORRECTO: Llamada a la clase centralizada sin 'onCancel'
        AppAlerts.showAuthRequiredDialog(
          context: context,
          onRetry: () {
            // Acción al presionar "Revisar":
            // Mantenemos la UI en estado bloqueado (Acceso Protegido)
            // El usuario puede presionar el botón "Mostrar Código" manualmente después.
            setState(() {
              _isAuthenticated = false;
            });
          },
        );
      }
    }
  }

  void _startTimer() {
    _timer?.cancel(); // Cancel previous if exists
    _timeLeft = 30; // Reset time
    _timer = Timer.periodic(const Duration(seconds: 1), (timer) {
      if (_timeLeft > 0) {
        setState(() => _timeLeft--);
      } else {
        _timer?.cancel();
        // Optional: Expire session or hide QR
      }
    });
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      backgroundColor: SCAFFOLD_BACKGROUND,
      appBar: AppBar(
        backgroundColor: WHITE_COLOR,
        elevation: 0,
        centerTitle: true,
        leading: IconButton(
          icon: const Icon(Icons.arrow_back, color: PRIMARY_COLOR),
          onPressed: () => context.pop(),
        ),
        title: const Text(
          'Código de Acceso',
          style: TextStyle(
            color: PRIMARY_COLOR,
            fontWeight: FontWeight.w700,
            fontSize: 20,
            fontFamily: 'Noto Sans',
          ),
        ),
      ),
      body: SafeArea(
        child: _isLoading
            ? const Center(
          child: CircularProgressIndicator(color: PRIMARY_COLOR),
        )
            : SingleChildScrollView(
          padding: const EdgeInsets.symmetric(horizontal: 24, vertical: 32),
          child: Column(
            crossAxisAlignment: CrossAxisAlignment.center,
            children: [
              Text(
                _isAuthenticated ? 'Escanea este código' : 'Acceso Protegido',
                style: const TextStyle(
                  fontSize: 24,
                  fontWeight: FontWeight.w700,
                  color: PRIMARY_COLOR,
                  fontFamily: 'Noto Sans',
                ),
                textAlign: TextAlign.center,
              ),
              const SizedBox(height: 12),
              Text(
                _isAuthenticated
                    ? 'Muestra este código QR en la terminal de entrada para acceder al estacionamiento.'
                    : 'Tu código está oculto por seguridad. Verifica tu identidad para visualizarlo.',
                style: const TextStyle(
                  fontSize: 16,
                  color: GRAY_600,
                  height: 1.5,
                  fontFamily: 'Noto Sans',
                ),
                textAlign: TextAlign.center,
              ),
              const SizedBox(height: 40),

              // --- Content Card ---
              Container(
                constraints: const BoxConstraints(maxWidth: 350),
                padding: const EdgeInsets.all(32),
                decoration: BoxDecoration(
                  color: WHITE_COLOR,
                  borderRadius: BorderRadius.circular(24),
                  boxShadow: [
                    BoxShadow(
                      color: PRIMARY_COLOR.withOpacity(0.1),
                      blurRadius: 30,
                      offset: const Offset(0, 10),
                    ),
                  ],
                ),
                child: _isAuthenticated
                    ? _buildQrView()
                    : _buildLockedView(),
              ),

              const SizedBox(height: 48),

              // Action Button
              SizedBox(
                height: 52,
                width: double.infinity,
                child: ElevatedButton.icon(
                  onPressed: _isAuthenticated ? () => context.pop() : _authenticate,
                  style: ElevatedButton.styleFrom(
                    backgroundColor: PRIMARY_COLOR,
                    foregroundColor: WHITE_COLOR,
                    shape: RoundedRectangleBorder(
                      borderRadius: BorderRadius.circular(10),
                    ),
                    elevation: 0,
                  ),
                  icon: Icon(
                    _isAuthenticated ? Icons.check_circle_outline : Icons.shield,
                    size: 22,
                  ),
                  label: Text(
                    _isAuthenticated ? 'Terminar' : 'Mostrar Código',
                    style: const TextStyle(
                      fontSize: 16,
                      fontWeight: FontWeight.bold,
                      fontFamily: 'Noto Sans',
                    ),
                  ),
                ),
              ),
            ],
          ),
        ),
      ),
    );
  }

  /// Helper widget: Visible QR Code
  Widget _buildQrView() {
    return Column(
      children: [
        QrImageView(
          data: _qrData,
          version: QrVersions.auto,
          size: 220,
          backgroundColor: WHITE_COLOR,
          eyeStyle: const QrEyeStyle(
            eyeShape: QrEyeShape.square,
            color: PRIMARY_COLOR,
          ),
          dataModuleStyle: const QrDataModuleStyle(
            dataModuleShape: QrDataModuleShape.square,
            color: PRIMARY_COLOR,
          ),
        ),
        const SizedBox(height: 24),
        Row(
          mainAxisAlignment: MainAxisAlignment.center,
          children: [
            const SizedBox(width: 8),
            // Timer Text
            Text(
              _timeLeft > 0 ? 'Expira en: ${_timeLeft}s' : 'Código expirado',
              style: TextStyle(
                fontSize: 16,
                fontWeight: FontWeight.w700,
                color: _timeLeft > 0 ? WARNING_COLOR : AppTheme.danger,
                fontFamily: 'Noto Sans',
              ),
            ),
          ],
        ),
      ],
    );
  }

  /// Helper widget: Locked State
  Widget _buildLockedView() {
    return Column(
      children: [
        const SizedBox(height: 40),
        Container(
          padding: const EdgeInsets.all(24),
          decoration: BoxDecoration(
            color: GRAY_100,
            shape: BoxShape.circle,
          ),
          child: const Icon(
            Icons.lock_outline,
            size: 64,
            color: GRAY_500,
          ),
        ),
        const SizedBox(height: 24),
        const Text(
          'Código Oculto',
          style: TextStyle(
            fontSize: 18,
            fontWeight: FontWeight.bold,
            color: GRAY_500,
            fontFamily: 'Noto Sans',
          ),
        ),
        const SizedBox(height: 40),
      ],
    );
  }
}