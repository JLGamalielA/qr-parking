/**
 * Company: CETAM
 * Project: QParking
 * File: payment_provider.dart
 * Created on: 14/12/2025
 * Created by: Gamaliel Alejandro Juarez Loyde
 * Approved by: Daniel Yair Mendoza Alvarez
 *
 * Changelog:
 * - ID: 1 | Modified on: 14/12/2025 |
 * Modified by: Gamaliel Alejandro Juarez Loyde |
 * Description: Manages global state for Payment Methods and Active Selection.
 */

import 'package:flutter/material.dart';
import 'package:flutter_riverpod/flutter_riverpod.dart';

final paymentModelProvider = ChangeNotifierProvider<PaymentProvider>((ref) {
  return PaymentProvider();
});

class PaymentProvider extends ChangeNotifier {
  // Mock Data
  final List<Map<String, dynamic>> _cards = [
    {
      'id': '1',
      'type': 'Visa',
      'number': '**** **** **** 4242',
      'holder': 'RODRIGO PEÑA',
      'expiry': '12/28',
      'color': const Color(0xFF1A1F71),
    },
    {
      'id': '2',
      'type': 'Mastercard',
      'number': '**** **** **** 5599',
      'holder': 'RODRIGO PEÑA',
      'expiry': '09/26',
      'color': const Color(0xFFEB001B),
    },
  ];

  String _selectedCardId = '1';

  List<Map<String, dynamic>> get cards => _cards;
  String get selectedCardId => _selectedCardId;

  Map<String, dynamic>? get activeCard {
    try {
      return _cards.firstWhere((c) => c['id'] == _selectedCardId);
    } catch (e) {
      return null;
    }
  }

  void addCard(Map<String, dynamic> card) {
    _cards.add(card);
    if (_cards.length == 1) {
      _selectedCardId = card['id'];
    }
    notifyListeners();
  }

  void selectCard(String id) {
    _selectedCardId = id;
    notifyListeners();
  }

  void updateCard(String id, String holder, String expiry) {
    final index = _cards.indexWhere((c) => c['id'] == id);
    if (index != -1) {
      _cards[index]['holder'] = holder;
      _cards[index]['expiry'] = expiry;
      notifyListeners();
    }
  }

  void deleteCard(String id) {
    _cards.removeWhere((c) => c['id'] == id);
    if (_selectedCardId == id) {
      if (_cards.isNotEmpty) {
        _selectedCardId = _cards.first['id'];
      } else {
        _selectedCardId = '';
      }
    }
    notifyListeners();
  }
}