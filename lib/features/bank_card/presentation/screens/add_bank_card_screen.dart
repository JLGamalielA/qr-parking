/**
 * Company: CETAM
 * Project: QParking
 * File: add_bank_card_screen.dart
 * Created on: 14/12/2025
 * Created by: Gamaliel Alejandro Juarez Loyde
 * Approved by: Gamaliel Alejandro Juarez Loyde
 *
 * Changelog:
 * - ID: 1 | Modified on: 14/12/2025
 * Modified by: Gamaliel Alejandro Juarez Loyde |
 * Description: Validatios and desing edition. |
 */


import 'package:flutter/material.dart';
import 'package:flutter/services.dart';
import 'package:flutter_riverpod/flutter_riverpod.dart'; // Riverpod
import 'package:go_router/go_router.dart';
import 'package:qparking/core/constants/constants_exports.dart';
import 'package:qparking/core/utils/app_alerts.dart';
import 'package:qparking/features/bank_card/business/payment_provider.dart';

// Convertimos a ConsumerStatefulWidget
class AddBankCardScreen extends ConsumerStatefulWidget {
  const AddBankCardScreen({super.key});

  @override
  ConsumerState<AddBankCardScreen> createState() => _AddBankCardScreenState();
}

// State hereda de ConsumerState
class _AddBankCardScreenState extends ConsumerState<AddBankCardScreen> {
  final TextEditingController _numberController = TextEditingController();
  final TextEditingController _holderController = TextEditingController();
  final TextEditingController _expiryController = TextEditingController();
  final TextEditingController _cvvController = TextEditingController();

  final String _userInitials = "Us";

  @override
  void dispose() {
    _numberController.dispose();
    _holderController.dispose();
    _expiryController.dispose();
    _cvvController.dispose();
    super.dispose();
  }

  Widget _sectionLabel(String text) {
    return Padding(
      padding: const EdgeInsets.only(bottom: 8.0),
      child: Text(text, style: const TextStyle(fontSize: 14, fontWeight: FontWeight.w600, color: GRAY_700, fontFamily: 'Noto Sans')),
    );
  }

  InputDecoration _inputDecoration({String? hint, IconData? icon}) {
    return InputDecoration(
      hintText: hint,
      hintStyle: const TextStyle(fontSize: 14, color: GRAY_400, fontFamily: 'Noto Sans'),
      contentPadding: const EdgeInsets.symmetric(horizontal: 16, vertical: 18),
      filled: true,
      fillColor: GRAY_50,
      prefixIcon: icon != null ? Icon(icon, size: 20, color: GRAY_500) : null,
      border: OutlineInputBorder(borderRadius: BorderRadius.circular(8), borderSide: const BorderSide(color: GRAY_200, width: 1)),
      enabledBorder: OutlineInputBorder(borderRadius: BorderRadius.circular(8), borderSide: const BorderSide(color: GRAY_200, width: 1)),
      focusedBorder: OutlineInputBorder(borderRadius: BorderRadius.circular(8), borderSide: const BorderSide(color: PRIMARY_COLOR, width: 1.5)),
      counterText: "",
    );
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      backgroundColor: SCAFFOLD_BACKGROUND,
      appBar: AppBar(
        backgroundColor: PRIMARY_COLOR,
        elevation: 0,
        centerTitle: true,
        iconTheme: const IconThemeData(color: WHITE_COLOR),
        title: const Text('Pago con Tarjeta', style: TextStyle(fontSize: 20, fontWeight: FontWeight.w700, color: WHITE_COLOR, fontFamily: 'Noto Sans')),
        actions: [
          IconButton(onPressed: () {}, icon: const Icon(Icons.notifications_none, color: WHITE_COLOR, size: 24)),
          Padding(
            padding: const EdgeInsets.only(right: 16.0, left: 4.0),
            child: InkWell(
              onTap: () => context.push('/profile'),
              borderRadius: BorderRadius.circular(18),
              child: CircleAvatar(
                radius: 18,
                backgroundColor: WHITE_COLOR.withOpacity(0.2),
                child: Text(_userInitials, style: const TextStyle(color: WHITE_COLOR, fontWeight: FontWeight.bold, fontSize: 14, fontFamily: 'Noto Sans')),
              ),
            ),
          ),
        ],
      ),
      body: SafeArea(
        child: SingleChildScrollView(
          padding: const EdgeInsets.all(24),
          child: Column(
            children: [
              Container(
                padding: const EdgeInsets.all(24),
                decoration: BoxDecoration(
                  color: WHITE_COLOR,
                  borderRadius: BorderRadius.circular(16),
                  border: Border.all(color: GRAY_200),
                  boxShadow: [BoxShadow(color: PRIMARY_COLOR.withOpacity(0.05), blurRadius: 10, offset: const Offset(0, 4))],
                ),
                child: Column(
                  crossAxisAlignment: CrossAxisAlignment.stretch,
                  children: [
                    const Center(child: Icon(Icons.credit_card, size: 48, color: PRIMARY_COLOR)),
                    const SizedBox(height: 32),
                    _sectionLabel('Número de Tarjeta'),
                    SizedBox(
                      height: 60,
                      child: TextField(
                        controller: _numberController,
                        keyboardType: TextInputType.number,
                        inputFormatters: [FilteringTextInputFormatter.digitsOnly, LengthLimitingTextInputFormatter(16)],
                        decoration: _inputDecoration(hint: '0000 0000 0000 0000', icon: Icons.credit_card),
                        style: const TextStyle(fontFamily: 'Noto Sans'),
                      ),
                    ),
                    const SizedBox(height: 24),
                    _sectionLabel('Nombre del Titular'),
                    SizedBox(
                      height: 60,
                      child: TextField(
                        controller: _holderController,
                        textCapitalization: TextCapitalization.characters,
                        keyboardType: TextInputType.name,
                        inputFormatters: [FilteringTextInputFormatter.allow(RegExp(r'[a-zA-Z\s]'))],
                        decoration: _inputDecoration(hint: 'Como aparece en la tarjeta', icon: Icons.person_outline),
                        style: const TextStyle(fontFamily: 'Noto Sans'),
                      ),
                    ),
                    const SizedBox(height: 24),
                    Row(
                      children: [
                        Expanded(
                          child: Column(
                            crossAxisAlignment: CrossAxisAlignment.start,
                            children: [
                              _sectionLabel('Vencimiento'),
                              SizedBox(
                                height: 60,
                                child: TextField(
                                  controller: _expiryController,
                                  keyboardType: TextInputType.number,
                                  inputFormatters: [FilteringTextInputFormatter.digitsOnly, LengthLimitingTextInputFormatter(4), _ExpiryDateFormatter()],
                                  decoration: _inputDecoration(hint: 'MM/AA', icon: Icons.calendar_today),
                                  style: const TextStyle(fontFamily: 'Noto Sans'),
                                ),
                              ),
                            ],
                          ),
                        ),
                        const SizedBox(width: 16),
                        Expanded(
                          child: Column(
                            crossAxisAlignment: CrossAxisAlignment.start,
                            children: [
                              _sectionLabel('CVV / CVC'),
                              SizedBox(
                                height: 60,
                                child: TextField(
                                  controller: _cvvController,
                                  keyboardType: TextInputType.number,
                                  obscureText: true,
                                  inputFormatters: [FilteringTextInputFormatter.digitsOnly, LengthLimitingTextInputFormatter(3)],
                                  decoration: _inputDecoration(hint: '123', icon: Icons.lock_outline),
                                  style: const TextStyle(fontFamily: 'Noto Sans'),
                                ),
                              ),
                            ],
                          ),
                        ),
                      ],
                    ),
                    const SizedBox(height: 32),
                    Row(
                      mainAxisAlignment: MainAxisAlignment.center,
                      children: const [
                        Icon(Icons.lock, size: 14, color: SUCCESS_COLOR),
                        SizedBox(width: 8),
                        Text('Transacción segura y encriptada', style: TextStyle(fontSize: 13, color: GRAY_500, fontWeight: FontWeight.w500, fontFamily: 'Noto Sans')),
                      ],
                    ),
                    const SizedBox(height: 24),
                    SizedBox(
                      height: 52,
                      child: ElevatedButton(
                        style: ElevatedButton.styleFrom(
                          backgroundColor: PRIMARY_COLOR,
                          foregroundColor: WHITE_COLOR,
                          elevation: 0,
                          shape: RoundedRectangleBorder(borderRadius: BorderRadius.circular(8)),
                        ),
                        onPressed: () {
                          if (_numberController.text.length < 16 || _holderController.text.isEmpty || _expiryController.text.length < 5 || _cvvController.text.length < 3) {
                            AppAlerts.showToast(context: context, message: "Verifica los datos", isError: true);
                            return;
                          }

                          final newCard = {
                            'id': DateTime.now().millisecondsSinceEpoch.toString(),
                            'type': _numberController.text.startsWith('4') ? 'Visa' : 'Mastercard',
                            'number': "**** **** **** ${_numberController.text.substring(12)}",
                            'holder': _holderController.text.toUpperCase(),
                            'expiry': _expiryController.text,
                            'color': _numberController.text.startsWith('4') ? const Color(0xFF1A1F71) : const Color(0xFFEB001B),
                          };

                          // RIVERPOD ACTION
                          ref.read(paymentModelProvider).addCard(newCard);

                          AppAlerts.showSuccess(
                            context: context,
                            title: "Tarjeta Agregada",
                            message: "Tu tarjeta ha sido registrada correctamente.",
                            onOk: () {
                              context.pop();
                            },
                          );
                        },
                        child: const Text('Agregar Tarjeta', style: TextStyle(fontWeight: FontWeight.w700, fontSize: 16, fontFamily: 'Noto Sans')),
                      ),
                    ),
                  ],
                ),
              ),
            ],
          ),
        ),
      ),
    );
  }
}

class _ExpiryDateFormatter extends TextInputFormatter {
  @override
  TextEditingValue formatEditUpdate(TextEditingValue oldValue, TextEditingValue newValue) {
    final newText = newValue.text;
    if (newValue.selection.baseOffset == 0) return newValue;
    var buffer = StringBuffer();
    for (int i = 0; i < newText.length; i++) {
      buffer.write(newText[i]);
      var nonZeroIndex = i + 1;
      if (nonZeroIndex % 2 == 0 && nonZeroIndex != newText.length) buffer.write('/');
    }
    var string = buffer.toString();
    return newValue.copyWith(text: string, selection: TextSelection.collapsed(offset: string.length));
  }
}